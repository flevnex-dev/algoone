<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SignalSection;
use Illuminate\Http\Request;

class SignalSectionController extends Controller
{
    public function index()
    {
        $signal = SignalSection::first() ?? new SignalSection();
        return view('admin.pages.signal.index', compact('signal'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'win_rate' => 'nullable|string',
            'risk_reward' => 'nullable|string',
            'primary_market' => 'nullable|string',
            'why_different_title' => 'nullable|string',
            'why_different_text' => 'nullable|string',
            'join_button_text' => 'nullable|string',
            'join_button_link' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $signal = SignalSection::first();
        if ($signal) {
            $signal->update($validated);
        } else {
            SignalSection::create($validated);
        }

        return redirect()->route('admin.signals.index')->with('success', 'Signals section updated successfully');
    }
}
