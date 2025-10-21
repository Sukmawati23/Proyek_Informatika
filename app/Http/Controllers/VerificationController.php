<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    // Menampilkan halaman pemberitahuan bahwa email verifikasi telah dikirim
    public function show(Request $request)
    {
        // Ambil email dari user yang sedang login
        $email = Auth::user()->email;
        return view('auth.verify-email', compact('email'));
    }

    // Memverifikasi email pengguna
    public function verify(EmailVerificationRequest $request)
    {
        // Lakukan verifikasi
        $request->fulfill();

        // Redirect ke halaman notifikasi aktivasi
        return redirect()->route('verification.success');
    }

    // Mengirim ulang email verifikasi
    public function resend(Request $request)
    {
        // Pastikan user sudah login
        if ($request->user()) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('status', 'Email verifikasi telah dikirim ulang!');
        }

        // Jika user tidak login, redirect ke login
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}