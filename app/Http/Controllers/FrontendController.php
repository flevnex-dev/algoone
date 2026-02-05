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
        
        // Calculate performance stats from past performance data
        $performanceStats = $this->calculatePerformanceStats();
        
        return view('frontend.index', compact('topbar', 'hero', 'signal', 'howItWorks', 'results', 'whyChoose', 'referral', 'cta', 'setting', 'performanceStats'));
    }
    
    /**
     * Calculate performance statistics from trading weeks
     */
    private function calculatePerformanceStats()
    {
        // Get all active trading weeks with their performance details
        $tradingWeeks = \App\Models\TradingWeek::where('is_active', true)
            ->with('performanceDetail')
            ->get();
        
        // Calculate total performance (sum of all account sizes)
        $totalPerformance = $tradingWeeks->sum(function($week) {
            return $week->account_size ?? 0;
        });
        
        // Calculate average gain from all weeks
        $avgGain = 0;
        $weeksWithGain = $tradingWeeks->filter(function($week) {
            return $week->total_gain !== null && $week->total_gain > 0;
        });
        if ($weeksWithGain->count() > 0) {
            $avgGain = $weeksWithGain->avg('total_gain');
        }
        
        // Calculate average drawdown from performance details
        $avgDrawdown = 0;
        $drawdowns = $tradingWeeks->filter(function($week) {
            return $week->performanceDetail && 
                   $week->performanceDetail->largest_drawdown !== null && 
                   $week->performanceDetail->largest_drawdown != 0;
        })->map(function($week) {
            return abs($week->performanceDetail->largest_drawdown);
        });
        if ($drawdowns->count() > 0) {
            $avgDrawdown = $drawdowns->avg();
        }
        
        // Count total traders (users with role 'trader' or all users)
        $totalTraders = \App\Models\User::where('role', 'trader')->count();
        // If no traders with role, count all users
        if ($totalTraders == 0) {
            $totalTraders = \App\Models\User::count();
        }
        
        // Calculate progress percentage (based on a target, e.g., 1000K = 100%)
        // You can adjust the target as needed
        $targetPerformance = 1000000; // $1M target
        $progressPercentage = 85; // Default
        if ($targetPerformance > 0 && $totalPerformance > 0) {
            $progressPercentage = min(100, max(0, ($totalPerformance / $targetPerformance) * 100));
        }
        
        return [
            'total_performance' => $totalPerformance,
            'avg_gain' => round($avgGain, 1),
            'avg_drawdown' => round($avgDrawdown, 1),
            'total_traders' => $totalTraders,
            'progress_percentage' => round($progressPercentage, 0),
        ];
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
    public function results(Request $request)
    {
        $setting = \App\Models\SiteSetting::first();
        return view('frontend.results', compact('setting'));
    }
    public function liveResults(Request $request)
    {
        $setting = \App\Models\SiteSetting::first();
        
        // Get approved live results (oldest first, so latest appears at bottom)
        $liveResults = \App\Models\LiveResult::where('status', 'approved')
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->take(20)
            ->get();
        
        // Get pending message from session (if redirected from login)
        $pendingMessage = $request->session()->get('pending_live_result_message');
        
        return view('frontend.live-results', compact('setting', 'liveResults', 'pendingMessage'));
    }

    public function storeLiveResult(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            // Store message in session for after login
            $request->session()->put('pending_live_result_message', $request->message);
            $request->session()->put('intended_url', route('frontend.live-results'));
            
            return redirect()->route('frontend.sign-in')
                ->with('info', 'Please login to submit your success story');
        }

        $validated = $request->validate([
            'message' => 'required|string|min:5|max:1000',
            'amount' => 'nullable|numeric|min:0',
        ]);

        // Get user's latest payout amount if amount not provided
        if (empty($validated['amount'])) {
            $latestPayout = \App\Models\Payout::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->orderBy('payout_date', 'desc')
                ->first();
            
            if ($latestPayout) {
                $validated['amount'] = $latestPayout->amount;
            }
        }

        \App\Models\LiveResult::create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
            'amount' => $validated['amount'],
            'status' => 'pending', // Pending admin approval
        ]);

        // Clear pending message from session
        $request->session()->forget('pending_live_result_message');

        return redirect()->route('frontend.live-results')
            ->with('success', 'Your success story has been submitted for approval!');
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
        
        // Get all active weeks, ordered so that "current" and "last" appear at the end
        $weeks = \App\Models\TradingWeek::where('is_active', true)
            ->orderByRaw("CASE 
                WHEN week_type = 'normal' THEN 1 
                WHEN week_type = 'last' THEN 2 
                WHEN week_type = 'current' THEN 3 
                ELSE 4 
            END")
            ->orderBy('display_order')
            ->orderBy('start_date', 'desc')
            ->with('performanceDetail')
            ->get();
        
        // Get current week (or latest if no current)
        $currentWeek = \App\Models\TradingWeek::where('week_type', 'current')
            ->where('is_active', true)
            ->with('performanceDetail')
            ->first();
        
        // If no current week, get the latest week
        if (!$currentWeek && $weeks->count() > 0) {
            $currentWeek = $weeks->first();
        }
        
        return view('frontend.past-performance', compact(
            'pastPerformanceSection', 
            'setting', 
            'weeks', 
            'currentWeek'
        ));
    }

    public function getWeekData($id)
    {
        $week = \App\Models\TradingWeek::with('performanceDetail')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'week' => [
                'id' => $week->id,
                'week_label' => $week->week_label,
                'start_date' => $week->start_date->format('d/m/y'),
                'end_date' => $week->end_date->format('d/m/y'),
                'total_gain' => $week->total_gain,
                'account_size' => $week->account_size,
                'end_date_full' => $week->end_date->format('l, F d, Y'),
            ],
            'performance' => $week->performanceDetail ? [
                'total_gain' => $week->performanceDetail->total_gain,
                'trade_accuracy' => $week->performanceDetail->trade_accuracy,
                'risk_reward_ratio' => $week->performanceDetail->risk_reward_ratio,
                'largest_drawdown' => $week->performanceDetail->largest_drawdown,
                'chart_labels' => $week->performanceDetail->chart_labels ?? [],
                'chart_data' => $week->performanceDetail->chart_data ?? [],
                'markets_traded' => $week->performanceDetail->markets_traded ?? [],
                'daily_performance' => $week->performanceDetail->daily_performance ?? [],
            ] : null,
        ]);
    }

    public function payout()
    {
        $setting = \App\Models\SiteSetting::first();
        
        // Get all public payouts
        $payouts = \App\Models\Payout::where('is_public', true)
            ->where('status', 'completed')
            ->orderBy('payout_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate statistics
        $totalPaid = $payouts->sum('amount');
        $totalPayouts = $payouts->count();
        $averagePayout = $totalPayouts > 0 ? $totalPaid / $totalPayouts : 0;
        $highestPayout = $payouts->max('amount') ?? 0;
        
        // Get current month payouts
        $currentMonth = now()->format('Y-m');
        $currentMonthPayouts = $payouts->filter(function($payout) use ($currentMonth) {
            return $payout->payout_date->format('Y-m') === $currentMonth;
        });
        $payoutsThisMonth = $currentMonthPayouts->count();
        $currentMonthTotal = $currentMonthPayouts->sum('amount');
        
        // Calculate month-wise totals from payment dates (Jan to Dec of current year)
        $currentYear = now()->format('Y');
        $monthlyPayouts = $payouts->groupBy(function($payout) {
            return $payout->payout_date->format('Y-m');
        })->map(function($group) {
            return $group->sum('amount');
        });
        
        // Generate data for all 12 months (January to December) - Monthly amounts, not cumulative
        $cumulativeData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $monthKey = sprintf('%s-%02d', $currentYear, $month);
            $monthAmount = $monthlyPayouts->get($monthKey, 0);
            
            $cumulativeData[] = [
                'month' => $monthKey,
                'amount' => round($monthAmount, 2) // Monthly amount, not cumulative
            ];
        }
        
        // Get latest month's payouts for detailed table
        $latestMonth = $payouts->first() ? $payouts->first()->payout_date->format('F Y') : now()->format('F Y');
        $latestMonthPayouts = $payouts->filter(function($payout) use ($payouts) {
            if ($payouts->isEmpty()) return false;
            $latestMonth = $payouts->first()->payout_date->format('Y-m');
            return $payout->payout_date->format('Y-m') === $latestMonth;
        });
        
        return view('frontend.payout', compact(
            'setting',
            'payouts',
            'totalPaid',
            'totalPayouts',
            'averagePayout',
            'highestPayout',
            'payoutsThisMonth',
            'currentMonthTotal',
            'cumulativeData',
            'latestMonth',
            'latestMonthPayouts'
        ));
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
