<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultsSection extends Model
{
    protected $fillable = [
        'banner_text',
        'badge_text', 'title', 'subtitle', 'disclaimer',
        'primary_cta_text', 'primary_cta_link',
        'accounts', // JSON column for dynamic accounts
        'summary_title', 'summary_description', 'view_results_text', 'view_results_link',
        'myfxbook_text', 'myfxbook_link',
        'payout_text', 'payout_link',
        'final_cta_title', 'final_cta_description', 'final_cta_btn_text', 'final_cta_btn_link',
        'is_active'
    ];

    protected $casts = [
        'accounts' => 'array',
        'is_active' => 'boolean',
    ];
    //
}
