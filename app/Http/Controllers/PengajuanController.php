<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Notifikasi; // ✅ pastikan ini ditambahkan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    // === Penerima mengajukan buku ===
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        Pengajuan::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'jumlah' => $request->jumlah,
            'tanggal' => now(),
            'status' => 'menunggu'
        ]);

        return response()->json(['message' => 'Pengajuan berhasil diajukan!']);
    }

    // === Admin menampilkan daftar pengajuan ===
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'buku'])->get();
        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    // === Admin memverifikasi pengajuan ===
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update(['status' => $request->status]);

        // === Buat notifikasi ke penerima ===
        $judul = $pengajuan->buku->judul;
        $pesan = "📚 Pengajuan buku dengan judul \"$judul\" telah {$request->status} oleh admin.";

        Notifikasi::create([
            'user_id' => $pengajuan->user_id,
            'pesan'   => $pesan,
        ]);

        return response()->json(['message' => 'Status pengajuan berhasil diperbarui!']);
    }
}
