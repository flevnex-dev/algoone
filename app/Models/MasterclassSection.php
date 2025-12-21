<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterclassSection extends Model
{
    protected $fillable = [
        'course_title',
        'course_subtitle',
        'cta_button_text',
        'cta_button_link',
        'modules',
        'is_active',
    ];

    protected $casts = [
        'modules' => 'array',
        'is_active' => 'boolean',
    ];
}
