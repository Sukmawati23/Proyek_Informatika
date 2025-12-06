<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'file_name',
        'type',
        'format',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
