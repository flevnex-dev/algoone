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
Route::get('/results', [FrontendController::class, 'results'])->name('frontend.results');
Route::get('/live-results', [FrontendController::class, 'liveResults'])->name('frontend.live-results');
Route::post('/live-results', [FrontendController::class, 'storeLiveResult'])->name('frontend.live-results.store');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('frontend.privacy');
Route::get('/terms-conditions', [FrontendController::class, 'termsConditions'])->name('frontend.terms-conditions');
Route::get('/past-performance', [FrontendController::class, 'pastPerformance'])->name('frontend.past-performance');
Route::get('/api/week/{id}', [FrontendController::class, 'getWeekData'])->name('api.week.data');
Route::get('/payout', [FrontendController::class, 'payout'])->name('frontend.payout');
Route::get('/official-myfxbooks', [FrontendController::class, 'officialMyfxbooks'])->name('frontend.official-myfxbooks');
Route::get('/referrals', [FrontendController::class, 'referrals'])->middleware(['auth', 'trader'])->name('frontend.referrals');
Route::get('/referrals-public', [FrontendController::class, 'referralsPublic'])->name('frontend.referrals-public');
Route::get('/masterclass', [FrontendController::class, 'masterclass'])->name('frontend.masterclass');
Route::get('/progress', [FrontendController::class, 'progress'])->middleware(['auth', 'trader'])->name('frontend.progress');

Auth::routes();


Route::prefix('admin')->middleware(['auth', 'admin.role'])->name('admin.')->group(function() {
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
    Route::post('/results/import', [\App\Http\Controllers\Admin\ResultsSectionController::class, 'import'])->name('results.import');
    Route::delete('/results/account/{index}', [\App\Http\Controllers\Admin\ResultsSectionController::class, 'deleteAccount'])->name('results.delete-account');
    Route::get('/results/template', [\App\Http\Controllers\Admin\ResultsSectionController::class, 'downloadTemplate'])->name('results.template');

    Route::get('/why-choose', [\App\Http\Controllers\Admin\WhyChooseSectionController::class, 'index'])->name('why-choose.index');
    Route::post('/why-choose', [\App\Http\Controllers\Admin\WhyChooseSectionController::class, 'update'])->name('why-choose.update');

    Route::get('/referral', [\App\Http\Controllers\Admin\ReferralSectionController::class, 'index'])->name('referral.index');
    Route::post('/referral', [\App\Http\Controllers\Admin\ReferralSectionController::class, 'update'])->name('referral.update');

    Route::get('/cta', [\App\Http\Controllers\Admin\CtaSectionController::class, 'index'])->name('cta.index');
    Route::post('/cta', [\App\Http\Controllers\Admin\CtaSectionController::class, 'update'])->name('cta.update');

    Route::get('/past-performance', [\App\Http\Controllers\Admin\PastPerformanceSectionController::class, 'index'])->name('past-performance.index');
    Route::post('/past-performance', [\App\Http\Controllers\Admin\PastPerformanceSectionController::class, 'update'])->name('past-performance.update');

    Route::get('/official-myfxbooks', [\App\Http\Controllers\Admin\OfficialMyfxbooksSectionController::class, 'index'])->name('official-myfxbooks.index');
    Route::post('/official-myfxbooks', [\App\Http\Controllers\Admin\OfficialMyfxbooksSectionController::class, 'update'])->name('official-myfxbooks.update');

    Route::get('/myfxbook-accounts', [\App\Http\Controllers\Admin\MyfxbookAccountController::class, 'index'])->name('myfxbook-accounts.index');
    Route::post('/myfxbook-accounts/import', [\App\Http\Controllers\Admin\MyfxbookAccountController::class, 'import'])->name('myfxbook-accounts.import');
    Route::put('/myfxbook-accounts/{id}', [\App\Http\Controllers\Admin\MyfxbookAccountController::class, 'update'])->name('myfxbook-accounts.update');
    Route::delete('/myfxbook-accounts/{id}', [\App\Http\Controllers\Admin\MyfxbookAccountController::class, 'destroy'])->name('myfxbook-accounts.destroy');

    Route::get('/site-settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('/site-settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('site-settings.update');
    
    Route::get('/email-configuration', [\App\Http\Controllers\Admin\EmailConfigurationController::class, 'index'])->name('email-configuration.index');
    Route::post('/email-configuration', [\App\Http\Controllers\Admin\EmailConfigurationController::class, 'update'])->name('email-configuration.update');

    Route::get('/progress-guidelines', [\App\Http\Controllers\Admin\ProgressGuidelineController::class, 'index'])->name('progress-guidelines.index');
    Route::post('/progress-guidelines', [\App\Http\Controllers\Admin\ProgressGuidelineController::class, 'update'])->name('progress-guidelines.update');

    Route::get('/masterclass', [\App\Http\Controllers\Admin\MasterclassSectionController::class, 'index'])->name('masterclass.index');
    Route::post('/masterclass', [\App\Http\Controllers\Admin\MasterclassSectionController::class, 'update'])->name('masterclass.update');

    Route::get('/buy-funding', [\App\Http\Controllers\Admin\BuyFundingSectionController::class, 'index'])->name('buy-funding.index');
    Route::post('/buy-funding', [\App\Http\Controllers\Admin\BuyFundingSectionController::class, 'update'])->name('buy-funding.update');

    Route::get('/privacy-policy', [\App\Http\Controllers\Admin\PrivacyPolicySectionController::class, 'index'])->name('privacy-policy.index');
    Route::post('/privacy-policy', [\App\Http\Controllers\Admin\PrivacyPolicySectionController::class, 'update'])->name('privacy-policy.update');

    Route::get('/terms-conditions', [\App\Http\Controllers\Admin\TermsConditionsSectionController::class, 'index'])->name('terms-conditions.index');
    Route::post('/terms-conditions', [\App\Http\Controllers\Admin\TermsConditionsSectionController::class, 'update'])->name('terms-conditions.update');

    Route::get('/payouts', [\App\Http\Controllers\Admin\PayoutController::class, 'index'])->name('payouts.index');
    Route::get('/payouts/datatable', [\App\Http\Controllers\Admin\PayoutController::class, 'datatable'])->name('payouts.datatable');
    Route::get('/payouts/{payout}', [\App\Http\Controllers\Admin\PayoutController::class, 'show'])->name('payouts.show');
    Route::post('/payouts', [\App\Http\Controllers\Admin\PayoutController::class, 'store'])->name('payouts.store');
    Route::put('/payouts/{payout}', [\App\Http\Controllers\Admin\PayoutController::class, 'update'])->name('payouts.update');
    Route::post('/payouts/store-user', [\App\Http\Controllers\Admin\PayoutController::class, 'storeUser'])->name('payouts.store-user');
    Route::delete('/payouts/{payout}', [\App\Http\Controllers\Admin\PayoutController::class, 'destroy'])->name('payouts.destroy');

    Route::get('/live-results', [\App\Http\Controllers\Admin\LiveResultController::class, 'index'])->name('live-results.index');
    Route::get('/live-results/create', [\App\Http\Controllers\Admin\LiveResultController::class, 'create'])->name('live-results.create');
    Route::post('/live-results', [\App\Http\Controllers\Admin\LiveResultController::class, 'store'])->name('live-results.store');
    Route::put('/live-results/{id}/approve', [\App\Http\Controllers\Admin\LiveResultController::class, 'approve'])->name('live-results.approve');
    Route::put('/live-results/{id}/reject', [\App\Http\Controllers\Admin\LiveResultController::class, 'reject'])->name('live-results.reject');
    Route::get('/live-results/{id}', [\App\Http\Controllers\Admin\LiveResultController::class, 'show'])->name('live-results.show');
    Route::delete('/live-results/{id}', [\App\Http\Controllers\Admin\LiveResultController::class, 'destroy'])->name('live-results.destroy');

    Route::post('/trading-weeks/import', [\App\Http\Controllers\Admin\TradingWeekController::class, 'import'])->name('trading-weeks.import');
    Route::resource('trading-weeks', \App\Http\Controllers\Admin\TradingWeekController::class);
    
    // Week Performance routes
    Route::get('/week-performance', [\App\Http\Controllers\Admin\WeekPerformanceController::class, 'index'])->name('week-performance.index');
    Route::get('/week-performance/{id}/edit', [\App\Http\Controllers\Admin\WeekPerformanceController::class, 'edit'])->name('week-performance.edit');
    Route::put('/week-performance/{id}', [\App\Http\Controllers\Admin\WeekPerformanceController::class, 'update'])->name('week-performance.update');
    Route::post('/week-performance/import', [\App\Http\Controllers\Admin\WeekPerformanceController::class, 'import'])->name('week-performance.import');
    
});
Route::get('/home', [HomeController::class, 'index'])->name('home');