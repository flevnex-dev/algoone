<?php

namespace Database\Seeders;

use App\Models\ReferralSection;
use Illuminate\Database\Seeder;

class ReferralSectionSeeder extends Seeder
{
    public function run()
    {
        ReferralSection::create([
            'title' => 'Referral Program',
            'subtitle' => 'Earn free funding and revenue share by referring traders.',
            'button_text' => 'Learn More About Referrals',
            'button_link' => route('frontend.referrals-public', [], false),
            'is_active' => true,
            'tiers' => [
                [
                    'name' => 'Basic Tier',
                    'range' => '0-2 referrals',
                    'icon' => 'assets/image/group.png',
                    'badge_text' => null,
                    'badge_icon' => null,
                    'benefits' => [
                        [
                            'icon' => 'assets/image/gift (2).png',
                            'text' => 'Get the same account size your referral receives'
                        ],
                        [
                            'icon' => 'assets/image/trend (4).png',
                            'text' => 'Earn 10% of every payout'
                        ]
                    ]
                ],
                [
                    'name' => 'Premium Tier',
                    'range' => '2-5 referrals',
                    'icon' => 'assets/image/crown (1).png',
                    'badge_text' => 'POPULAR',
                    'badge_icon' => null,
                    'benefits' => [
                        [
                            'icon' => 'assets/image/gift (1).png',
                            'text' => 'FREE <span class="text-blue-600 font-bold">$100K</span> account bonus'
                        ],
                        [
                            'icon' => 'assets/image/trend (3).png',
                            'text' => 'Earn <span class="text-blue-600 font-bold">15%</span> of every payout'
                        ]
                    ]
                ],
                [
                    'name' => 'Platinum',
                    'range' => '5+ referrals',
                    'icon' => 'assets/image/flash (1).png',
                    'badge_text' => 'ELITE',
                    'badge_icon' => 'assets/image/diamond.png',
                    'benefits' => [
                        [
                            'icon' => 'assets/image/wallet (1).png',
                            'text' => '<span class="font-bold text-amber-600">50% off</span> funding increases'
                        ],
                        [
                            'icon' => 'assets/image/gift (1).png',
                            'text' => 'FREE <span class="font-bold text-amber-600">$200K</span> account'
                        ],
                        [
                            'icon' => 'assets/image/crown (1).png',
                            'text' => 'Priority managed accounts'
                        ]
                    ]
                ]
            ]
        ]);
    }
}
