<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topbar;
use Illuminate\Http\Request;

class TopbarController extends Controller
{
    public function index()
    {
        // Get the first topbar or create a new empty instance
        $topbar = Topbar::first() ?? new Topbar();
        return view('admin.pages.topbar.index', compact('topbar'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
            'extra_content' => 'nullable',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Update the first record or create it if it doesn't exist
        $topbar = Topbar::first();
        if ($topbar) {
            $topbar->update($validated);
        } else {
            Topbar::create($validated);
        }

        return redirect()->route('admin.topbars.index')->with('success', 'Topbar updated successfully');
    }
}
