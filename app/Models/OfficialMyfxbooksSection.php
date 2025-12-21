<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialMyfxbooksSection extends Model
{
    protected $fillable = [
        'verified_badge_text',
        'page_title',
        'page_subtitle',
        'intro_text1',
        'intro_text2',
        'disclaimer_note',
        'cta_title',
        'cta_text',
        'cta_button_text',
        'cta_button_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
