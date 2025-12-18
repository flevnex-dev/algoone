<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TopbarController;
use App\Http\Controllers\HomeController;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/sign-in', [FrontendController::class, 'signIn'])->name('frontend.sign-in');
Route::get('/sign-up', [FrontendController::class, 'signUp'])->name('frontend.sign-up');
Route::get('/buy-funding', [FrontendController::class, 'buyFunding'])->name('frontend.buy-funding');
Route::get('/live-results', [FrontendController::class, 'liveResults'])->name('frontend.live-results');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('frontend.privacy');
Route::get('/terms-conditions', [FrontendController::class, 'termsConditions'])->name('frontend.terms-conditions');
Route::get('/past-performance', [FrontendController::class, 'pastPerformance'])->name('frontend.past-performance');
Route::get('/payout', [FrontendController::class, 'payout'])->name('frontend.payout');
Route::get('/official-myfxbooks', [FrontendController::class, 'officialMyfxbooks'])->name('frontend.official-myfxbooks');
Route::get('/referrals', [FrontendController::class, 'referrals'])->name('frontend.referrals');
Route::get('/referrals-public', [FrontendController::class, 'referralsPublic'])->name('frontend.referrals-public');
Route::get('/masterclass', [FrontendController::class, 'masterclass'])->name('frontend.masterclass');
Route::get('/progress', [FrontendController::class, 'progress'])->name('frontend.progress');

Auth::routes();


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/topbars', [TopbarController::class, 'index'])->name('topbars.index');
    Route::post('/topbars', [TopbarController::class, 'update'])->name('topbars.update');

    Route::get('/hero', [\App\Http\Controllers\Admin\HeroSectionController::class, 'index'])->name('hero.index');
    Route::post('/hero', [\App\Http\Controllers\Admin\HeroSectionController::class, 'update'])->name('hero.update');

    Route::get('/signals', [\App\Http\Controllers\Admin\SignalSectionController::class, 'index'])->name('signals.index');
    Route::post('/signals', [\App\Http\Controllers\Admin\SignalSectionController::class, 'update'])->name('signals.update');

    Route::get('/how-it-works', [\App\Http\Controllers\Admin\HowItWorksSectionController::class, 'index'])->name('how-it-works.index');
    Route::post('/how-it-works', [\App\Http\Controllers\Admin\HowItWorksSectionController::class, 'update'])->name('how-it-works.update');

    Route::get('/results', [\App\Http\Controllers\Admin\ResultsSectionController::class, 'index'])->name('results.index');
    Route::post('/results', [\App\Http\Controllers\Admin\ResultsSectionController::class, 'update'])->name('results.update');

    Route::get('/why-choose', [\App\Http\Controllers\Admin\WhyChooseSectionController::class, 'index'])->name('why-choose.index');
    Route::post('/why-choose', [\App\Http\Controllers\Admin\WhyChooseSectionController::class, 'update'])->name('why-choose.update');

    Route::get('/referral', [\App\Http\Controllers\Admin\ReferralSectionController::class, 'index'])->name('referral.index');
    Route::post('/referral', [\App\Http\Controllers\Admin\ReferralSectionController::class, 'update'])->name('referral.update');

    Route::get('/cta', [\App\Http\Controllers\Admin\CtaSectionController::class, 'index'])->name('cta.index');
    Route::post('/cta', [\App\Http\Controllers\Admin\CtaSectionController::class, 'update'])->name('cta.update');

    Route::get('/site-settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('/site-settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('site-settings.update');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');