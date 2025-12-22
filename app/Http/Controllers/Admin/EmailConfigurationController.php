<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class EmailConfigurationController extends Controller
{
    public function index()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();
        return view('admin.pages.email-configuration.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'email_from_address' => 'required|email',
            'email_from_name' => 'nullable|string|max:255',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_user' => 'required|string|max:255',
            'smtp_password' => 'nullable|string',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'smtp_security' => 'nullable|in:SSL,TLS',
        ]);

        $setting = SiteSetting::first();
        if (!$setting) {
            $setting = new SiteSetting();
        }

        $setting->email_from_address = $validated['email_from_address'];
        $setting->email_from_name = $validated['email_from_name'] ?? null;
        $setting->smtp_host = $validated['smtp_host'] ?? null;
        $setting->smtp_user = $validated['smtp_user'];
        
        // Only update password if provided (to avoid overwriting with empty value)
        if ($request->has('smtp_password') && !empty($request->input('smtp_password'))) {
            $setting->smtp_password = $validated['smtp_password'];
        }
        
        $setting->smtp_port = $validated['smtp_port'] ?? null;
        $setting->smtp_security = $validated['smtp_security'] ?? 'SSL';

        $setting->save();

        return redirect()->route('admin.email-configuration.index')
            ->with('success', 'Email configuration updated successfully');
    }
}
