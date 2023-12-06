<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('AuthenticateUser');
        $this->middleware('checkPostOwnership')->only('create', 'destroy');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $posts = Post::where('user_id', $user->id)->where('anniversary', true)->orderBy('created_at', 'desc')->paginate(12);
        $search = $request->input('search');
        $query = Post::where('user_id', $user->id);

        if ($search) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($wordArraySearched as $value) {
                $query->where(function ($query) use ($value) {
                    $query->orWhere('title', 'like', '%' . $value . '%')
                        ->orWhere('body', 'like', '%' . $value . '%');
                });
            }

            $posts = $query->where('anniversary', true)->orderBy('created_at', 'desc')->paginate(12);
        }

        return view('post.index', compact('user', 'posts', 'search'));
    }

    public function create(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }

        $post->anniversary = true;
        $post->save();
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }

        $post->anniversary = false;
        $post->save();
    }
}
