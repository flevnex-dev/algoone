<?php

namespace Database\Seeders;

use App\Models\WhyChooseSection;
use Illuminate\Database\Seeder;

class WhyChooseSectionSeeder extends Seeder
{
    public function run()
    {
        WhyChooseSection::create([
            'title' => 'Why Choose AlgoOne?',
            'subtitle' => 'Risk-free trading management you can trust',

            'card1_title' => 'Zero Risk Guarantee',
            'card1_description' => 'We cover 30% of your challenge fee. If we fail to pass, we refund everything plus $500.',
            'card1_image' => 'assets/image/check-mark.png',

            'card2_title' => 'MYFXBook Verified',
            'card2_description' => 'All our trading results are third-party tracked with full transparency and accountability on demo accounts.',
            'card2_image' => 'assets/image/check-mark.png',

            'card3_title' => 'Real-Time Tracking',
            'card3_description' => 'Monitor your account performance 24/7 through our intuitive dashboard.',
            'card3_image' => 'assets/image/check-mark.png',

            'card4_title' => 'Educational Resources',
            'card4_description' => 'Access exclusive trading education videos and materials to learn alongside us.',
            'card4_image' => 'assets/image/check-mark.png',

            'card5_title' => 'Performance-Based Model',
            'card5_description' => 'We only take 30% of your profits. No profits? No fees. Our interests are perfectly aligned.',
            'card5_image' => 'assets/image/check-mark.png',

            'card6_title' => 'Institutional Grade Trading',
            'card6_description' => 'Hedge fund quality algorithms and risk management systems protecting every trade.',
            'card6_image' => 'assets/image/check-mark.png',

            'is_active' => true,
        ]);
    }
}
