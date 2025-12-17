<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Pengajuan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Review;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;


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

            $reports = Report::orderBy('created_at', 'desc')->get();

            // Ambil data untuk grafik
            $months = [];
            $donaturData = [];
            $penerimaData = [];
            $donasiData = [];

            // Dapatkan 6 bulan terakhir
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i)->format('M');
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
                'activities' => \App\Models\Notifikasi::with('user')->latest()->take(10)->get(),
                'donaturs' => User::where('role', 'donatur')->latest()->take(10)->get(),
                'penerimas' => User::where('role', 'penerima')->latest()->take(10)->get(),
                'donasis'       => Donasi::with('user')->latest()->take(10)->get(),
                'verifications' => Pengajuan::with(['user', 'buku'])->where('status', 'menunggu')->latest()->take(10)->get(),
                'reports' => \App\Models\Report::latest()->get(),
                'sessions'      => collect(),
                'reviews' => Review::with('reviewer', 'reviewed')->latest()->take(20)->get(),
            ]);
        }

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
                'user' => $user,
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

    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);
        $type = $report->type;
        $startDate = $report->start_date;
        $endDate = $report->end_date;
        $format = $report->format;
        $filename = pathinfo($report->file_name, PATHINFO_FILENAME);

        $data = $this->getReportData($type, $startDate, $endDate);

        if ($format === 'excel') {
            return $this->exportToExcel($data, $type, $filename);
        } else {
            return $this->exportToPDF($data, $type, $filename, $startDate, $endDate); // ← tambahkan $startDate, $endDate
        }
    }

    private function getReportData($type, $startDate, $endDate)
    {
        $query = match ($type) {
            'donatur' => User::where('role', 'donatur'),
            'penerima' => User::where('role', 'penerima'),
            'donasi' => Donasi::with('user'),
            'verifikasi' => Pengajuan::with(['user', 'buku']),
            'ulasan' => Review::with(['reviewer', 'reviewed']),
            default => collect(),
        };

        // Hanya tambahkan whereBetween jika startDate dan endDate tidak null
        if ($startDate && $endDate) {
            $dateColumn = match ($type) {
                'donatur', 'penerima' => 'created_at',
                'donasi' => 'tanggal',
                'verifikasi', 'ulasan' => 'tanggal',
                default => null,
            };
            if ($dateColumn) {
                $query->whereBetween($dateColumn, [$startDate, $endDate]);
            }
        }

        // Urutkan data
        $orderByColumn = match ($type) {
            'donatur', 'penerima' => 'created_at',
            'donasi' => 'tanggal',
            'verifikasi', 'ulasan' => 'tanggal',
            default => null,
        };

        if ($orderByColumn) {
            $query->orderBy($orderByColumn, 'desc');
        }

        // Ambil data
        return $query->get();
    }

    private function exportToExcel($data, $type, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}.csv",
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        $output = fopen('php://output', 'w');
        fputcsv($output, $this->getReportHeaders($type));
        foreach ($data as $item) {
            fputcsv($output, $this->getReportRow($item, $type));
        }
        fclose($output);
        exit;
    }

    // === Helper: Ekspor ke PDF menggunakan DomPDF ===
    private function exportToPDF($data, $type, $filename, $startDate, $endDate)
    {

        $headers = $this->getReportHeaders($type);

        // Siapkan data sebagai array 2D (bukan objek Eloquent)
        $rows = $data->map(function ($item) use ($type) {
            return $this->getReportRow($item, $type);
        });

        $viewData = [
            'title' => "Laporan {$type}",
            'headers' => $headers,
            'rows' => $rows,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $pdf = Pdf::loadView('admin.report-template', $viewData)
            ->setPaper('a4', 'landscape');

        return $pdf->download("{$filename}.pdf");
    }


    // === Helper: Mendapatkan header laporan ===
    private function getReportHeaders($type)
    {
        return match ($type) {
            'donatur' => ['ID', 'Nama', 'Email', 'Alamat', 'Telepon', 'Status', 'Tanggal Dibuat'],
            'penerima' => ['ID', 'Nama', 'Email', 'Alamat', 'Telepon', 'Status', 'Tanggal Dibuat'],
            'donasi' => ['ID', 'Judul Buku', 'Donatur', 'Kategori', 'Status', 'Tanggal Donasi'],
            'verifikasi' => ['ID Pengajuan', 'Judul Buku', 'Penerima', 'Status', 'Tanggal'],
            'ulasan' => ['ID', 'Penulis', 'Penerima', 'Rating', 'Ulasan', 'Tanggal'],
            default => ['ID', 'Data'],
        };
    }

    // === Helper: Mendapatkan baris laporan ===
    private function getReportRow($item, $type)
    {
        return match ($type) {
            'donatur' => [
                $item->id,
                $item->name,
                $item->email,
                $item->alamat ?? '-',
                $item->telepon ?? '-',
                $item->email_verified_at ? 'Aktif' : 'Belum Verifikasi',
                $item->created_at->format('d/m/Y H:i')
            ],
            'penerima' => [
                $item->id,
                $item->name,
                $item->email,
                $item->alamat ?? '-',
                $item->telepon ?? '-',
                $item->email_verified_at ? 'Aktif' : 'Belum Verifikasi',
                $item->created_at->format('d/m/Y H:i')
            ],
            'donasi' => [
                $item->id,
                $item->judul_buku,
                $item->user?->name ?? '-',
                $item->kategori,
                ucfirst($item->status),
                $item->tanggal->format('d/m/Y')
            ],
            'verifikasi' => [
                $item->id,
                $item->buku?->judul ?? '-',
                $item->user?->name ?? '-',
                ucfirst($item->status),
                $item->tanggal->format('d/m/Y')
            ],
            'ulasan' => [
                $item->id,
                $item->reviewer?->name ?? '-',
                $item->reviewed?->name ?? '-',
                $item->rating . '/5',
                $item->comment ?? '-',
                $item->created_at->format('d/m/Y H:i')
            ],
            default => [$item->id, json_encode($item)],
        };
    }

    // === Metode untuk menghapus laporan ===
    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        // Redirect kembali ke halaman laporan dengan pesan sukses
        return redirect()->route('laporan')->with('success', 'Laporan berhasil dihapus.');
    }

    public function allActivities()
    {
        $activities = \App\Models\Notifikasi::with('user')->latest()->paginate(20);
        return view('admin.activities', compact('activities'));
    }

    public function getNotifikasi()
    {
        $notifs = Auth::user()
            ->notifications()
            ->latest()
            ->get();

        return response()->json($notifs);
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'type' => 'required|in:donatur,penerima,donasi,verifikasi,ulasan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data berdasarkan tipe laporan
        $data = [];
        switch ($type) {
            case 'donatur':
                $data = User::where('role', 'donatur')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get(['id', 'name', 'email', 'alamat', 'telepon', 'is_active', 'created_at']);
                break;
            case 'penerima':
                $data = User::where('role', 'penerima')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get(['id', 'name', 'email', 'alamat', 'telepon', 'is_active', 'created_at']);
                break;
            case 'donasi':
                $data = Donasi::with('user')
                    ->whereBetween('tanggal', [$startDate, $endDate])
                    ->orderBy('tanggal', 'desc')
                    ->get(['id', 'judul_buku', 'kategori', 'status', 'tanggal', 'user_id']);
                break;
            case 'verifikasi':
                $data = Pengajuan::with(['user', 'buku'])
                    ->whereBetween('tanggal', [$startDate, $endDate])
                    ->orderBy('tanggal', 'desc')
                    ->get(['id', 'user_id', 'buku_id', 'status', 'tanggal']);
                break;
            case 'ulasan':
                $data = Review::with(['reviewer', 'reviewed'])
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get(['id', 'reviewer_id', 'reviewed_id', 'rating', 'comment', 'created_at']);
                break;
        }

        // Simpan entri laporan ke database
        Report::create([
            'file_name' => "Laporan_{$type}_" . now()->format('Y-m-d') . ".pdf",
            'type'      => $type,
            'format'    => 'pdf',
            'date'      => now(),
            'start_date' => $startDate,
            'end_date'   => $endDate,
        ]);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Laporan berhasil dihasilkan.'
        ]);
    }
}