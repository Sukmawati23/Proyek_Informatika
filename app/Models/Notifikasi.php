<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pesan'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function notifikasis()
{
    return $this->hasMany(Notifikasi::class);
}
}

