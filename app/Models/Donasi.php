<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Buku;

class Donasi extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal' => 'date',
    ];

    protected $fillable = [
        'user_id',
        'penerima_id',
        'judul_buku',
        'kategori',
        'kondisi',
        'penulis',
        'penerbit',
        'jumlah',
        'foto',
        'deskripsi',
        'tanggal',
        'status',
        'alasan_penolakan',
    ];

    // Relasi ke donatur (alias clearer dari `user()`)
    public function donatur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke penerima (nullable)
    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    // Optional: tetap pertahankan user() jika dipakai di tempat lain
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Buku — satu donasi → satu atau banyak buku?  
    // Untuk kesederhanaan (1 donasi = 1 entri buku), gunakan:
    // Jika 1 donasi = 1 buku (sederhana)
    public function buku()
    {
        return $this->hasOne(Buku::class, 'donasi_id');
    }

    // Jika ingin tetap pakai nama `bukus()` (plural), gunakan hasMany:
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'donasi_id');
    }
}