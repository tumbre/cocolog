<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploadService
{
    public function uploadImage($request, $post)
    {
        $this->deleteImage($post->image);

        if ($request->hasFile('image')) {

            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . pathinfo($original, PATHINFO_FILENAME) . '.jpg';

            $uploadedImage = $request->file('image');

            $resizedImage = Image::make($uploadedImage)
                ->orientate()
                ->resize(1920, 1920, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg');

            if (app()->isLocal()) {
                $resizedImage->save(storage_path("app/public/images/{$name}"));
                $post->image = $name;
            } else {
                Storage::disk('s3')->put($name, $resizedImage->__toString(), 'public');
                $post->image = Storage::disk('s3')->url($name);
            }

            $resizedImage->destroy();
        } else {
            $post->image = null;
        }
    }

    public function deleteImage($imageName)
    {
        if ($imageName) {
            if (app()->isLocal()) {
                Storage::delete("public/images/{$imageName}");
            } else {
                $imageName = basename($imageName);
                Storage::disk('s3')->delete($imageName);
            }
        }
    }
}
