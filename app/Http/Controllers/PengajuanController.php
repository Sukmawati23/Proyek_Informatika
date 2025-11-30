<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Buku;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'buku_id' => 'required|exists:bukus, id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['error' => 'Anda harus login untuk mengajukan buku.'], 401);
        }

        $buku = Buku::findOrFail($request->buku_id);

        // ❌ Jangan izinkan ajukan buku yang bukan 'tersedia'
        if ($buku->status_buku !== 'tersedia') {
            return response()->json(['error' => 'Buku tidak tersedia untuk diajukan.'], 400);
        }

        //  Buat pengajuan
        $pengajuan = Pengajuan::create([
            'user_id' => Auth::id(), // ID penerima yang login
            'buku_id' => $buku->id,
            'jumlah' => $request->jumlah,
            'tanggal' => now(),
            'status' => 'menunggu', // Status default
        ]);

        // Ubah status buku jadi 'diajukan'
        $buku->update(['status_buku' => 'diajukan']);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil diajukan!',
            'pengajuan_id' => $pengajuan->id,
        ]);
    }
    //  Admin: tampilkan daftar pengajuan 
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'buku'])
            ->latest()
            ->paginate(10); // 

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    // === Admin: update status pengajuan (disetujui / ditolak) ===
    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        try {
            // Cari pengajuan beserta buku yang terkait
            $pengajuan = Pengajuan::with('buku')->findOrFail($id);

            // Simpan status lama untuk logging (opsional)
            $oldStatus = $pengajuan->status;

            // Perbarui status pengajuan
            $pengajuan->update(['status' => $request->status]);

            // Update status buku jika ada
            if ($pengajuan->buku) {
                $newBukuStatus = $request->status === 'disetujui' ? 'terkirim' : 'tersedia';
                $pengajuan->buku->update(['status_buku' => $newBukuStatus]);
            } else {
                Log::warning("Buku tidak ditemukan untuk pengajuan ID: {$id}");
            }

            $judulBuku = optional($pengajuan->buku)->judul ?? '[Judul tidak tersedia]';
           $donaturId = optional($pengajuan->buku->donasi)->user_id;
            //pesan untuk penerima
           $pesan = $request->status === 'disetujui'
                ? "Buku \"{$judulBuku}\" sudah diverifikasi oleh admin."
                : "Pengajuan buku \"{$judulBuku}\" ditolak oleh admin.";
                //pesan untuk donatur
                // Pesan untuk donatur (bisa sama atau disesuaikan)
            $pesanDonatur = $request->status === 'disetujui'
             ? "Pengajuan permintaan buku  \"{$judulBuku}\" dari penerima sudah disetujui oleh Admin."
             : "Pengajuan permintaan buku \"{$judulBuku}\" dari penerima ditolak oleh Admin.";
           // Notifikasi untuk penerima
            Notifikasi::create([
             'user_id' => $pengajuan->user_id,   // penerima
             'partner_id' => $donaturId,         // donatur
             'pesan' => $pesan
            ]);

// Notifikasi untuk donatur
Notifikasi::create([
    'user_id' => $donaturId,            // donatur
    'partner_id' => $pengajuan->user_id,// penerima
    'pesan' => $pesanDonatur
]);
            // Respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Status pengajuan berhasil diperbarui.',
                'data' => [
                    'id' => $pengajuan->id,
                    'status' => $pengajuan->status,
                    'buku_status' => optional($pengajuan->buku)->status_buku,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating pengajuan status (ID: ' . $id . '): ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage(),
            ], 500);
        }
    }
}
