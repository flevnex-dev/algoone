<?php

namespace Database\Seeders;

use App\Models\SignalSection;
use Illuminate\Database\Seeder;

class SignalSectionSeeder extends Seeder
{
    public function run()
    {
        SignalSection::create([
            'badge_text' => 'FREE SIGNALS CHANNEL',
            'title' => 'Elite Trading Signals<br><span class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Completely Free</span>',
            'description' => 'Join our exclusive signals channel where we share professional GBPJPY trades with an exceptional track record.',
            'win_rate' => '80%',
            'risk_reward' => '1:3',
            'primary_market' => 'GBPJPY',
            'why_different_title' => "Why We're Different",
            'why_different_text' => "While others charge hundreds or thousands for signal services, we believe everyone deserves a fair opportunity to start somewhere with trading. Our consistently profitable signals are shared completely free because we know that success in trading shouldn't be locked behind paywalls. Join thousands of traders who trust our analysis and execution on GBPJPY – one of the most reliable currency pairs with excellent volatility and liquidity.",
            'join_button_text' => 'Join Free Signals Now',
            'join_button_link' => '#',
            'is_active' => true,
        ]);
    }
}
