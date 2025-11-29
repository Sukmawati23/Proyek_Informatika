<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Buku;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    /**
     * Penerima mengajukan buku
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
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



    /**
     * Admin melihat semua pengajuan
     */
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


            /**
             * ❗ FIX PENTING:
             * Jangan ubah status buku saat pengajuan disetujui / ditolak.
             * Buku tetap TERSIMPAN sebagai 'tersedia'
             * sampai admin memilih siapa yang akhirnya menerima buku (fitur lain).
             */


            // Buat notifikasi
            $judulBuku = $pengajuan->buku->judul ?? '[Judul tidak tersedia]';

            $pesan = $request->status === 'disetujui'
                ? "Pengajuan buku \"{$judulBuku}\" telah disetujui."
                : "Pengajuan buku \"{$judulBuku}\" ditolak oleh admin.";

            Notifikasi::create([
                'user_id' => $pengajuan->user_id,
                'pesan'   => $pesan
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
