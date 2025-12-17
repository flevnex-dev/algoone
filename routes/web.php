<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});