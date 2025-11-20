<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donasi;

class Buku extends Model
{
    protected $fillable = [
        'user_id',      // donatur
        'donasi_id',    // asal donasi
        'judul',
        'penulis',
        'kategori',
        'status_buku',  // ✅ 'tersedia', 'diajukan', 'terkirim'
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'foto',
    ];

    // Opsional: batasi nilai status_buku
    protected $casts = [
        'status_buku' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
