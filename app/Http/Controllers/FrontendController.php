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
        return view('frontend.sign-in');
    }

    public function signUp()
    {
        return view('frontend.sign-up');
    }

    public function buyFunding()
    {
        return view('frontend.buy-funding');
    }

    public function liveResults()
    {
        return view('frontend.live-results');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function termsConditions()
    {
        return view('frontend.terms-conditions');
    }

    public function pastPerformance()
    {
        return view('frontend.past-performance');
    }

    public function payout()
    {
        return view('frontend.payout');
    }

    public function officialMyfxbooks()
    {
        return view('frontend.official-myfxbooks');
    }

    public function referrals()
    {
        return view('frontend.referrals');
    }

    public function referralsPublic()
    {
        return view('frontend.referrals-public');
    }

    public function masterclass()
    {
        return view('frontend.masterclass');
    }

    public function progress()
    {
        return view('frontend.progress');
    }
}
