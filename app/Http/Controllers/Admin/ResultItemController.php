<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultItem;
use Illuminate\Http\Request;

class ResultItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        
        $query = ResultItem::orderBy('order', 'asc')->orderBy('created_at', 'desc');
        
        if ($type !== 'all') {
            $query->where('type', $type);
        }
        
        $items = $query->paginate(20);
        
        return view('admin.pages.result-items.index', compact('items', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->get('type', 'testimonial');
        return view('admin.pages.result-items.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:testimonial,stream,proof',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'media_url' => 'nullable|string', // Allow nullable because it might be a file
            'media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // New validation for file
            'thumbnail_url' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);
        
        // Handle Media File Upload
        if ($request->hasFile('media_file')) {
            $image = $request->file('media_file');
            $filename = 'proof-' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/results/';
            
            // Ensure directory exists
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }

            $image->move(public_path($path), $filename);
            $validated['media_url'] = asset($path . $filename); // Save full URL
        } else {
             // If no file, ensure media_url is present (for video types)
             if (empty($validated['media_url']) && $validated['type'] !== 'proof') {
                 return back()->withErrors(['media_url' => 'Media URL is required for this type.'])->withInput();
             }
        }

        // Handle checkbox for is_active
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;

        ResultItem::create($validated);

        return redirect()->route('admin.result-items.index', ['type' => $validated['type']])
            ->with('success', 'Item created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResultItem $resultItem)
    {
        return view('admin.pages.result-items.edit', compact('resultItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResultItem $resultItem)
    {
        $validated = $request->validate([
            'type' => 'required|in:testimonial,stream,proof',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'media_url' => 'nullable|string',
            'media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'thumbnail_url' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Handle Media File Upload
        if ($request->hasFile('media_file')) {
            // Delete old file if it exists and is local
            if ($resultItem->media_url) {
                // Extract relative path from absolute URL if possible, or just check standard path
                $relativePath = str_replace(url('/'), '', $resultItem->media_url);
                // Remove leading slash if present
                $relativePath = ltrim($relativePath, '/');
                
                if (file_exists(public_path($relativePath)) && is_file(public_path($relativePath))) {
                    @unlink(public_path($relativePath));
                }
            }

            $image = $request->file('media_file');
            $filename = 'proof-' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/results/';
            
            // Ensure directory exists
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }

            $image->move(public_path($path), $filename);
            $validated['media_url'] = asset($path . $filename);
        } else {
             // If no new file, keep existing media_url if not provided
             // For video types, user must provide URL if changing it, or we keep existing
             if (empty($validated['media_url'])) {
                 $validated['media_url'] = $resultItem->media_url;
             }
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;

        $resultItem->update($validated);

        return redirect()->route('admin.result-items.index', ['type' => $validated['type']])
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultItem $resultItem)
    {
        $type = $resultItem->type;
        
        // Try to delete image file if type was proof and it's local
        if ($type === 'proof' && $resultItem->media_url) {
             $relativePath = str_replace(url('/'), '', $resultItem->media_url);
             $relativePath = ltrim($relativePath, '/');
             if (file_exists(public_path($relativePath)) && is_file(public_path($relativePath))) {
                 @unlink(public_path($relativePath));
             }
        }

        $resultItem->delete();

        return redirect()->route('admin.result-items.index', ['type' => $type])
            ->with('success', 'Item deleted successfully');
    }
}
