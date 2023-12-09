<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->middleware('AuthenticateUser');
        $this->middleware('checkPostOwnership')->only('create', 'destroy');
        $this->postService = $postService;
    }

    public function show(Request $request)
    {
        $user = auth()->user();
        $posts = $this->postService->getPostsBySearch($request, $user);
        $likedPosts = $this->postService->getPostsBySearch($request, $user, true);
        $search = $request->input('search');

        return view('calendar', compact('user', 'posts', 'likedPosts', 'search'));
    }

    public function getPosts()
    {
        $user = auth()->user();
        $posts = Post::all()->where('user_id', $user->id);
        $postDate = [];

        foreach ($posts as $post) {
            $event = [
                'id' => $post->id,
                'title' => $post->title,
                'start' => $post->created_at,
                'display' => '#4b4b4b',
                'url' => route('post.show', $post->id),
            ];

            if ($post->score == 5) {
                $event = array_merge($event, array('color' => '#f3f4f6'));
                $event = array_merge($event, array('borderColor' => 'rgba(178, 178, 178, 0.9)'));
                $event = array_merge($event, array('textColor' => '#242427'));
            } elseif ($post->score > 0) {
                $event = array_merge($event, array('color' => 'rgba(23, 50, 96, 0.9)'));
            } else {
                $event = array_merge($event, array('color' => 'rgba(235, 96, 56, 0.9)'));
            }

            $postData[] = $event;
        }
    
        return $postData;
    }
}
