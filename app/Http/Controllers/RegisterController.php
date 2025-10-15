<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Routing\Controller;


class RegisterController extends Controller
{
    public function showRegisterOptions()
    {
        return view('auth.register-options'); // Pastikan nama view sesuai
    }

    public function showDonaturForm()
    {
        return view('auth.register-donatur');
    }

    public function showPenerimaForm()
    {
        return view('auth.register-penerima');
    }

    public function registerDonatur(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
        ]);

        // Menghasilkan kode_user otomatis
        $latest = User::where('role', 'donatur')->orderBy('id', 'desc')->first();
        $next = $latest ? ((int) substr($latest->kode_user, 1)) + 1 : 1;
        $kode = 'D' . str_pad($next, 3, '0', STR_PAD_LEFT);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'donatur',
            'kode_user' => $kode,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        // Login pengguna setelah pendaftaran
        auth()->login($user);

        // Tampilkan halaman verifikasi email
        // return view('auth.verify-email', ['email' => $user->email]);
        // Redirect ke halaman verifikasi email
        return redirect()->route('verification.notice');
    }

    public function registerPenerima(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
        ]);

        // Menghasilkan kode_user otomatis
        $latest = User::where('role', 'penerima')->orderBy('id', 'desc')->first();
        $nextNumber = $latest ? (int) substr($latest->kode_user, 1) + 1 : 1;
        $kode = 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penerima',
            'kode_user' => $kode,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        // Login pengguna setelah pendaftaran
        auth()->login($user);

        // Tampilkan halaman verifikasi email
        //return view('auth.verify-email', ['email' => $user->email]);
        // Redirect ke halaman verifikasi email
        return redirect()->route('verification.notice');
    }
}
