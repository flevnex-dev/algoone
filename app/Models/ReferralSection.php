<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'is_active',
        'tiers'
    ];

    protected $casts = [
        'tiers' => 'array',
        'is_active' => 'boolean',
    ];

    //
}
