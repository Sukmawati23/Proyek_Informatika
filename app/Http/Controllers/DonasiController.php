<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    public function index()
    {
        $donasis = Auth::user()->donasis()->latest()->get();
        return view('donasi.index', compact('donasis'));
    }

    public function create()
    {
        return view('donasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string'
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('donasi', 'public');
            $validated['foto'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['tanggal'] = now();
        $validated['status'] = 'menunggu';

        Donasi::create($validated);

        return redirect()->route('donasi.index')->with('success', 'Donasi buku berhasil diajukan!');
    }

    public function show(Donasi $donasi)
    {
        return view('donasi.show', compact('donasi'));
    }
}
