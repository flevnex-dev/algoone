<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseSection extends Model
{
    protected $fillable = [
        'title', 'subtitle',
        'card1_title', 'card1_description', 'card1_image',
        'card2_title', 'card2_description', 'card2_image',
        'card3_title', 'card3_description', 'card3_image',
        'card4_title', 'card4_description', 'card4_image',
        'card5_title', 'card5_description', 'card5_image',
        'card6_title', 'card6_description', 'card6_image',
        'is_active'
    ];
    //
}
