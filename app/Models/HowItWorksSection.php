<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWorksSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'step1_title',
        'step1_description',
        'step1_image',
        'step2_title',
        'step2_description',
        'step2_image',
        'step3_title',
        'step3_description',
        'step3_image',
        'is_active',
    ];

    //
}
