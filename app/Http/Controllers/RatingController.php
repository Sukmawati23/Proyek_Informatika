<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    // === PENERIMA ===
    public function showForm($notifId)
    {
        // ambil notifikasi milik user saat ini
        $notif = auth()->user()->notifications()->findOrFail($notifId);
        return view('rating.form', compact('notif'));
    }

    public function store(Request $request, $notifId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        $notif = auth()->user()->notifications()->findOrFail($notifId);

        Rating::create([
            'notification_id' => $notif->id,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'ulasan' => $validated['ulasan'],
        ]);

        return redirect()->route('dashboard.penerima')->with('success', 'Rating berhasil dikirim!');
    }

    // === DONATUR ===
    public function showFormDonatur($notifId)
    {
        $notif = auth()->user()->notifications()->findOrFail($notifId);
        return view('rating.form', compact('notif'));
    }

    public function storeDonatur(Request $request, $notifId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        $notif = auth()->user()->notifications()->findOrFail($notifId);

        Rating::create([
            'notification_id' => $notif->id,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'ulasan' => $validated['ulasan'],
        ]);

        return redirect()->route('dashboard.donatur')->with('success', 'Rating berhasil dikirim!');
    }
}