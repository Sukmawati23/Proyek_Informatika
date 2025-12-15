<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;
use App\Models\Buku;

// Buku tersedia (publik)
Route::get('/buku-tersedia', function () {
    return Buku::where('status_buku', '!=', 'habis')->get();
});


// Pengajuan buku (harus login)
Route::middleware('auth:sanctum')->post('/ajukan-buku', [PengajuanController::class, 'store']);

// Notifikasi
Route::post('/update-email-notification', [UserController::class, 'updateNotification']);
Route::middleware('auth:sanctum')->get('/get-email-notification', [UserController::class, 'getEmailNotification']);

// User
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Pengajuan Buku
Route::middleware('auth:sanctum')->post('/ajukan-buku', [PengajuanController::class, 'store']);
