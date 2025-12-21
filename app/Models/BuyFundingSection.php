<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyFundingSection extends Model
{
    protected $fillable = [
        'main_title',
        'main_subtitle',
        'comparison1_small_account_title',
        'comparison1_small_account_profit',
        'comparison1_small_account_label',
        'comparison1_medium_account_title',
        'comparison1_medium_account_profit',
        'comparison1_medium_account_label',
        'comparison1_button_text',
        'comparison2_medium_account_title',
        'comparison2_medium_account_profit',
        'comparison2_medium_account_label',
        'comparison2_large_account_title',
        'comparison2_large_account_profit',
        'comparison2_large_account_label',
        'comparison2_button_text',
        'chart_title',
        'chart_subtitle',
        'chart_conclusion',
        'chart_data',
        'cta_title',
        'cta_subtitle',
        'cta_button1_text',
        'cta_button2_text',
        'cta_button2_link',
        'is_active',
    ];

    protected $casts = [
        'chart_data' => 'array',
        'is_active' => 'boolean',
    ];
}
