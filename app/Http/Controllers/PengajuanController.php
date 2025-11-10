<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Buku;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PengajuanController extends Controller
{
    // === Penerima mengajukan buku ===
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah'  => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // 🔒 Cek apakah buku tersedia & belum diajukan/disetujui
        if ($buku->status_buku !== 'tersedia') {
            throw ValidationException::withMessages([
                'buku_id' => 'Buku tidak tersedia untuk diajukan saat ini.'
            ]);
        }

        // 🔍 Cek apakah user sudah pernah mengajukan buku ini (opsional, bisa di-skip jika boleh ajukan ulang)
        $existing = Pengajuan::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->first();

        if ($existing) {
            throw ValidationException::withMessages([
                'buku_id' => 'Anda sudah mengajukan buku ini sebelumnya.'
            ]);
        }

        // ✅ Simpan pengajuan
        $pengajuan = Pengajuan::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'jumlah'  => $request->jumlah,
            'tanggal' => now(),
            'status'  => 'menunggu',
        ]);

        // 🔁 Ubah status buku jadi "diajukan" agar tidak bisa diajukan orang lain
        $buku->update(['status_buku' => 'diajukan']);

        return response()->json([
            'message' => 'Pengajuan berhasil diajukan!',
            'pengajuan_id' => $pengajuan->id,
        ]);
    }

    // === Admin: tampilkan daftar pengajuan ===
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'buku'])
            ->latest()
            ->paginate(10); // ✅ tambahkan pagination

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    // === Admin: update status pengajuan (disetujui / ditolak) ===
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $pengajuan = Pengajuan::with('buku')->findOrFail($id);

        // Jika status tidak berubah, skip
        if ($pengajuan->status === $request->status) {
            return response()->json(['message' => 'Status tidak berubah.']);
        }

        // ✅ Update status pengajuan
        $pengajuan->update(['status' => $request->status]);

        // 🔁 Update status buku berdasarkan keputusan
        if ($request->status === 'disetujui') {
            // Buku diberikan → ubah jadi 'terkirim'
            $pengajuan->buku->update(['status_buku' => 'terkirim']);
        } elseif ($request->status === 'ditolak') {
            // Kembalikan ke 'tersedia' agar bisa diajukan lagi
            $pengajuan->buku->update(['status_buku' => 'tersedia']);
        }

        // 📩 Notifikasi ke penerima
        $judul = $pengajuan->buku->judul;
        $statusText = $request->status === 'disetujui' ? 'disetujui' : 'ditolak';
        $pesan = "📚 Pengajuan buku *\"$judul\"* telah **$statusText** oleh admin.";

        Notifikasi::create([
            'user_id' => $pengajuan->user_id,
            'pesan'   => $pesan,
        ]);

        // ✅ Kirim notifikasi ke donatur (opsional tapi bagus)
        $donaturId = $pengajuan->buku->user_id; // karena buku punya `user_id` = donatur
        if ($donaturId && $donaturId !== $pengajuan->user_id) {
            $namaPenerima = $pengajuan->user->name;
            Notifikasi::create([
                'user_id' => $donaturId,
                'pesan'   => "Buku *\"$judul\"* yang Anda donasikan telah $statusText untuk penerima: *$namaPenerima*.",
            ]);
        }

        return response()->json([
            'message' => 'Status pengajuan berhasil diperbarui!',
            'status'  => $request->status,
        ]);
    }
}
