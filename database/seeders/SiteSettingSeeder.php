<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run()
    {
        SiteSetting::create([
            'site_title' => 'AlgoOne',
            'logo' => 'assets/image/logo.png', // Assuming default, will check frontend later
            'copyright_text' => '© 2025 AlgoOne. All rights reserved.',
            'legal_disclaimer' => '<strong class="text-white/80">LEGAL DISCLAIMER</strong> — Notwithstanding any representations, warranties, or statements to the contrary contained herein or elsewhere, all quantitative performance indicators, statistical analyses, trading results, and any associated data visualizations or informational content displayed are NON-FACTUAL and constitute hypothetical simulations exclusively for demonstrative purposes. No actual transactions occur on this platform, and past performance is not indicative of future results.',
        ]);
    }
}
