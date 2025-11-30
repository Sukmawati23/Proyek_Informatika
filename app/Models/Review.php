<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'pengajuan_id',
        'reviewer_id',
        'reviewed_id',
        'reviewer_role',
        'reviewed_role',
        'rating',
        'comment'
    ];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewed()
    {
        return $this->belongsTo(User::class, 'reviewed_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}