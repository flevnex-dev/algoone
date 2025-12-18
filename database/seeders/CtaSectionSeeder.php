<?php

namespace Database\Seeders;

use App\Models\CtaSection;
use Illuminate\Database\Seeder;

class CtaSectionSeeder extends Seeder
{
    public function run()
    {
        CtaSection::create([
            'title' => 'Ready to Start Trading?',
            'description' => 'Join hundreds of traders who trust AlgoOne with their prop firm accounts.',
            'button_text' => 'Create Free Account',
            'button_link' => '#',
            'is_active' => true,
        ]);
    }
}
