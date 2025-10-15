<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Import controller

// Route POST untuk menyimpan status notifikasi
Route::post('/update-email-notification', [UserController::class, 'updateNotification']);

// Route GET untuk mengambil status notifikasi
Route::middleware('auth:sanctum')->get('/get-email-notification', [UserController::class, 'getEmailNotification']);

// Route default bawaan Laravel
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
