<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Buku;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    /**
     * Penerima mengajukan buku
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus, id',
            'jumlah' => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            return response()->json(['error' => 'Anda harus login untuk mengajukan buku.'], 401);
        }

        $buku = Buku::findOrFail($request->buku_id);

        /**
         * ❗ FIX UTAMA:
         * Jangan ubah status buku menjadi "diajukan"!
         * Buku harus tetap "tersedia" agar bisa diajukan oleh penerima lain.
         */

        // Buat pengajuan baru
        $pengajuan = Pengajuan::create([
            'user_id'   => Auth::id(),
            'buku_id'   => $buku->id,
            'jumlah'    => $request->jumlah,
            'tanggal'   => now(),
            'status'    => 'menunggu',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil diajukan!',
            'pengajuan_id' => $pengajuan->id,
        ]);
    }
  
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'buku'])
            ->latest()
            ->paginate(10);

        return view('admin.pengajuan.index', compact('pengajuans'));
    }



    /**
     * Admin update status pengajuan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        try {
            $pengajuan = Pengajuan::with('buku')->findOrFail($id);

            // Update status pengajuan
            $pengajuan->update(['status' => $request->status]);


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
            return response()->json([
                'success' => true,
                'message' => 'Status pengajuan berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal update pengajuan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.',
            ], 500);
        }
    }
}