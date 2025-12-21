<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterclassSection;
use Illuminate\Http\Request;

class MasterclassSectionController extends Controller
{
    public function index()
    {
        $masterclass = MasterclassSection::first() ?? new MasterclassSection();
        
        // Initialize default module if empty
        if (empty($masterclass->modules)) {
            $masterclass->modules = [
                [
                    'title' => "Module 1",
                    'video_url' => 'https://www.youtube.com/embed/nR32hc8qcpA',
                    'status' => 'pending'
                ]
            ];
        }
        
        return view('admin.pages.masterclass.index', compact('masterclass'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'course_title' => 'nullable|string',
            'course_subtitle' => 'nullable|string',
            'cta_button_text' => 'nullable|string',
            'cta_button_link' => 'nullable|string',
            'modules' => 'nullable|array',
            'modules.*.title' => 'nullable|string',
            'modules.*.video_url' => 'nullable|string',
            'modules.*.status' => 'nullable|in:pending,completed',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Process modules array
        if ($request->has('modules')) {
            $modules = [];
            foreach ($request->input('modules', []) as $module) {
                if (!empty($module['title']) || !empty($module['video_url'])) {
                    $modules[] = [
                        'title' => $module['title'] ?? '',
                        'video_url' => $module['video_url'] ?? '',
                        'status' => $module['status'] ?? 'pending'
                    ];
                }
            }
            $validated['modules'] = $modules;
        }

        $masterclass = MasterclassSection::first();
        if ($masterclass) {
            $masterclass->update($validated);
        } else {
            MasterclassSection::create($validated);
        }

        return redirect()->route('admin.masterclass.index')->with('success', 'Masterclass section updated successfully');
    }
}
