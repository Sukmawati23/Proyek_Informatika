<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function show(Request $request)
    {
        $email = Auth::user()->email;
        return view('auth.verify-email', compact('email'));
    }

    /**
     * ✅ Perbaikan: Custom verify — support email change
     */
    public function verify(Request $request)
    {
        // Pastikan user login
        if (! Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login terlebih dahulu.');
        }

        $user = $request->user();

        // Pastikan parameter `id` dan `hash` ada (signed route)
        if (! $request->hasValidSignature()) {
            return response()->view('errors.403', [], 403);
        }

        // ⭐️ Update: Verifikasi email apa pun — cocokkan ke email SAAAT INI
        // Karena kita tahu user baru saja ubah email & kirim verifikasi ulang
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect()->route('verification.success')
            ->with('verified', true);
    }

    public function resend(Request $request)
    {
        if ($request->user() && ! $request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('status', 'Email verifikasi telah dikirim ulang!');
        }

        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}