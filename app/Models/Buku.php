<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'penulis',
        'kategori',
        'status_buku',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donasis()
    {
        return $this->belongsToMany(Donasi::class, 'buku_donasis');
    }
}
