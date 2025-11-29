<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    // Menyimpan ulasan (dipanggil dari modal donatur & penerima)
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'donasi_id' => 'nullable|exists:donasis,id',
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'nullable|string|max:1000'
        ]);

        $review = Review::create([
            'donasi_id'   => $validated['donasi_id'] ?? null,
            'user_type'   => $user->role,
            'user_id'     => $user->id,
            'rating'      => $validated['rating'],
            'comment'     => $validated['comment'],
            'reviewed_by' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas ulasan Anda!',
            'data'    => $review
        ]);
    }

    // Tampilkan di halaman Admin → Laporan → Rating & Ulasan
    public function index()
    {
        $reviews = Review::with(['donasi', 'donatur', 'penerima'])
            ->latest()
            ->get();

        return view('admin.reviews', compact('reviews'));
    }
}