<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalTraders' => \App\Models\User::where('role', 'trader')->count(),
            'totalPayouts' => \App\Models\Payout::where('status', 'completed')->sum('amount'),
            'activeTradingWeeks' => \App\Models\TradingWeek::where('is_active', true)->count(),
            'approvedLiveResults' => \App\Models\LiveResult::where('status', 'approved')->count(),
            'activeMyfxbookAccounts' => \App\Models\MyfxbookAccount::where('is_active', true)->count(),
            'totalReferralConversions' => \App\Models\ReferralStat::sum('conversions'),
            'pendingPayouts' => \App\Models\Payout::where('status', 'pending')->count(),
            'totalUsers' => \App\Models\User::count(),
        ];
        return view('admin.pages.dashboard', compact('data'));
    }
}
