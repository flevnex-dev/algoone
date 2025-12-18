<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReferralSectionController extends Controller
{
    public function index()
    {
        $referral = ReferralSection::first() ?? new ReferralSection();
        return view('admin.pages.referral.index', compact('referral'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'tiers' => 'nullable|array',
        ]);

        $referral = ReferralSection::firstOrNew([]);
        $referral->title = $request->title;
        $referral->subtitle = $request->subtitle;
        $referral->button_text = $request->button_text;
        $referral->button_link = $request->button_link;
        $referral->is_active = $request->has('is_active');

        // Process Tiers
        $tiers = $request->input('tiers', []);
        $processedTiers = [];

        // Upload Helper
        $uploadFile = function ($file, $subPath) {
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path("uploads/referral/{$subPath}");
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            return "uploads/referral/{$subPath}/" . $filename;
        };

        foreach ($tiers as $tierIndex => $tierData) {
            $processedTier = [
                'name' => $tierData['name'] ?? null,
                'range' => $tierData['range'] ?? null,
                'badge_text' => $tierData['badge_text'] ?? null,
                'benefits' => []
            ];

            // Tier Icon
            if ($request->hasFile("tiers.{$tierIndex}.icon")) {
                $processedTier['icon'] = $uploadFile($request->file("tiers.{$tierIndex}.icon"), 'icons');
            } else {
                $processedTier['icon'] = $tierData['existing_icon'] ?? null;
            }

            // Badge Icon
            if ($request->hasFile("tiers.{$tierIndex}.badge_icon")) {
                $processedTier['badge_icon'] = $uploadFile($request->file("tiers.{$tierIndex}.badge_icon"), 'badges');
            } else {
                $processedTier['badge_icon'] = $tierData['existing_badge_icon'] ?? null;
            }

            // Process Benefits
            if (isset($tierData['benefits']) && is_array($tierData['benefits'])) {
                foreach ($tierData['benefits'] as $benefitIndex => $benefitData) {
                    $processedBenefit = [
                        'text' => $benefitData['text'] ?? null,
                    ];

                    // Benefit Icon
                    if ($request->hasFile("tiers.{$tierIndex}.benefits.{$benefitIndex}.icon")) {
                        $processedBenefit['icon'] = $uploadFile($request->file("tiers.{$tierIndex}.benefits.{$benefitIndex}.icon"), 'benefits');
                    } else {
                        $processedBenefit['icon'] = $benefitData['existing_icon'] ?? null;
                    }

                    $processedTier['benefits'][] = $processedBenefit;
                }
            }

            $processedTiers[] = $processedTier;
        }

        $referral->tiers = $processedTiers;
        $referral->save();

        return redirect()->route('admin.referral.index')->with('success', 'Referral section updated successfully');
    }
}
