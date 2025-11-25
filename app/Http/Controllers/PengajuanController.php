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
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
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
            public function updateStatus(Request $request, $id){
    // Validasi input
    $request->validate([
        'status' => 'required|in:menunggu,disetujui,ditolak',
    ]);

    try {
        // Cari pengajuan
        $pengajuan = Pengajuan::with('buku')->findOrFail($id);

        // Update status
        $pengajuan->update(['status' => $request->status]);

        // Perbarui status buku jika diperlukan
        if ($request->status === 'disetujui') {
            // Pastikan buku ada sebelum update
            if ($pengajuan->buku) {
                $pengajuan->buku->update(['status_buku' => 'terkirim']);
            }
        } else if ($request->status === 'ditolak') {
            // Pastikan buku ada sebelum update
            if ($pengajuan->buku) {
                $pengajuan->buku->update(['status_buku' => 'tersedia']);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Status diperbarui.',
            'data' => [
                'id' => $pengajuan->id,
                'status' => $pengajuan->status,
                'buku_status' => $pengajuan->buku ? $pengajuan->buku->status_buku : null
            ]
        ]);
    } catch (\Exception $e) {
        // Tangkap semua error dan kembalikan respons JSON
        Log::error('Error updating pengajuan status: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui status. ' . $e->getMessage(),
        ], 500);
    }
}
}
