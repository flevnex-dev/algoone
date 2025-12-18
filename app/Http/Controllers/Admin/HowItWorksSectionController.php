<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowItWorksSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HowItWorksSectionController extends Controller
{
    public function index()
    {
        $howItWorks = HowItWorksSection::first() ?? new HowItWorksSection();
        return view('admin.pages.how_it_works.index', compact('howItWorks'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',

            'step1_title' => 'nullable|string',
            'step1_description' => 'nullable|string',
            'step1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            'step2_title' => 'nullable|string',
            'step2_description' => 'nullable|string',
            'step2_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            'step3_title' => 'nullable|string',
            'step3_description' => 'nullable|string',
            'step3_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            'is_active' => 'nullable|boolean',
        ]);

        // Checkbox handling
        $validated['is_active'] = $request->has('is_active');

        // Get first record or create new instance
        $howItWorks = HowItWorksSection::first() ?? new HowItWorksSection();

        // Image upload path
        $uploadPath = public_path('uploads/how_it_works');

        // Create directory if not exists
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        /**
         * IMAGE UPLOAD HANDLER FUNCTION
         */
        function uploadImage($request, $howItWorks, $field, $uploadPath)
        {
            if ($request->hasFile($field)) {

                $file = $request->file($field);

                if (!$file->isValid()) {
                    return null;
                }

                // Delete old image
                if (
                    !empty($howItWorks->$field) &&
                    File::exists(public_path($howItWorks->$field))
                ) {
                    File::delete(public_path($howItWorks->$field));
                }

                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);

                return 'uploads/how_it_works/' . $filename;
            }

            return null;
        }

        // Handle images
        foreach (['step1_image', 'step2_image', 'step3_image'] as $imageField) {
            $imagePath = uploadImage($request, $howItWorks, $imageField, $uploadPath);
            if ($imagePath) {
                $validated[$imageField] = $imagePath;
            } else {
                unset($validated[$imageField]); // prevent null overwrite
            }
        }

        // Save data
        if ($howItWorks->exists) {
            $howItWorks->update($validated);
        } else {
            $howItWorks->create($validated);
        }

        return redirect()
            ->route('admin.how-it-works.index')
            ->with('success', 'How It Works section updated successfully');
    }
}
