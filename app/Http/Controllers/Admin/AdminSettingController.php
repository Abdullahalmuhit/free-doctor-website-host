<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Dr. Muhid'),
            'site_email' => Setting::get('site_email', 'info@drmuhid.com'),
            'site_phone' => Setting::get('site_phone', '10647'),
            'site_address' => Setting::get('site_address', ''),
            'facebook_url' => Setting::get('facebook_url', ''),
            'linkedin_url' => Setting::get('linkedin_url', ''),
            'twitter_url' => Setting::get('twitter_url', ''),
            'instagram_url' => Setting::get('instagram_url', ''),
            'youtube_url' => Setting::get('youtube_url', ''),
            'about_content' => Setting::get('about_content', ''),
            'consultation_fee' => Setting::get('consultation_fee', '1500'),
            'follow_up_fee' => Setting::get('follow_up_fee', '1000'),
            'meta_description' => Setting::get('meta_description', ''),
            'meta_keywords' => Setting::get('meta_keywords', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_email' => 'nullable|email',
            'site_phone' => 'nullable|string|max:50',
            'site_address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'about_content' => 'nullable|string',
            'consultation_fee' => 'nullable|string',
            'follow_up_fee' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
