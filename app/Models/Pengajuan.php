<?php

namespace App\Models;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'buku_id',
        'jumlah',
        'tanggal',
        'status',
        'alasan'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Optional: default status
    // protected $attributes = [
    //     'status' => 'Menunggu',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
