<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class CtaSectionController extends Controller
{
    public function index()
    {
        $cta = CtaSection::first() ?? new CtaSection();
        return view('admin.pages.cta.index', compact('cta'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $cta = CtaSection::first();
        if (!$cta) {
            CtaSection::create($validated);
        } else {
            $cta->update($validated);
        }

        return redirect()->route('admin.cta.index')->with('success', 'CTA section updated successfully');
    }
}
