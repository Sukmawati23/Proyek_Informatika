<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Mail;

Route::get('/', [LandingController::class, 'index']);

Route::get('/register', [RegisterController::class, 'showRegisterOptions'])->name('register.options');

Route::get('/register/donatur', [RegisterController::class, 'showDonaturForm'])->name('register.donatur');
Route::get('/register/penerima', [RegisterController::class, 'showPenerimaForm'])->name('register.penerima');

Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])->name('register.donatur.submit');
Route::post('/register/penerima', [RegisterController::class, 'registerPenerima'])->name('register.penerima.submit');

//Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])->name('register.donatur.submit');
//Route::post('/register/penerima', [RegisterController::class, 'registerPenerima'])->name('register.penerima.submit');

Route::get('/email/verification-notification', [VerificationController::class, 'resend'])->name('verification.resend');

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk lupa kata sandi
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// ... kode lainnya ...

// Rute untuk verifikasi email (sudah ada)
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->name('verification.resend');

// Rute BARU: Halaman notifikasi setelah verifikasi berhasil
Route::get('/email/verification-success', function () {
    // Ambil role user yang sedang login
    $role = auth()->user()->role;
    return view('auth.verification-success', compact('role'));
})->middleware(['auth'])->name('verification.success');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/pengajuan', [PengajuanController::class, 'store']);
    Route::get('/admin/pengajuan', [PengajuanController::class, 'index'])->middleware('is_admin');
    Route::post('/admin/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])->middleware('is_admin')->name('admin.pengajuan.status');
    Route::get('/admin/donasi', [DonasiController::class, 'indexAdmin'])
        ->name('admin.donasi.index')
        ->middleware('is_admin');

    Route::post('/admin/donasi/{id}/verify', [DonasiController::class, 'verify'])
        ->name('admin.donasi.verify')
        ->middleware('is_admin');
});

// Donasi
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
