<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DonasiController extends Controller
{
    // === ADMIN: Menampilkan daftar donasi menunggu verifikasi ===
    public function indexAdmin()
    {
        $donasis = Donasi::with('user')
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        return view('admin.donasi.index', compact('donasis'));
    }

    // === ADMIN: Verifikasi donasi & buat entitas `Buku` ===
    public function verify(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);

        // Ubah status donasi menjadi diverifikasi
        $donasi->update(['status' => 'diverifikasi']);

        // Buat entitas Buku dari data donasi
        Buku::create([
            'user_id'      => $donasi->user_id,         // donatur
            'donasi_id'    => $donasi->id,
            'judul'        => $donasi->judul_buku,
            'penulis'      => '-',                       // bisa disempurnakan nanti
            'kategori'     => $donasi->kategori,
            'status_buku'  => $donasi->kondisi,         // 'baik', 'cukup', dll → jadi status ketersediaan awal
            'penerbit'     => '-',
            'tahun_terbit' => now()->year,
            'deskripsi'    => $donasi->deskripsi ?? '',
            'foto'         => $donasi->foto ?? null,
        ]);

        return back()->with('success', 'Donasi berhasil diverifikasi dan buku telah tersedia.');
    }

    // === DONATUR: Menampilkan riwayat donasi milik user ===
    public function index()
    {
        $donasis = Donasi::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.donatur', compact('donasis'));
    }

    public function create()
    {
        return view('donasi.create');
    }

    // === DONATUR: Submit donasi baru ===
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'jumlah',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string', // ✅ tambahkan deskripsi
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('donasi', 'public');
            $validated['foto'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['tanggal'] = now();
        $validated['status'] = 'menunggu';
        $validated['jumlah'] = $request->jumlah;
        $validated['deskripsi'] = $request->deskripsi; // ✅ simpan deskripsi

        Donasi::create($validated);

        return redirect()->back()->with('success', 'Donasi buku berhasil diajukan! Silakan tunggu verifikasi dari admin.');
    }

    public function show(Donasi $donasi)
    {
        return view('donasi.show', compact('donasi'));
    }
}
