<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\SentimentAnalysisService;
use App\Services\ImageUploadService;
use App\Services\ValidationService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Language\LanguageClient;

class PostController extends Controller
{
    protected $postService;
    protected $imageUploadService;
    protected $validationService;

    public function __construct(ValidationService $validationService, PostService $postService, ImageUploadService $imageUploadService)
    {
        $this->middleware('AuthenticateUser');
        $this->middleware('checkPostOwnership')->only('show', 'edit', 'update', 'destroy');
        $this->validationService = $validationService;
        $this->postService = $postService;
        $this->imageUploadService = $imageUploadService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $posts = $this->postService->getPostsBySearch($request, $user);
        $allPosts = Post::where('user_id', $user->id)->get(['title'])->flatMap(function ($post) { return [$post->title]; })->filter()->values()->toArray();
        $search = $request->input('search');

        return view('post.index', compact('user', 'posts', 'allPosts', 'search'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request, SentimentAnalysisService $sentimentService, ImageUploadService $imageUploadService)
    {
        $inputs = $this->validationService->validatePostData($request->all(), auth()->user()->id);

        $text = $inputs['title'] . ' ' . $inputs['body'];
        $sentimentData = $sentimentService->analyzeSentiment($text);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->created_at = $inputs['created_at'];
        $post->score = $sentimentData['score'];
        $post->magnitude = $sentimentData['magnitude'];

        $imageUploadService->uploadImage($request, $post);

        $post->save();

        return redirect()->route('post.show', compact('post'))->with('message', '投稿を作成しました');
    }

    public function show(Post $post)
    {
        $user = auth()->user();
        $previous = Post::where('id', '<', $post->id)->where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $next = Post::where('id', '>', $post->id)->where('user_id', $user->id)->orderBy('id')->first();

        return view('post.show', compact('user', 'post', 'previous', 'next'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post, SentimentAnalysisService $sentimentService, ImageUploadService $imageUploadService)
    {
        $inputs = $this->validationService->validatePostData($request->all(), auth()->user()->id, $post->id);

        $text = $inputs['body'] . ' ' . $inputs['body'];
        $sentimentData = $sentimentService->analyzeSentiment($text);

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->created_at = $inputs['created_at'];
        $post->score = $sentimentData['score'];
        $post->magnitude = $sentimentData['magnitude'];

        $imageUploadService->uploadImage($request, $post);

        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    public function destroy(Post $post)
    {
        $this->imageUploadService->deleteImage($post->image);
		$post->delete();
		return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }
}
