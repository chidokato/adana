<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'upload' => ['required', 'image', 'max:4096'],
        ]);

        $file = $request->file('upload');
        $name = time() . '_' . $file->getClientOriginalName();
        $dest = public_path('uploads/ckeditor');

        if (!File::exists($dest)) {
            File::makeDirectory($dest, 0755, true);
        }

        $file->move($dest, $name);

        $url = asset('uploads/ckeditor/' . $name);

        // CKEditor (ckfinder/simple upload) compatible response
        return response()->json([
            'uploaded' => 1,
            'fileName' => $name,
            'url' => $url,
        ]);
    }
}
