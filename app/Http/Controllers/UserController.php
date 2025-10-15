<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Fungsi untuk menyimpan status notifikasi
    public function updateNotification(Request $request)
    {
        $user = Auth::user();
        $user->notif_email = $request->notif_email;
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Preferensi disimpan']);
    }

    // Fungsi untuk mengambil status notifikasi
    public function getEmailNotification()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'notif_email' => $user->notif_email
        ]);
    }
}
