<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaBannerController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaBanner::query()->orderBy('type')->orderBy('position')->orderByDesc('id');

        if ($request->filled('type')) {
            $query->where('type', $request->get('type'));
        }

        $items = $query->paginate(10)->appends($request->all());
        return view('admin.media_banner.index', compact('items'));
    }

    public function create()
    {
        return view('admin.media_banner.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:slider,banner'],
            'title' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'integer'],
            'image' => ['required', 'image', 'max:4096'],
            'status' => ['nullable'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('uploads/media');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $imagePath = 'uploads/media/' . $name;
        }

        MediaBanner::create([
            'type' => $data['type'],
            'title' => $data['title'] ?? null,
            'image' => $imagePath,
            'link' => $data['link'] ?? null,
            'position' => $data['position'] ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.media-banners.index')->with('success', 'Đã tạo.');
    }

    public function edit(MediaBanner $media_banner)
    {
        return view('admin.media_banner.edit', ['item' => $media_banner]);
    }

    public function update(Request $request, MediaBanner $media_banner)
    {
        $data = $request->validate([
            'type' => ['required', 'in:slider,banner'],
            'title' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:4096'],
            'status' => ['nullable'],
        ]);

        $imagePath = $media_banner->image;
        if ($request->hasFile('image')) {
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('uploads/media');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $imagePath = 'uploads/media/' . $name;
        }

        $media_banner->update([
            'type' => $data['type'],
            'title' => $data['title'] ?? null,
            'image' => $imagePath,
            'link' => $data['link'] ?? null,
            'position' => $data['position'] ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.media-banners.index')->with('success', 'Đã cập nhật.');
    }

    public function destroy(MediaBanner $media_banner)
    {
        if ($media_banner->image && File::exists(public_path($media_banner->image))) {
            File::delete(public_path($media_banner->image));
        }
        $media_banner->delete();
        return redirect()->route('admin.media-banners.index')->with('success', 'Đã xóa.');
    }
}

