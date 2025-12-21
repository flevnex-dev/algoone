<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topbar = \App\Models\Topbar::where('is_active', true)->latest()->first();
        $hero = \App\Models\HeroSection::where('is_active', true)->first();
        $signal = \App\Models\SignalSection::where('is_active', true)->first();
        $howItWorks = \App\Models\HowItWorksSection::where('is_active', true)->first();
        $results = \App\Models\ResultsSection::where('is_active', true)->first();
        $whyChoose = \App\Models\WhyChooseSection::where('is_active', true)->first();
        $referral = \App\Models\ReferralSection::where('is_active', true)->first();
        $cta = \App\Models\CtaSection::where('is_active', true)->first();
        $setting = \App\Models\SiteSetting::first();
        return view('frontend.index', compact('topbar', 'hero', 'signal', 'howItWorks', 'results', 'whyChoose', 'referral', 'cta', 'setting'));
    }

    public function signIn()
    {
        $setting = \App\Models\SiteSetting::first();
        return view('frontend.sign-in', compact('setting'));
    }

    public function signUp()
    {
        $setting = \App\Models\SiteSetting::first();
        return view('frontend.sign-up', compact('setting'));
    }

    public function buyFunding()
    {
        $setting = \App\Models\SiteSetting::first();
        $buyFunding = \App\Models\BuyFundingSection::where('is_active', true)->first();
        
        // Initialize default chart data if not exists
        if ($buyFunding && empty($buyFunding->chart_data)) {
            $buyFunding->chart_data = [
                'labels' => ['$5k', '$10k', '$25k', '$50k', '$100k', '$200k', '$300k', '$400k'],
                'data' => [250, 500, 1250, 2500, 5000, 10000, 15000, 20000],
            ];
            $buyFunding->save();
        }
        
        return view('frontend.buy-funding', compact('setting', 'buyFunding'));
    }

    public function liveResults()
    {
        return view('frontend.live-results');
    }

    public function privacy()
    {
        $setting = \App\Models\SiteSetting::first();
        $privacy = \App\Models\PrivacyPolicySection::where('is_active', true)->first();
        return view('frontend.privacy', compact('setting', 'privacy'));
    }

    public function termsConditions()
    {
        $setting = \App\Models\SiteSetting::first();
        $terms = \App\Models\TermsConditionsSection::where('is_active', true)->first();
        return view('frontend.terms-conditions', compact('setting', 'terms'));
    }

    public function pastPerformance()
    {
        $pastPerformanceSection = \App\Models\PastPerformanceSection::where('is_active', true)->first();
        $setting = \App\Models\SiteSetting::first();
        return view('frontend.past-performance', compact('pastPerformanceSection', 'setting'));
    }

    public function payout()
    {
        return view('frontend.payout');
    }

    public function officialMyfxbooks()
    {
        $officialMyfxbooksSection = \App\Models\OfficialMyfxbooksSection::where('is_active', true)->first();
        $accounts = \App\Models\MyfxbookAccount::where('is_active', true)->orderBy('id')->get();
        $setting = \App\Models\SiteSetting::first();
        
        // Calculate average gain and average drawdown from chart data
        $averageGain = 0;
        $averageDrawdown = 0;
        $activeAccountsCount = $accounts->count();
        
        if ($activeAccountsCount > 0) {
            $totalGainSum = 0;
            $totalDrawdownSum = 0;
            
            foreach ($accounts as $account) {
                // Extract numeric value from total_gain (e.g., "+154.63%" -> 154.63)
                $totalGainStr = $account->total_gain ?? '0%';
                $totalGainValue = floatval(str_replace(['+', '%'], '', $totalGainStr));
                $totalGainSum += $totalGainValue;
                
                // Extract numeric value from drawdown (e.g., "3.91%" -> 3.91)
                $drawdownStr = $account->drawdown ?? '0%';
                $drawdownValue = floatval(str_replace('%', '', $drawdownStr));
                $totalDrawdownSum += $drawdownValue;
            }
            
            $averageGain = $totalGainSum / $activeAccountsCount;
            $averageDrawdown = $totalDrawdownSum / $activeAccountsCount;
        }
        
        return view('frontend.official-myfxbooks', compact('officialMyfxbooksSection', 'accounts', 'setting', 'averageGain', 'averageDrawdown'));
    }

    public function referrals()
    {
        $setting = \App\Models\SiteSetting::first();
        $referral = \App\Models\ReferralSection::where('is_active', true)->first();
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('frontend.sign-in');
        }
        
        // Generate referral code if not exists
        $referralCode = $user->generateReferralCode();
        
        // Get or create referral stats
        $referralStat = \App\Models\ReferralStat::firstOrCreate(
            ['user_id' => $user->id],
            [
                'total_clicks' => 0,
                'unique_visitors' => 0,
                'conversions' => 0,
                'conversion_rate' => 0.00,
                'referral_count' => 0,
            ]
        );
        
        // Update conversion rate if needed
        if ($referralStat->unique_visitors > 0 && $referralStat->conversions > 0) {
            $referralStat->conversion_rate = ($referralStat->conversions / $referralStat->unique_visitors) * 100;
            $referralStat->save();
        }
        
        // Generate referral link
        $referralLink = route('frontend.referrals-public') . '?ref=' . $referralCode;
        
        // Determine user tier dynamically based on referral_sections data
        $tierName = 'Basic Tier';
        $tierRange = '0-2 referrals';
        $userReferralCount = $referralStat->referral_count;
        
        if ($referral && !empty($referral->tiers)) {
            // Sort tiers by their minimum range value (ascending order)
            $sortedTiers = collect($referral->tiers)->sortBy(function($tier) {
                $range = $tier['range'] ?? '';
                // Extract minimum number from range string
                if (preg_match('/(\d+)/', $range, $matches)) {
                    return (int)$matches[1];
                }
                return 0;
            })->values()->all();
            
            // Find matching tier based on referral count
            foreach ($sortedTiers as $tier) {
                $range = $tier['range'] ?? '';
                $tierName = $tier['name'] ?? 'Basic Tier';
                $tierRange = $range;
                
                // Parse range: "0-2 referrals", "2-5 referrals", "5+ referrals"
                if (preg_match('/(\d+)\s*-\s*(\d+)/', $range, $matches)) {
                    // Range format: "0-2", "2-5"
                    $min = (int)$matches[1];
                    $max = (int)$matches[2];
                    if ($userReferralCount >= $min && $userReferralCount <= $max) {
                        break;
                    }
                } elseif (preg_match('/(\d+)\s*\+/', $range, $matches)) {
                    // Range format: "5+"
                    $min = (int)$matches[1];
                    if ($userReferralCount >= $min) {
                        break;
                    }
                } elseif (preg_match('/(\d+)/', $range, $matches)) {
                    // Single number format
                    $min = (int)$matches[1];
                    if ($userReferralCount >= $min) {
                        break;
                    }
                }
            }
        }
        
        return view('frontend.referrals', compact('setting', 'referral', 'user', 'referralStat', 'referralLink', 'tierName', 'tierRange'));
    }

    public function referralsPublic(Request $request)
    {
        $setting = \App\Models\SiteSetting::first();
        $referral = \App\Models\ReferralSection::where('is_active', true)->first();
        
        // Track referral click if ref parameter exists
        if ($request->has('ref') && $request->ref) {
            $referralCode = $request->ref;
            $referrer = \App\Models\User::where('referral_code', $referralCode)->first();
            
            if ($referrer) {
                $referralStat = \App\Models\ReferralStat::firstOrCreate(
                    ['user_id' => $referrer->id],
                    [
                        'total_clicks' => 0,
                        'unique_visitors' => 0,
                        'conversions' => 0,
                        'conversion_rate' => 0.00,
                        'referral_count' => 0,
                    ]
                );
                
                // Increment total clicks
                $referralStat->increment('total_clicks');
                
                // Track unique visitor (using session)
                if (!$request->session()->has('referral_visitor_' . $referralCode)) {
                    $referralStat->increment('unique_visitors');
                    $request->session()->put('referral_visitor_' . $referralCode, true);
                }
                
                // Store referrer_id in session for sign-up tracking
                $request->session()->put('referrer_id', $referrer->id);
                
                // Redirect to home page with referral tracking
                return redirect()->route('frontend.index')->with('referral_tracked', true);
            }
        }
        
        // If no ref parameter or invalid referral code, show normal referrals-public page
        return view('frontend.referrals-public', compact('setting', 'referral'));
    }

    public function masterclass()
    {
        $setting = \App\Models\SiteSetting::first();
        $topbar = \App\Models\Topbar::where('is_active', true)->latest()->first();
        $masterclass = \App\Models\MasterclassSection::where('is_active', true)->first();
        
        // Initialize default modules if empty
        if ($masterclass && empty($masterclass->modules)) {
            $defaultModules = [];
            for ($i = 1; $i <= 10; $i++) {
                $defaultModules[] = [
                    'title' => "Module {$i}",
                    'video_url' => 'https://www.youtube.com/embed/nR32hc8qcpA',
                    'status' => 'pending'
                ];
            }
            $masterclass->modules = $defaultModules;
            $masterclass->save();
        }
        
        return view('frontend.masterclass', compact('setting', 'topbar', 'masterclass'));
    }

    public function progress()
    {
        $setting = \App\Models\SiteSetting::first();
        $topbar = \App\Models\Topbar::where('is_active', true)->latest()->first();
        $guideline = \App\Models\ProgressGuideline::where('is_active', true)->first();
        $user = auth()->user();
        
        // Get or create user progress (default: Step 1 completed = 33%)
        $userProgress = \App\Models\UserProgress::firstOrCreate(
            ['user_id' => $user->id],
            [
                'progress_percentage' => 33, // Default: Step 1 completed
                'phase1_completed' => true,
                'phase2_completed' => false,
                'live_phase_completed' => false,
                'live_phase_in_progress' => false,
            ]
        );
        
        // If existing user has 0% progress, update to 33% (default)
        if ($userProgress->progress_percentage == 0) {
            $userProgress->update([
                'progress_percentage' => 33,
                'phase1_completed' => true,
            ]);
        }
        
        return view('frontend.progress', compact('setting', 'topbar', 'guideline', 'userProgress'));
    }
}
