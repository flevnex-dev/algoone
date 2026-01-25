<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultsSection extends Model
{
    protected $fillable = [
        'badge_text', 'title', 'subtitle', 'disclaimer',
        'accounts', // JSON column for dynamic accounts
        'summary_title', 'summary_description', 'view_results_text', 'view_results_link',
        'myfxbook_text', 'myfxbook_link',
        'payout_text', 'payout_link',
        'is_active'
    ];

    protected $casts = [
        'accounts' => 'array',
        'is_active' => 'boolean',
    ];
    //
}
