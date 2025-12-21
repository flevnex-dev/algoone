<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressGuideline extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'warning_text',
        'guideline1_title',
        'guideline1_text',
        'guideline2_title',
        'guideline2_text',
        'guideline3_title',
        'guideline3_text',
        'guideline4_title',
        'guideline4_text',
        'guideline5_title',
        'guideline5_text',
        'guideline6_title',
        'guideline6_text',
        'guideline7_title',
        'guideline7_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
