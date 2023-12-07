<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function uploadImage($request, $post)
    {
        if ($request->hasFile('image')) {
            if (app()->isLocal()) {
                $original = $request->file('image')->getClientOriginalName();
                $name = date('Ymd_His') . '_' . $original;
                $request->file('image')->storeAs('public/images', $name);
                $post->image = $name;
            } else {
                $image = $request->file('image');
                $path = Storage::disk('s3')->put('/', $image, 'public');
                $post->image = Storage::disk('s3')->url($path);
            }
        }
    }
}