<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Events\PesanBaruDikirim;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rooms = ChatRoom::where('donatur_id', $user->id)
            ->orWhere('penerima_id', $user->id)
            ->with(['donatur', 'penerima', 'donasi'])
            ->get();

        return view('chat.index', compact('rooms'));
    }

    public function show(ChatRoom $room)
    {
        // Cek akses: hanya donatur & penerima yang terlibat bisa akses
        if (!in_array(Auth::id(), [$room->donatur_id, $room->penerima_id])) {
            abort(403);
        }

        $messages = $room->messages()->with('sender')->latest()->paginate(20);
        return view('chat.show', compact('room', 'messages'));
    }

    public function sendMessage(Request $request, ChatRoom $room)
    {
        if (!in_array(Auth::id(), [$room->donatur_id, $room->penerima_id])) {
            abort(403);
        }

        $request->validate(['message' => 'required|string|max:1000']);

        $message = ChatMessage::create([
            'room_id' => $room->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        event(new PesanBaruDikirim($message));

        return back();
    }
}