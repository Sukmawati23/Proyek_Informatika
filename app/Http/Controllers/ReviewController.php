<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Models\Review;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function showForm($pengajuanId)
    {
        $pengajuan = Pengajuan::with(['user', 'buku'])->findOrFail($pengajuanId);

        // Hanya penerima/donatur yang boleh akses
        if (Auth::id() !== $pengajuan->user_id && Auth::id() !== $pengajuan->buku->user_id) {
            abort(403);
        }

        // Status harus disetujui
        if ($pengajuan->status !== 'disetujui') {
            return back()->withErrors(['error' => 'Ulasan hanya bisa diberikan setelah pengajuan disetujui.']);
        }

        $sudahUlasan = Review::where('pengajuan_id', $pengajuan->id)
            ->where('reviewer_id', Auth::id())
            ->exists();

        return view('ulasan.form', compact('pengajuan', 'sudahUlasan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_id' => 'required|exists:pengajuans,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $pengajuan = Pengajuan::with('buku')->findOrFail($request->pengajuan_id);
        if ($pengajuan->status !== 'disetujui') {
            return back()->withErrors(['error' => 'Ulasan hanya bisa diberikan setelah pengajuan disetujui.']);
        }

        $reviewerId = Auth::id();
        $reviewerRole = Auth::user()->role;

        if ($reviewerRole === 'penerima') {
            $reviewedId = $pengajuan->buku->user_id;
            $reviewedRole = 'donatur';
        } else {
            $reviewedId = $pengajuan->user_id;
            $reviewedRole = 'penerima';
        }

        if (Review::where('pengajuan_id', $pengajuan->id)->where('reviewer_id', $reviewerId)->exists()) {
            return back()->withErrors(['error' => 'Anda sudah memberikan ulasan untuk transaksi ini.']);
        }

        Review::create([
            'pengajuan_id' => $pengajuan->id,
            'reviewer_id' => $reviewerId,
            'reviewed_id' => $reviewedId,
            'reviewer_role' => $reviewerRole,
            'reviewed_role' => $reviewedRole,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
}