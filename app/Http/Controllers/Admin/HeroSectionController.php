<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first() ?? new HeroSection();
        return view('admin.pages.hero.index', compact('hero'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|string',
            'traders_count' => 'nullable|string',
            'primary_cta_text' => 'nullable|string',
            'signin_cta_text' => 'nullable|string',
            'myfxbook_text' => 'nullable|string',
            'payout_text' => 'nullable|string',
            'primary_cta_link' => 'nullable|string',
            'signin_cta_link' => 'nullable|string',
            'myfxbook_link' => 'nullable|string',
            'payout_link' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $hero = HeroSection::first();
        if ($hero) {
            $hero->update($validated);
        } else {
            HeroSection::create($validated);
        }

        return redirect()->route('admin.hero.index')->with('success', 'Hero section updated successfully');
    }
}
