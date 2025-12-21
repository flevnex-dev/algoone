<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    public function index()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();
        return view('admin.pages.site_setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'copyright_text' => 'nullable|string',
            'legal_disclaimer' => 'nullable|string',
        ]);

        $setting = SiteSetting::first();
        if (!$setting) {
            $setting = new SiteSetting();
        }

        $setting->site_title = $request->input('site_title');
        $setting->copyright_text = $request->input('copyright_text');
        $setting->legal_disclaimer = $request->input('legal_disclaimer');
        
        // Email Settings
        $setting->email_from_address = $request->input('email_from_address');
        $setting->email_from_name = $request->input('email_from_name');
        $setting->smtp_host = $request->input('smtp_host');
        $setting->smtp_user = $request->input('smtp_user');
        
        // Only update password if provided (to avoid overwriting with empty value)
        if ($request->has('smtp_password') && !empty($request->input('smtp_password'))) {
            $setting->smtp_password = $request->input('smtp_password');
        }
        
        $setting->smtp_port = $request->input('smtp_port');
        $setting->smtp_security = $request->input('smtp_security');
        
        // Remember Me Settings
        $setting->remember_me_enabled = $request->has('remember_me_enabled');
        $setting->remember_me_text = $request->input('remember_me_text');
        $setting->remember_me_duration_days = $request->input('remember_me_duration_days');

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            $image = $request->file('logo');
            $filename = 'logo-' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/settings/';
            
            // Ensure directory exists
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }

            $image->move(public_path($path), $filename);
            $setting->logo = $path . $filename;
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                unlink(public_path($setting->favicon));
            }

            $image = $request->file('favicon');
            $filename = 'favicon-' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/settings/';
            
            // Ensure directory exists
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }

            $image->move(public_path($path), $filename);
            $setting->favicon = $path . $filename;
        }

        $setting->save();

        return redirect()->route('admin.site-settings.index')->with('success', 'Site settings updated successfully');
    }
}
