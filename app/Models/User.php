<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kode_user',
        'email_verified_at', // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'string', // Perbaikan di sini
    ];

    // Tambahkan relasi donasis
    public function donasis()
    {
        return $this->hasMany(Donasi::class);
    }

    // Relasi dengan Pengajuan
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}