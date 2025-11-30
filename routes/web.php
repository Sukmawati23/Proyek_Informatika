<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Models\User;

// === Guest Routes (tanpa autentikasi) ===
Route::get('/', [LandingController::class, 'index']);

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegisterOptions'])->name('register.options');
Route::get('/register/donatur', [RegisterController::class, 'showDonaturForm'])->name('register.donatur');
Route::get('/register/penerima', [RegisterController::class, 'showPenerimaForm'])->name('register.penerima');
Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])->name('register.donatur.submit');
Route::post('/register/penerima', [RegisterController::class, 'registerPenerima'])->name('register.penerima.submit');

// Password Reset
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification (guest)
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice')
    ->middleware('auth');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->name('verification.resend');

// Success setelah verifikasi
Route::get('/email/verification-success', function () {
    return view('auth.verification-success', [
        'role' => auth()->user()->role
    ]);
})->middleware(['auth'])->name('verification.success');

// Donasi Publik
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

// === Authenticated Routes ===
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil: semua route ke UserController
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-email', [UserController::class, 'changeEmail'])->name('profile.changeEmail');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.changePassword');

    // === Profil Routes (dalam grup auth) ===
    Route::get('/profile/get', [UserController::class, 'getProfile'])->name('profile.get');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    // Notifikasi — API-like tapi session-based
    Route::post('/api/update-email-notification', [UserController::class, 'updateNotification']);
    Route::get('/api/get-email-notification', [UserController::class, 'getEmailNotification']);

    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

    Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{room}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{room}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

// === Admin-only Routes ===
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::post('/admin/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])
        ->name('admin.pengajuan.status');

    Route::get('/admin/donasi', [DonasiController::class, 'indexAdmin'])->name('admin.donasi.index');
    Route::post('/admin/donasi/{id}/verify', [DonasiController::class, 'verify'])
        ->name('admin.donasi.verify')
        ->middleware(['auth', 'is_admin']);

    Route::post('/admin/donasi/{id}/update-status', [DonasiController::class, 'updateStatus'])
        ->name('admin.donasi.updateStatus')
        ->middleware(['auth', 'is_admin']);

    Route::post('/admin/donasi/{id}/reject', [DonasiController::class, 'reject'])
        ->name('admin.donasi.reject')
        ->middleware(['auth', 'is_admin']);

    Route::post('/admin/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])
        ->name('admin.pengajuan.status');
});

// === Hapus User (aman via UserController) ===
//Route::delete('/donatur/{id}', [UserController::class, 'destroyDonatur'])->name('donatur.destroy');

Route::delete('/donatur/{id}', [UserController::class, 'destroyDonatur'])
    ->middleware('is_admin')
    ->name('donatur.destroy');

Route::delete('/penerima/{id}', [UserController::class, 'destroyPenerima'])
    ->middleware('is_admin')
    ->name('penerima.destroy');

Route::get('/api/notifikasi', [\App\Http\Controllers\DashboardController::class, 'getNotifikasi'])
    ->middleware('auth');

// Rute untuk generate laporan
Route::post('/generate-report', [DashboardController::class, 'generateReport'])->name('generate.report');

// Rute untuk download laporan
Route::get('/reports/{id}/download', [DashboardController::class, 'downloadReport'])->name('download.report');

// Rute untuk hapus laporan
Route::delete('/reports/{id}', [DashboardController::class, 'deleteReport'])->name('delete.report');