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
        'alamat', // Tambahkan field tambahan jika diperlukan
        'telepon', // Tambahkan field tambahan jika diperlukan
        'email_verified_at', // Penting untuk fitur verifikasi email
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function donasis()
    {
        return $this->hasMany(Donasi::class);
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}