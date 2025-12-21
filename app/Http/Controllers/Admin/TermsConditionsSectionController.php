<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsConditionsSection;
use Illuminate\Http\Request;

class TermsConditionsSectionController extends Controller
{
    public function index()
    {
        $terms = TermsConditionsSection::first() ?? new TermsConditionsSection();
        return view('admin.pages.terms-conditions.index', compact('terms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'page_title' => 'nullable|string|max:255',
            'last_updated' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $terms = TermsConditionsSection::firstOrNew([]);
        $terms->page_title = $request->page_title;
        $terms->last_updated = $request->last_updated;
        $terms->details = $request->details;
        $terms->is_active = $request->has('is_active');
        $terms->save();

        return redirect()->route('admin.terms-conditions.index')
            ->with('success', 'Terms & Conditions updated successfully!');
    }
}
