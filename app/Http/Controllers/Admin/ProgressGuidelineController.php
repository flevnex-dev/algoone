<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgressGuideline;
use Illuminate\Http\Request;

class ProgressGuidelineController extends Controller
{
    public function index()
    {
        $guideline = ProgressGuideline::first() ?? new ProgressGuideline();
        return view('admin.pages.progress_guideline.index', compact('guideline'));
    }

    public function update(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'warning_text' => 'nullable|string',
            'guidelines' => 'nullable|array',
            'guidelines.*.title' => 'nullable|string',
            'guidelines.*.text' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->has('guidelines') && is_array($request->guidelines)) {
            $validated['guidelines'] = array_values($request->guidelines);
        }

        $guideline = ProgressGuideline::first();
        if ($guideline) {
            $guideline->update($validated);
        } else {
            ProgressGuideline::create($validated);
        }

        return redirect()->route('admin.progress-guidelines.index')->with('success', 'Progress guidelines updated successfully');
    }
}
