<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('frontend.index');
Route::get('/sign-in', [App\Http\Controllers\FrontendController::class, 'signIn'])->name('frontend.sign-in');
Route::get('/sign-up', [App\Http\Controllers\FrontendController::class, 'signUp'])->name('frontend.sign-up');
Route::get('/buy-funding', [App\Http\Controllers\FrontendController::class, 'buyFunding'])->name('frontend.buy-funding');
Route::get('/live-results', [App\Http\Controllers\FrontendController::class, 'liveResults'])->name('frontend.live-results');
Route::get('/privacy', [App\Http\Controllers\FrontendController::class, 'privacy'])->name('frontend.privacy');
Route::get('/terms-conditions', [App\Http\Controllers\FrontendController::class, 'termsConditions'])->name('frontend.terms-conditions');
Route::get('/past-performance', [App\Http\Controllers\FrontendController::class, 'pastPerformance'])->name('frontend.past-performance');
Route::get('/payout', [App\Http\Controllers\FrontendController::class, 'payout'])->name('frontend.payout');
Route::get('/official-myfxbooks', [App\Http\Controllers\FrontendController::class, 'officialMyfxbooks'])->name('frontend.official-myfxbooks');
Route::get('/referrals', [App\Http\Controllers\FrontendController::class, 'referrals'])->name('frontend.referrals');
Route::get('/referrals-public', [App\Http\Controllers\FrontendController::class, 'referralsPublic'])->name('frontend.referrals-public');
Route::get('/masterclass', [App\Http\Controllers\FrontendController::class, 'masterclass'])->name('frontend.masterclass');
Route::get('/progress', [App\Http\Controllers\FrontendController::class, 'progress'])->name('frontend.progress');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
