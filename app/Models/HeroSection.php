<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge_text',
        'title',
        'description',
        'rating',
        'traders_count',
        'primary_cta_text',
        'signin_cta_text',
        'myfxbook_text',
        'payout_text',
        'primary_cta_link',
        'signin_cta_link',
        'myfxbook_link',
        'payout_link',
        'is_active',
    ];
}
