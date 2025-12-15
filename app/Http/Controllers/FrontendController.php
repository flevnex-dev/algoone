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
        return view('frontend.index');
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
