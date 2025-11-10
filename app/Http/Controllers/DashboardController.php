<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
// Tambahkan model Notifikasi jika sudah ada
// use App\Models\Notifikasi;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                // Statistik utama
                'total_donatur' => User::where('role', 'donatur')->count(),
                'total_penerima' => User::where('role', 'penerima')->count(),
                'total_donasi' => Donasi::count(),
                'total_pengajuan' => Pengajuan::count(),

                // Data tabel — ganti `collect()` jika sudah punya model Notifikasi/ActivityLog
                'activities'    => collect(), // ✅ atasi error $activities
                'donaturs' => User::where('role', 'donatur')->latest()->take(10)->get(),
                'penerimas' => User::where('role', 'penerima')->latest()->take(10)->get(),
                'donasis'       => Donasi::with('user')->latest()->take(10)->get(), // ✅ (tambahkan relasi donasi->user)
                'verifications' => Pengajuan::with(['user', 'buku'])->where('status', 'menunggu')->latest()->take(10)->get(), // ✅
                'reports'       => collect(),
                'reviews'       => collect(),
                'sessions'      => collect(),
            ]);
        }

        if ($user->role === 'donatur') {
            return view('dashboard.donatur', [
                'donasis' => Donasi::with(['donatur', 'penerima'])->latest()->take(10)->get(),
            ]);
        }

        if ($user->role === 'penerima') {
            return view('dashboard.penerima', [
                'pengajuans' => $user->pengajuans()->with('buku')->latest()->take(10)->get(),
                'bukus'      => Buku::where('status_buku', 'tersedia')->latest()->take(10)->get(),
            ]);
        }

        return redirect('/');
    }
}
