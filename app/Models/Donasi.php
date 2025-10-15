<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_buku',
        'kategori',
        'kondisi',
        'foto',
        'tanggal',
        'status',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'buku_donasis');
    }
}
