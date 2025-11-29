<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['donasi_id', 'user_type', 'user_id', 'rating', 'comment', 'reviewed_by'];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function donatur()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'donatur');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'penerima');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getReviewerNameAttribute()
    {
        if ($this->user_type === 'donatur') {
            return $this->donatur?->name ?? 'Donatur';
        }
        return $this->penerima?->name ?? 'Penerima';
    }

    public function getTargetNameAttribute()
    {
        if ($this->user_type === 'donatur') {
            return $this->donasi?->penerima?->name ?? 'Penerima Tidak Diketahui';
        }
        return $this->donasi?->donatur?->name ?? 'Donatur Tidak Diketahui';
    }
}