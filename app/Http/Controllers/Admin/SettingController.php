<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name' => ['nullable', 'string', 'max:255'],
            'short_intro' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'hotline' => ['nullable', 'string', 'max:255'],
            'zalo' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'footer_logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
        ]);

        $setting = Setting::first();

        $logoPath = $setting?->logo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = time() . '_logo.' . $file->getClientOriginalExtension();
            $dest = public_path('uploads/settings');
            if (!\Illuminate\Support\Facades\File::exists($dest)) {
                \Illuminate\Support\Facades\File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $logoPath = 'uploads/settings/' . $name;
        }

        $footerLogoPath = $setting?->footer_logo;
        if ($request->hasFile('footer_logo')) {
            $file = $request->file('footer_logo');
            $name = time() . '_footer_logo.' . $file->getClientOriginalExtension();
            $dest = public_path('uploads/settings');
            if (!\Illuminate\Support\Facades\File::exists($dest)) {
                \Illuminate\Support\Facades\File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $footerLogoPath = 'uploads/settings/' . $name;
        }

        $faviconPath = $setting?->favicon;
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $name = time() . '_favicon.' . $file->getClientOriginalExtension();
            $dest = public_path('uploads/settings');
            if (!\Illuminate\Support\Facades\File::exists($dest)) {
                \Illuminate\Support\Facades\File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $faviconPath = 'uploads/settings/' . $name;
        }

        $setting = Setting::first();
        if ($setting) {
            $setting->update(array_merge($data, [
                'logo' => $logoPath,
                'footer_logo' => $footerLogoPath,
                'favicon' => $faviconPath,
            ]));
        } else {
            Setting::create(array_merge($data, [
                'logo' => $logoPath,
                'footer_logo' => $footerLogoPath,
                'favicon' => $faviconPath,
            ]));
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Đã cập nhật cấu hình.');
    }
}
