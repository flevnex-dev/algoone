<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run()
    {
        HeroSection::create([
            'badge_text' => 'WE ONLY MAKE MONEY WHEN YOU MAKE MONEY',
            'title' => '<span class="block mb-2">Professional</span><span class="block bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-transparent">Prop Firm Trading</span>',
            'description' => 'We pass your prop firm challenges with precision and get you funded. Zero risk - if we fail, we refund you + $500.',
            'rating' => '5.0 Rating',
            'traders_count' => '500+ traders',
            'primary_cta_text' => 'Start Trading Now',
            'signin_cta_text' => 'Sign In',
            'myfxbook_text' => 'Check Myfxbook',
            'payout_text' => 'Check Payouts',
            'is_active' => true,
        ]);
    }
}
