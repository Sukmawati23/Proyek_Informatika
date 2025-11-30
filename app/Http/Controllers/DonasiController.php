<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Buku;
use App\Models\Notifikasi;
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

    // app/Http/Controllers/DonasiController.php → verify()
    // app/Http/Controllers/DonasiController.php → verify()
    public function verify(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        if ($donasi->status !== 'menunggu') {
            return back()->with('error', 'Donasi sudah diverifikasi sebelumnya.');
        }

        // ✅ Update status donasi
        $donasi->update(['status' => 'diverifikasi']);


        // ✅ Buat entri Buku
        $buku = Buku::create([
            'user_id'      => $donasi->user_id,
            'donasi_id'    => $donasi->id,
            'judul'        => $donasi->judul_buku,

            'penulis'      => $donasi->penulis,     // ← FIX
            'kategori'     => $donasi->kategori,
            'status_buku'  => 'tersedia',
            'penerbit'     => $donasi->penerbit,   // ← FIX

            'tahun_terbit' => now()->year,
            'deskripsi'    => $donasi->deskripsi ?? '',
            'foto'         => $donasi->foto ?? null,
        ]);


        // ✅ Kirim notifikasi
        Notifikasi::create([
            'user_id' => $donasi->user_id,
            'pesan'   => "Buku \"{$donasi->judul_buku}\" yang Anda donasikan telah diverifikasi dan kini tersedia untuk diajukan penerima.",
        ]);

        return back()->with('success', 'Donasi berhasil diverifikasi. Buku kini tersedia untuk diajukan.');
    }

    // === DONATUR: Menampilkan riwayat donasi milik user ===
    public function index()
    {
        $donasis = Donasi::where('user_id', Auth::id())->latest()->get();
        $notifications = Notifikasi::where('user_id', Auth::id())->latest()->get();

        return view('dashboard.donatur', compact('donasis', 'notifications'));
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
            'kategori' => 'required|string|max:100',
            'kondisi' => 'required|string|max:50',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',   // ← tambahkan
            'jumlah' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('donasi', 'public');
        }

        Donasi::create([
            'user_id' => Auth::id(),
            'judul_buku' => $validated['judul_buku'],
            'kategori' => $validated['kategori'],
            'kondisi' => $validated['kondisi'],
            'penulis' => $validated['penulis'],   // ⬅ TAMBAHKAN INI
            'penerbit' => $validated['penerbit'], // ⬅ TAMBAHKAN INI   // ← simpan
            'jumlah' => $validated['jumlah'],
            'foto' => $validated['foto'] ?? null,
            'deskripsi' => $validated['deskripsi'] ?? null,
            'tanggal' => now(),
            'status' => 'menunggu', // ✅ menunggu verifikasi
            'penerima_id'=> null
        ]);

        return back()->with('success', 'Donasi berhasil diajukan. Menunggu verifikasi admin.');
    }

    public function show(Donasi $donasi)
    {
        return view('donasi.show', compact('donasi'));
    }

   public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string'
    ]);

    $donasi = Donasi::findOrFail($id);
    $oldStatus = $donasi->status; // jika butuh logging
    $donasi->update(['status' => $request->status]);

    $donaturId  = $donasi->user_id;
    $penerimaId = $donasi->penerima_id;
    $judul      = $donasi->judul_buku;

    // Pesan notifikasi berdasarkan status
    $pesan = match($request->status) {
        'diverifikasi' => "✅ Donasi buku \"$judul\" telah diverifikasi dan kini tersedia",
        'ditolak'      => "❌ Donasi buku \"$judul\" ditolak. Silahkan hubungi admin untuk info lebih lanjut.",
        'terkirim'     => "📦 Donasi buku \"$judul\" telah berhasil dikirim ke penerima.",
        default        => null
    };

    // Jika ada pesan, buat notifikasi
    if ($pesan) {
        Notifikasi::create([
            'user_id'    => $donaturId,  // penerima notifikasi adalah donatur
            'partner_id' => $penerimaId, // relasi dengan penerima
            'pesan'      => $pesan,
        ]);
    }


    return back()->with('success', 'Status donasi berhasil diperbarui.');
}
public function reject($id) 
{ 
    $donasi = Donasi::findOrFail($id); 
    $donasi->update(['status' => 'ditolak']); 
    $penerimaId = $donasi->penerima_id; 
    $donaturId = $donasi->user_id; // Buat notifikasi ke donatur 
    Notifikasi::create([ 'user_id' => $donaturId, 'partner_id' => $penerimaId, 'pesan' => "❌ Donasi buku \"{$donasi->judul_buku}\" ditolak. Silakan hubungi admin untuk info lebih lanjut", ]); 
    return back()->with('warning', 'Donasi berhasil ditolak.'); }

    public function updateStatus(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => $request->status]);
        return back()->with('success', 'Status donasi diperbarui.');
}
