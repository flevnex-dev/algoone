<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignalSection extends Model
{
    protected $fillable = [
        'badge_text',
        'title',
        'description',
        'win_rate',
        'risk_reward',
        'primary_market',
        'why_different_title',
        'why_different_text',
        'join_button_text',
        'join_button_link',
        'is_active',
    ];

    //
}
