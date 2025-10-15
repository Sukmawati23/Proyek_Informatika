<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'kode_user' => 'ADM001',
            'email' => 'admin@donasibuku.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'alamat' => 'Pusat Donasi Buku',
            'telepon' => '0895404587176',
            'email_verified_at' => now(),
        ]);
    }
}
