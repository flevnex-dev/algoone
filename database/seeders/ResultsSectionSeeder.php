<?php

namespace Database\Seeders;

use App\Models\ResultsSection;
use Illuminate\Database\Seeder;

class ResultsSectionSeeder extends Seeder
{
    public function run()
    {
        ResultsSection::create([
            'badge_text' => 'Performance Tracking',
            'title' => 'Proven Track Record',
            'subtitle' => 'Real accounts, real results. All our trading performance is third-party tracked and monitored.',
            'disclaimer' => '"All results shown are from virtual demo accounts and do not represent real profits or guaranteed returns."',
            
            'acc1_name' => 'Account #1',
            'acc1_subtext' => 'Verified',
            'acc1_total_gain' => '+154.63%',
            'acc1_balance' => '$252,124.82',
            'acc1_daily' => '0.71%',
            'acc1_monthly' => '14.86%',
            'acc1_drawdown' => '3.91%',
            'acc1_profit' => '$154,639.72',
            'acc1_deposits' => '$100,000.00',
            'acc1_platform' => 'ICMarkets MT4',

            'acc2_name' => 'Account #2',
            'acc2_subtext' => 'Verified',
            'acc2_total_gain' => '+325.97%',
            'acc2_balance' => '$136,250.22',
            'acc2_daily' => '0.08%',
            'acc2_monthly' => '2.51%',
            'acc2_drawdown' => '3.51%',
            'acc2_profit' => '$240,980.38',
            'acc2_deposits' => '$250,000.00',
            'acc2_platform' => 'Blueberry MT5',

            'acc3_name' => 'Account #3',
            'acc3_subtext' => 'Verified',
            'acc3_total_gain' => '+56.26%',
            'acc3_balance' => '$110,904.26',
            'acc3_daily' => '0.21%',
            'acc3_monthly' => '4.03%',
            'acc3_drawdown' => '2.89%',
            'acc3_profit' => '$420,115.63',
            'acc3_deposits' => '$1,139,530.06',
            'acc3_platform' => 'ICMarkets MT4',

            'summary_title' => 'Over <span class="bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">$815K</span> in Demo Performance',
            'summary_description' => 'Our algorithms have generated consistent returns across multiple virtual demo accounts. Track our verified performance and see real results.',
            'view_results_text' => 'View All Results',
            'view_results_link' => '#',
            
            'myfxbook_text' => 'Check Myfxbook',
            'myfxbook_link' => '#',
            'payout_text' => 'Check Payouts',
            'payout_link' => '#',

            'is_active' => true,
        ]);
    }
}
