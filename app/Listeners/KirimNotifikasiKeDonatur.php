<?php

// app/Listeners/KirimNotifikasiKeDonatur.php
namespace App\Listeners;

use App\Events\PesanBaruDikirim;
use App\Models\Notifikasi;
use App\Models\ChatRoom;

class KirimNotifikasiKeDonatur
{
    public function handle(PesanBaruDikirim $event)
    {
        $message = $event->message;
        $room = $message->room;

        // Jika pengirim bukan donatur, kirim notifikasi ke donatur
        if ($message->sender_id != $room->donatur_id) {
            Notifikasi::create([
                'user_id' => $room->donatur_id,
                'pesan' => "Pesan baru dari {$message->sender->name}: \"{$message->message}\"",
                'chat_room_id' => $room->id,
            ]);
        }
    }
}