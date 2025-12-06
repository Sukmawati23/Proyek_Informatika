<?php

namespace App\Models;

use App\Models\Donasi;
use App\Models\Pengajuan;
use App\Models\Notifikasi;
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
        return $this->hasMany(Donasi::class, 'user_id');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function donasisSebagaiDonatur()
    {
        return $this->hasMany(Donasi::class, 'user_id');
    }

    public function donasisSebagaiPenerima()
    {
        return $this->hasMany(Donasi::class, 'penerima_id');
    }

    public function getTotalDonasiAttribute()
    {
        return $this->donasis()->sum('jumlah');
    }

    public function getTotalDiterimaAttribute()
    {
        // Ambil semua pengajuan yang disetujui oleh penerima ini
        $pengajuans = Pengajuan::where('user_id', $this->id)->where('status', 'disetujui')->get();

        // Jumlahkan kolom `jumlah` dari setiap pengajuan
        return $pengajuans->sum('jumlah');
    }
}
