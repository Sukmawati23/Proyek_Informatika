<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Donatur extends Model
{
    protected $table = 'donaturs'; // sesuaikan kalau perlu

    // RELASI POLYMORPHIC YANG BENAR (Laravel 9+)
    public function reviews(): MorphMany
    {
        return $this->morphMany(\App\Models\Review::class, 'reviewable');
    }
}