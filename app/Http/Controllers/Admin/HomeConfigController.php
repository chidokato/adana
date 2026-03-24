<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeConfigController extends Controller
{
    public function index(Request $request)
    {
        $query = HomeConfig::query()->orderBy('section_key');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('section_key', 'like', '%' . $q . '%')
                    ->orWhere('title', 'like', '%' . $q . '%')
                    ->orWhere('id', $q);
            });
        }

        $items = $query->paginate(15)->withQueryString();

        return view('admin.home_config.index', compact('items'));
    }

    public function create()
    {
        return view('admin.home_config.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['image'] = $this->uploadImage($request);

        HomeConfig::create($data);

        return redirect()->route('admin.home-configs.index')->with('success', 'Đã tạo cấu hình trang chủ.');
    }

    public function edit(HomeConfig $home_config)
    {
        return view('admin.home_config.edit', ['item' => $home_config]);
    }

    public function update(Request $request, HomeConfig $home_config)
    {
        $data = $this->validatedData($request, $home_config->id);
        $data['image'] = $this->uploadImage($request, $home_config->image);

        $home_config->update($data);

        return redirect()->route('admin.home-configs.index')->with('success', 'Đã cập nhật cấu hình trang chủ.');
    }

    public function destroy(HomeConfig $home_config)
    {
        $home_config->delete();

        return redirect()->route('admin.home-configs.index')->with('success', 'Đã xóa cấu hình trang chủ.');
    }

    protected function validatedData(Request $request, $id = null)
    {
        return $request->validate([
            'section_key' => ['required', 'string', 'max:100', 'unique:home_configs,section_key,' . $id],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    protected function uploadImage(Request $request, $current = null)
    {
        if (! $request->hasFile('image')) {
            return $current;
        }

        $file = $request->file('image');
        $name = time() . '_home_config.' . $file->getClientOriginalExtension();
        $dest = public_path('uploads/home-configs');

        if (! File::exists($dest)) {
            File::makeDirectory($dest, 0755, true);
        }

        $file->move($dest, $name);

        return 'uploads/home-configs/' . $name;
    }
}
