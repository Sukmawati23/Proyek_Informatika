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
        'jumlah',
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

    public function donatur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
