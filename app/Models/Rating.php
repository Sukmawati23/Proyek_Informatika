<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Rating extends Model
{
    use HasFactory;

    // Nama tabel (opsional, tapi jelas)
    protected $table = 'ratings';

    // Field yang boleh diisi
    protected $fillable = [
        'donatur_id',
        'penerima_id',
        'donation_id',
        'rating_value',
        'review_text',
    ];

    // Relasi: rating dimiliki oleh donatur
    public function donatur()
    {
        return $this->belongsTo(User::class, 'donatur_id');
    }

    // Relasi: rating dimiliki oleh penerima
    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
