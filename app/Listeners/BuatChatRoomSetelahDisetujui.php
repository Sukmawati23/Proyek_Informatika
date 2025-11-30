<?php

namespace App\Listeners;

use App\Events\PengajuanDisetujui;
use App\Models\ChatRoom;
use App\Models\Notifikasi;

class BuatChatRoomSetelahDisetujui
{
    public function handle(PengajuanDisetujui $event)
    {
        $pengajuan = $event->pengajuan;
        $buku = $pengajuan->buku;
        $donasi = $buku->donasi;

        // Buat atau ambil room chat
        $room = ChatRoom::firstOrCreate([
            'donatur_id' => $donasi->user_id,
            'penerima_id' => $pengajuan->user_id,
            'donasi_id' => $donasi->id,
        ]);

        // Kirim notifikasi dengan chat_room_id
        Notifikasi::create([
            'user_id' => $pengajuan->user_id,
            'chat_room_id' => $room->id, // ✅ Ini yang penting!
            'pesan' => "Pengajuan buku \"{$buku->judul}\" telah disetujui. Silakan koordinasi pengiriman dengan donatur melalui chat.",
        ]);
    }
}