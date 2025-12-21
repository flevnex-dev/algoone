<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicySection extends Model
{
    protected $fillable = [
        'page_title',
        'last_updated',
        'details',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
