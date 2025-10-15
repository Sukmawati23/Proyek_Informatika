<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Auth::user()->pengajuans()->with('buku')->latest()->get();
        return view('pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $bukus = Buku::where('status_buku', 'tersedia')->get();
        return view('pengajuan.create', compact('bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
            'alasan' => 'required|string'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['tanggal'] = now();
        $validated['status'] = 'menunggu';

        Pengajuan::create($validated);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan buku berhasil diajukan!');
    }

    public function show(Pengajuan $pengajuan)
    {
        return view('pengajuan.show', compact('pengajuan'));
    }
}
