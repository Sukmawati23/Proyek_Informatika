<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Buku;
use App\Models\Notifikasi;
use App\Http\Controllers\Controller;
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
            'jumlah' => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // ❌ Jangan izinkan ajukan buku yang bukan 'tersedia'
        if ($buku->status_buku !== 'tersedia') {
            return response()->json(['error' => 'Buku tidak tersedia untuk diajukan.'], 400);
        }

        // ✅ Buat pengajuan
        $pengajuan = Pengajuan::create([
            'user_id' => Auth::id(), // ID penerima yang login
            'buku_id' => $buku->id,
            'jumlah' => $request->jumlah,
            'tanggal' => now(),
            'status' => 'menunggu', // Status default
        ]);

        // ✅ Ubah status buku jadi 'diajukan'
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
        $request->validate(['status' => 'required|in:disetujui,ditolak']);

        $pengajuan = Pengajuan::with('buku')->findOrFail($id);
        $pengajuan->update(['status' => $request->status]);

        if ($request->status === 'disetujui') {
            $pengajuan->buku->update(['status_buku' => 'terkirim']);
        } else {
            $pengajuan->buku->update(['status_buku' => 'tersedia']);
        }

        return response()->json(['message' => 'Status diperbarui.']);
    }
}
