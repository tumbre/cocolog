<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $posts = Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required | max:255',
            'body' => 'required | max:1000',
            'image' => 'image | max:1024'
        ]);
        $post = new Post();
            $post->title = $inputs['title'];
            $post->body = $inputs['body'];
            $post->user_id = auth()->user()->id;
        if (request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->storeAs('public/images', $name);
            $post->image = $name;
        }
        $post->save();
        return redirect()->route('post.create')->with('message', '投稿を作成しました');
    }

    public function show(Post $post)
    {
        $user = auth()->user()->id;
        $posts = Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $inputs = $request->validate([
            'title' => 'required | max:255',
            'body' => 'required | max:1000',
            'image' => 'image | max:1024'
        ]);

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        if(request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    public function destroy(Post $post)
    {
		$post->delete();
		return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }
}
