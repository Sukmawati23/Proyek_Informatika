<?php

// app/Events/PengajuanDisetujui.php
namespace App\Events;

use App\Models\Pengajuan;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PengajuanDisetujui
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pengajuan;

    public function __construct(Pengajuan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }
}