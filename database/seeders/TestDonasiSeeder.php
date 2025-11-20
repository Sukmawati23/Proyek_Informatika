<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donasi;
use App\Models\User;

class TestDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $donatur = User::where('role', 'donatur')->first();
        if (!$donatur) return;

        Donasi::create([
            'user_id' => $donatur->id,
            'judul_buku' => 'Laskar Pelangi',
            'kategori' => 'fiksi',
            'kondisi' => 'baik',
            'jumlah' => 2,
            'deskripsi' => 'Masih layak baca.',
            'tanggal' => now(),
            'status' => 'menunggu',
        ]);
    }
}
