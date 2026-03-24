<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SeoSettingController extends Controller
{
    public function index(Request $request)
    {
        $query = SeoSetting::query()->orderByDesc('id');

        if ($request->filled('q')) {
            $keyword = trim($request->get('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('url', 'like', '%' . $keyword . '%')
                  ->orWhere('title', 'like', '%' . $keyword . '%');
                if (is_numeric($keyword)) {
                    $q->orWhere('id', (int) $keyword);
                }
            });
        }

        $items = $query->paginate(10)->appends($request->all());
        return view('admin.seo.index', compact('items'));
    }

    public function create()
    {
        return view('admin.seo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'string', 'max:255', 'unique:seo_settings,url'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $data['url'] = $this->normalizeUrl($data['url']);

        SeoSetting::create($data);

        return redirect()->route('admin.seo.index')->with('success', 'Đã tạo cấu hình SEO.');
    }

    public function edit(SeoSetting $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, SeoSetting $seo)
    {
        $data = $request->validate([
            'url' => ['required', 'string', 'max:255', Rule::unique('seo_settings', 'url')->ignore($seo->id)],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $data['url'] = $this->normalizeUrl($data['url']);

        $seo->update($data);

        return redirect()->route('admin.seo.index')->with('success', 'Đã cập nhật cấu hình SEO.');
    }

    public function destroy(SeoSetting $seo)
    {
        $seo->delete();
        return redirect()->route('admin.seo.index')->with('success', 'Đã xóa cấu hình SEO.');
    }

    private function normalizeUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '' || $url === '/') {
            return '/';
        }

        return '/' . ltrim($url, '/');
    }
}
