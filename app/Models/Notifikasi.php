<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = ['user_id','partner_id', 'pesan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function partner()
{
    return $this->belongsTo(User::class, 'partner_id');
}

}
