<?php

namespace Database\Seeders;

use App\Models\HowItWorksSection;
use Illuminate\Database\Seeder;

class HowItWorksSectionSeeder extends Seeder
{
    public function run()
    {
        HowItWorksSection::create([
            'title' => 'How It Works',
            'subtitle' => 'Three simple steps to success',
            'step1_title' => 'Get Your Challenge',
            'step1_description' => 'Purchase a prop firm challenge from a trusted firm. We cover 30% of the challenge fee to reduce your upfront cost.',
            'step1_image' => 'assets/image/check-mark.png',
            'step2_title' => 'We Pass It',
            'step2_description' => 'Our expert traders pass your challenge with precision and discipline. If we fail, you get a full refund + $500 guarantee.',
            'step2_image' => 'assets/image/trend.png',
            'step3_title' => 'Get Your Payout',
            'step3_description' => 'You receive your payout from the prop firm. We take 30% of what you take home – only when you profit.',
            'step3_image' => 'assets/image/security.png',
            'is_active' => true,
        ]);
    }
}
