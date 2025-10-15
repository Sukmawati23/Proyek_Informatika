<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller; // Ensure this is imported correctly
use App\Models\User;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Pengajuan;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'admin') {
            $data['total_donatur'] = User::where('role', 'donatur')->count();
            $data['total_penerima'] = User::where('role', 'penerima')->count();
            $data['total_donasi'] = Donasi::count();
            $data['total_pengajuan'] = Pengajuan::count();

            return view('dashboard.admin', $data);
        } elseif ($user->role === 'donatur') {
            $data['donasis'] = $user->donasis()->latest()->take(5)->get();
            return view('dashboard.donatur', $data);
        } elseif ($user->role === 'penerima') {
            $data['pengajuans'] = $user->pengajuans()->with('buku')->latest()->take(5)->get();
            $data['bukus'] = Buku::where('status_buku', 'tersedia')->latest()->take(5)->get();
            return view('dashboard.penerima', $data);
        }

        return redirect('/');
    }
}
