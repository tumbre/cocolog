<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function deleteImage(Request $request)
    {
        $data = json_decode($request->getContent());
        $imageName = $data->imageName;

        if (app()->isLocal()) {
            Storage::delete("public/images/{$imageName}");
        } else {
            $s3ImageName = basename(parse_url($imageName, PHP_URL_PATH));
            Storage::disk('s3')->delete($s3ImageName);
        }

        $post = Post::where('image', $imageName)->first();

        if ($post) {
            $post->image = null;
            $post->save();
        }

        return response()->json(['message' => 'Image deleted successfully'], 200);
    }
}
