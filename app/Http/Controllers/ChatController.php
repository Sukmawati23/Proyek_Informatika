<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Notifikasi;
use App\Models\User;

class ChatController extends Controller
{
    // Tampilkan chat berdasarkan notifikasi
    public function showFromNotification($notifId)
    {
        $notif = Notifikasi::findOrFail($notifId);

        // Pastikan notifikasi untuk user login
        if ($notif->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $partnerId = $notif->partner_id;
        $partner = User::find($partnerId);

        // Ambil semua pesan antara user login dan partner
        $messages = Message::where(function($q) use ($partnerId) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $partnerId);
            })
            ->orWhere(function($q) use ($partnerId) {
                $q->where('sender_id', $partnerId)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.show', compact('messages', 'partner', 'partnerId'));
    }

    // Kirim pesan ke partner
    public function send(Request $request, $partnerId)
    {
        $request->validate(['message' => 'required|string']);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $partnerId,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
