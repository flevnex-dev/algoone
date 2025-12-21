<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyFundingSection;
use Illuminate\Http\Request;

class BuyFundingSectionController extends Controller
{
    public function index()
    {
        $buyFunding = BuyFundingSection::first() ?? new BuyFundingSection();
        
        // Initialize default chart data if not exists
        if (empty($buyFunding->chart_data)) {
            $buyFunding->chart_data = [
                'labels' => ['$5k', '$10k', '$25k', '$50k', '$100k', '$200k', '$300k', '$400k'],
                'data' => [250, 500, 1250, 2500, 5000, 10000, 15000, 20000],
            ];
        }
        
        return view('admin.pages.buy-funding.index', compact('buyFunding'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'main_title' => 'nullable|string',
            'main_subtitle' => 'nullable|string',
            'comparison1_small_account_title' => 'nullable|string',
            'comparison1_small_account_profit' => 'nullable|string',
            'comparison1_small_account_label' => 'nullable|string',
            'comparison1_medium_account_title' => 'nullable|string',
            'comparison1_medium_account_profit' => 'nullable|string',
            'comparison1_medium_account_label' => 'nullable|string',
            'comparison1_button_text' => 'nullable|string',
            'comparison2_medium_account_title' => 'nullable|string',
            'comparison2_medium_account_profit' => 'nullable|string',
            'comparison2_medium_account_label' => 'nullable|string',
            'comparison2_large_account_title' => 'nullable|string',
            'comparison2_large_account_profit' => 'nullable|string',
            'comparison2_large_account_label' => 'nullable|string',
            'comparison2_button_text' => 'nullable|string',
            'chart_title' => 'nullable|string',
            'chart_subtitle' => 'nullable|string',
            'chart_conclusion' => 'nullable|string',
            'cta_title' => 'nullable|string',
            'cta_subtitle' => 'nullable|string',
            'cta_button1_text' => 'nullable|string',
            'cta_button2_text' => 'nullable|string',
            'cta_button2_link' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'chart_labels' => 'nullable|array',
            'chart_data' => 'nullable|array',
        ]);

        $buyFunding = BuyFundingSection::firstOrNew([]);
        
        // Update all fields
        $buyFunding->main_title = $request->main_title;
        $buyFunding->main_subtitle = $request->main_subtitle;
        $buyFunding->comparison1_small_account_title = $request->comparison1_small_account_title;
        $buyFunding->comparison1_small_account_profit = $request->comparison1_small_account_profit;
        $buyFunding->comparison1_small_account_label = $request->comparison1_small_account_label;
        $buyFunding->comparison1_medium_account_title = $request->comparison1_medium_account_title;
        $buyFunding->comparison1_medium_account_profit = $request->comparison1_medium_account_profit;
        $buyFunding->comparison1_medium_account_label = $request->comparison1_medium_account_label;
        $buyFunding->comparison1_button_text = $request->comparison1_button_text;
        $buyFunding->comparison2_medium_account_title = $request->comparison2_medium_account_title;
        $buyFunding->comparison2_medium_account_profit = $request->comparison2_medium_account_profit;
        $buyFunding->comparison2_medium_account_label = $request->comparison2_medium_account_label;
        $buyFunding->comparison2_large_account_title = $request->comparison2_large_account_title;
        $buyFunding->comparison2_large_account_profit = $request->comparison2_large_account_profit;
        $buyFunding->comparison2_large_account_label = $request->comparison2_large_account_label;
        $buyFunding->comparison2_button_text = $request->comparison2_button_text;
        $buyFunding->chart_title = $request->chart_title;
        $buyFunding->chart_subtitle = $request->chart_subtitle;
        $buyFunding->chart_conclusion = $request->chart_conclusion;
        $buyFunding->cta_title = $request->cta_title;
        $buyFunding->cta_subtitle = $request->cta_subtitle;
        $buyFunding->cta_button1_text = $request->cta_button1_text;
        $buyFunding->cta_button2_text = $request->cta_button2_text;
        $buyFunding->cta_button2_link = $request->cta_button2_link;
        $buyFunding->is_active = $request->has('is_active');
        
        // Process chart data
        if ($request->has('chart_labels') && $request->has('chart_data')) {
            $buyFunding->chart_data = [
                'labels' => $request->chart_labels,
                'data' => array_map('intval', $request->chart_data), // Convert to integers
            ];
        }
        
        $buyFunding->save();

        return redirect()->route('admin.buy-funding.index')
            ->with('success', 'Buy Funding section updated successfully!');
    }
}
