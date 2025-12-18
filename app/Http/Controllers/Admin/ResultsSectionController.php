<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultsSection;
use Illuminate\Http\Request;

class ResultsSectionController extends Controller
{
    public function index()
    {
        $results = ResultsSection::first() ?? new ResultsSection();
        return view('admin.pages.results.index', compact('results'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'disclaimer' => 'nullable|string',
            
            'acc1_name' => 'nullable|string',
            'acc1_subtext' => 'nullable|string',
            'acc1_total_gain' => 'nullable|string',
            'acc1_balance' => 'nullable|string',
            'acc1_daily' => 'nullable|string',
            'acc1_monthly' => 'nullable|string',
            'acc1_drawdown' => 'nullable|string',
            'acc1_profit' => 'nullable|string',
            'acc1_deposits' => 'nullable|string',
            'acc1_platform' => 'nullable|string',

            'acc2_name' => 'nullable|string',
            'acc2_subtext' => 'nullable|string',
            'acc2_total_gain' => 'nullable|string',
            'acc2_balance' => 'nullable|string',
            'acc2_daily' => 'nullable|string',
            'acc2_monthly' => 'nullable|string',
            'acc2_drawdown' => 'nullable|string',
            'acc2_profit' => 'nullable|string',
            'acc2_deposits' => 'nullable|string',
            'acc2_platform' => 'nullable|string',

            'acc3_name' => 'nullable|string',
            'acc3_subtext' => 'nullable|string',
            'acc3_total_gain' => 'nullable|string',
            'acc3_balance' => 'nullable|string',
            'acc3_daily' => 'nullable|string',
            'acc3_monthly' => 'nullable|string',
            'acc3_drawdown' => 'nullable|string',
            'acc3_profit' => 'nullable|string',
            'acc3_deposits' => 'nullable|string',
            'acc3_platform' => 'nullable|string',

            'summary_title' => 'nullable|string',
            'summary_description' => 'nullable|string',
            'view_results_text' => 'nullable|string',
            'view_results_link' => 'nullable|string',

            'myfxbook_text' => 'nullable|string',
            'myfxbook_link' => 'nullable|string',
            'payout_text' => 'nullable|string',
            'payout_link' => 'nullable|string',

            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $results = ResultsSection::first();
        if ($results) {
            $results->update($validated);
        } else {
            ResultsSection::create($validated);
        }

        return redirect()->route('admin.results.index')->with('success', 'Results section updated successfully');
    }
}
