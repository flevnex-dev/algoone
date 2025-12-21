<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PastPerformanceSection;
use Illuminate\Http\Request;

class PastPerformanceSectionController extends Controller
{
    public function index()
    {
        $section = PastPerformanceSection::first() ?? new PastPerformanceSection();
        return view('admin.pages.past_performance.index', compact('section'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'transparency_title' => 'nullable|string',
            'transparency_text' => 'nullable|string',
            'view_reports_text' => 'nullable|string',
            'view_reports_link' => 'nullable|string',
            'overview_title' => 'nullable|string',
            'overview_text' => 'nullable|string',
            'outlook_title' => 'nullable|string',
            'outlook_text' => 'nullable|string',
            'next_update_label' => 'nullable|string',
            'next_update_text' => 'nullable|string',
            'notice_label' => 'nullable|string',
            'notice_text' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $section = PastPerformanceSection::first();
        if ($section) {
            $section->update($validated);
        } else {
            PastPerformanceSection::create($validated);
        }

        return redirect()->route('admin.past-performance.index')->with('success', 'Past Performance sections updated successfully');
    }
}
