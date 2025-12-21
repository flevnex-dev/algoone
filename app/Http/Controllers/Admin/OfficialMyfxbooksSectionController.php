<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialMyfxbooksSection;
use Illuminate\Http\Request;

class OfficialMyfxbooksSectionController extends Controller
{
    public function index()
    {
        $section = OfficialMyfxbooksSection::first() ?? new OfficialMyfxbooksSection();
        return view('admin.pages.official_myfxbooks.index', compact('section'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'verified_badge_text' => 'nullable|string',
            'page_title' => 'nullable|string',
            'page_subtitle' => 'nullable|string',
            'intro_text1' => 'nullable|string',
            'intro_text2' => 'nullable|string',
            'disclaimer_note' => 'nullable|string',
            'cta_title' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_button_text' => 'nullable|string',
            'cta_button_link' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $section = OfficialMyfxbooksSection::first();
        if ($section) {
            $section->update($validated);
        } else {
            OfficialMyfxbooksSection::create($validated);
        }

        return redirect()->route('admin.official-myfxbooks.index')->with('success', 'Official Myfxbooks sections updated successfully');
    }
}
