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
            $imageName = basename($imageName);
            Storage::disk('s3')->delete($imageName);
        }

        $post = Post::where('image', $imageName)->first();

        if ($post) {
            $post->image = null;
            $post->save();
        }

        return response()->json(['message' => 'Image deleted successfully'], 200);
    }
}
