<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicySection;
use Illuminate\Http\Request;

class PrivacyPolicySectionController extends Controller
{
    public function index()
    {
        $privacy = PrivacyPolicySection::first() ?? new PrivacyPolicySection();
        return view('admin.pages.privacy-policy.index', compact('privacy'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'page_title' => 'nullable|string|max:255',
            'last_updated' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $privacy = PrivacyPolicySection::firstOrNew([]);
        $privacy->page_title = $request->page_title;
        $privacy->last_updated = $request->last_updated;
        $privacy->details = $request->details;
        $privacy->is_active = $request->has('is_active');
        $privacy->save();

        return redirect()->route('admin.privacy-policy.index')
            ->with('success', 'Privacy Policy updated successfully!');
    }
}
