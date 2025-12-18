<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultsSection extends Model
{
    protected $fillable = [
        'badge_text', 'title', 'subtitle', 'disclaimer',
        'acc1_name', 'acc1_subtext', 'acc1_total_gain', 'acc1_balance', 'acc1_daily', 'acc1_monthly', 'acc1_drawdown', 'acc1_profit', 'acc1_deposits', 'acc1_platform',
        'acc2_name', 'acc2_subtext', 'acc2_total_gain', 'acc2_balance', 'acc2_daily', 'acc2_monthly', 'acc2_drawdown', 'acc2_profit', 'acc2_deposits', 'acc2_platform',
        'acc3_name', 'acc3_subtext', 'acc3_total_gain', 'acc3_balance', 'acc3_daily', 'acc3_monthly', 'acc3_drawdown', 'acc3_profit', 'acc3_deposits', 'acc3_platform',
        'summary_title', 'summary_description', 'view_results_text', 'view_results_link',
        'myfxbook_text', 'myfxbook_link',
        'payout_text', 'payout_link',
        'is_active'
    ];
    //
}
