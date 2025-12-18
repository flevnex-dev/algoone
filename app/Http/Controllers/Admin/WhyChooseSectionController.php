<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WhyChooseSectionController extends Controller
{
    public function index()
    {
        $whyChoose = WhyChooseSection::first() ?? new WhyChooseSection();
        return view('admin.pages.why_choose.index', compact('whyChoose'));
    }

    public function update(Request $request)
    {
        $rules = [
            'title'     => 'nullable|string',
            'subtitle'  => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];

        for ($i = 1; $i <= 6; $i++) {
            $rules["card{$i}_title"] = 'nullable|string';
            $rules["card{$i}_description"] = 'nullable|string';
            $rules["card{$i}_image"] = 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048';
        }

        $validated = $request->validate($rules);
        $validated['is_active'] = $request->has('is_active');

        // Remove image fields to avoid null overwrite
        for ($i = 1; $i <= 6; $i++) {
            unset($validated["card{$i}_image"]);
        }

        $whyChoose = WhyChooseSection::first();
        if (!$whyChoose) {
            $whyChoose = WhyChooseSection::create($validated);
        } else {
            $whyChoose->update($validated);
        }

        // Image Upload Logic
        for ($i = 1; $i <= 6; $i++) {

            if ($request->hasFile("card{$i}_image")) {

                $file = $request->file("card{$i}_image");

                if (!$file->isValid()) {
                    continue;
                }

                // Delete old image
                if (
                    $whyChoose->{"card{$i}_image"} &&
                    File::exists(public_path($whyChoose->{"card{$i}_image"}))
                ) {
                    File::delete(public_path($whyChoose->{"card{$i}_image"}));
                }

                // Create directory if not exists
                $destination = public_path('uploads/why_choose');
                if (!File::exists($destination)) {
                    File::makeDirectory($destination, 0755, true);
                }

                $filename = "card{$i}_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move($destination, $filename);

                $whyChoose->update([
                    "card{$i}_image" => 'uploads/why_choose/' . $filename
                ]);
            }
        }

        return redirect()
            ->route('admin.why-choose.index')
            ->with('success', 'Why Choose section updated successfully');
    }
}
