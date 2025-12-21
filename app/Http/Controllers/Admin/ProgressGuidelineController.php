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
            'guideline1_title' => 'nullable|string',
            'guideline1_text' => 'nullable|string',
            'guideline2_title' => 'nullable|string',
            'guideline2_text' => 'nullable|string',
            'guideline3_title' => 'nullable|string',
            'guideline3_text' => 'nullable|string',
            'guideline4_title' => 'nullable|string',
            'guideline4_text' => 'nullable|string',
            'guideline5_title' => 'nullable|string',
            'guideline5_text' => 'nullable|string',
            'guideline6_title' => 'nullable|string',
            'guideline6_text' => 'nullable|string',
            'guideline7_title' => 'nullable|string',
            'guideline7_text' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $guideline = ProgressGuideline::first();
        if ($guideline) {
            $guideline->update($validated);
        } else {
            ProgressGuideline::create($validated);
        }

        return redirect()->route('admin.progress-guidelines.index')->with('success', 'Progress guidelines updated successfully');
    }
}
