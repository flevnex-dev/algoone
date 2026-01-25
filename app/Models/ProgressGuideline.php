<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressGuideline extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'warning_text',
        'guidelines',
        'is_active',
    ];

    protected $casts = [
        'guidelines' => 'array',
        'is_active' => 'boolean',
    ];
}
