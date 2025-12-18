<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Topbar::create([
            'content' => 'LIMITED TIME: We\'re covering <span class="underline font-bold">30% of fees</span>',
            'extra_content' => '+ Most prop firms have BOGO offers!',
            'is_active' => true,
        ]);
    }
}
