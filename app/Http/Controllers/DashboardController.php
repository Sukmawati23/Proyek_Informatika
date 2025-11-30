<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Pengajuan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Controllers\ReviewController;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            // Hitung statistik
            $total_donatur = User::where('role', 'donatur')->count();
            $total_penerima = User::where('role', 'penerima')->count();
            $total_donasi = Donasi::count();
            $total_menunggu_verifikasi = Donasi::where('status', 'menunggu')->count();

            // Ambil data untuk grafik
            $months = [];
            $donaturData = [];
            $penerimaData = [];
            $donasiData = [];

            // Dapatkan 6 bulan terakhir
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i)->format('M'); // Format: Jan, Feb, Mar, dll.
                $months[] = $month;

                // Jumlah donatur baru tiap bulan
                $donaturCount = User::where('role', 'donatur')
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                    ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                    ->count();
                $donaturData[] = $donaturCount;

                // Jumlah penerima baru tiap bulan
                $penerimaCount = User::where('role', 'penerima')
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                    ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                    ->count();
                $penerimaData[] = $penerimaCount;

                // Jumlah donasi tiap bulan
                $donasiCount = Donasi::whereMonth('tanggal', Carbon::now()->subMonths($i)->month)
                    ->whereYear('tanggal', Carbon::now()->subMonths($i)->year)
                    ->count();
                $donasiData[] = $donasiCount;
            }

            return view('dashboard.admin', [
                // Statistik utama
                'total_donatur' => $total_donatur,
                'total_penerima' => $total_penerima,
                'total_donasi' => $total_donasi,
                'total_menunggu_verifikasi' => $total_menunggu_verifikasi,
                // Data untuk grafik
                'chart_months' => $months,
                'chart_donatur_data' => $donaturData,
                'chart_penerima_data' => $penerimaData,
                'chart_donasi_data' => $donasiData,
                // Data tabel — ganti `collect()` jika sudah punya model Notifikasi/ActivityLog
                'activities'    => collect(),
                'donaturs' => User::where('role', 'donatur')->latest()->take(10)->get(),
                'penerimas' => User::where('role', 'penerima')->latest()->take(10)->get(),
                'donasis'       => Donasi::with('user')->latest()->take(10)->get(),
                'verifications' => Pengajuan::with(['user', 'buku'])->where('status', 'menunggu')->latest()->take(10)->get(),
                'reports'       => collect(),
                'sessions'      => collect(),
                'reviews' => Review::with('reviewer', 'reviewed')->latest()->take(20)->get(),
            ]);
        }
        // app/Http/Controllers/DashboardController.php → index()
        if ($user->role === 'donatur') {
            // Ambil semua donasi user
            $donasis = Donasi::where('user_id', $user->id)->with('bukus')->get();

            // Ambil pengajuan yang terkait dengan buku dari donasi
            $pengajuanMap = [];
            foreach ($donasis as $donasi) {
                if ($donasi->bukus->isNotEmpty()) {
                    $buku = $donasi->bukus->first();
                    $pengajuan = Pengajuan::where('buku_id', $buku->id)
                        ->with('user')
                        ->whereIn('status', ['disetujui'])
                        ->first();
                    $pengajuanMap[$donasi->id] = $pengajuan;
                }
            }

            // Ambil ulasan yang sudah diberikan oleh donatur terkait tiap pengajuan
            $ulasanMap = [];
            foreach ($pengajuanMap as $donasi_id => $pengajuan) {
                if ($pengajuan) {
                    $ulasan = Review::where('pengajuan_id', $pengajuan->id)
                        ->where('reviewer_id', $user->id)
                        ->first();
                    $ulasanMap[$donasi_id] = $ulasan;
                }
            }

            return view('dashboard.donatur', [
                'donasis' => $donasis,
                'pengajuanMap' => $pengajuanMap,
                'ulasanMap' => $ulasanMap,
                'notifications' => $user->notifications()->latest()->take(5)->get(),
            ]);
        }

        // === DashboardController.php → index() — untuk penerima
        if ($user->role === 'penerima') {
            return view('dashboard.penerima', [
                'user' => $user,
                'bukus' => Buku::where('status_buku', 'tersedia')->latest()->get(),
                'pengajuans' => Pengajuan::where('user_id', $user->id)->with('buku')->latest()->get(),
                'notifications' => Notifikasi::with('chatRoom')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->take(10)
                    ->get(),
            ]);
        }

        return redirect('/');
    }

    public function getNotifikasi()
    {
        $notifs = Auth::user()
            ->notifications()
            ->latest()
            ->get();

        return response()->json($notifs);
    }
}