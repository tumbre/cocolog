<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function create(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }

        $post->anniversary = true;
        $post->save();

        return back();
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }

        $post->anniversary = false;
        $post->save();

        return back();
    }
}
