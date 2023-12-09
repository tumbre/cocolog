<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->middleware('AuthenticateUser');
        $this->middleware('checkPostOwnership')->only('create', 'destroy');
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $posts = $this->postService->getPostsBySearch($request, $user, true);
        $search = $request->input('search');

        return view('post.index', compact('user', 'posts', 'search'));
    }

    public function create(Post $post)
    {
        $user = auth()->user();
        $post->anniversary = true;
        $post->save();
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();
        $post->anniversary = false;
        $post->save();
    }
}
