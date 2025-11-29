<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Penerima extends Model
{
    protected $table = 'penerimas'; // sesuaikan kalau perlu

    public function reviews(): MorphMany
    {
        return $this->morphMany(\App\Models\Review::class, 'reviewable');
    }
}