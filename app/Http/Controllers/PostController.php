<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Language\LanguageClient;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check()) {
                return redirect('/login')->with('message', 'ログインしてください');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(12);
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

            $posts = $query->orderBy('created_at', 'desc')->paginate(12);
        }

        return view('post.index', compact('posts', 'search'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required | max:255',
            'body' => 'required | max:100000',
            'image' => 'image | max:10000',
            'score' => 'numeric',
            'magnitude' => 'numeric'
        ]);

        $projectId = 'cocolog';
        $language = new LanguageClient([
            'projectId' => $projectId,
            'keyFile' => [
                "type" => env('TYPE'),
                "project_id" => env('PROJECT_ID'),
                "private_key_id" => env('PRIVATE_KEY_ID'),
                "private_key" => str_replace('\\n', "\n",env('PRIVATE_KEY')),
                "client_email" => env('CLIENT_EMAIL'),
                "client_id" => env('CLIENT_ID'),
                "auth_uri" => env('AUTH_URI'),
                "token_uri" => env('TOKEN_URI'),
                "auth_provider_x509_cert_url" => env('AUTH_PROVIDER_X509_CERT_URL'),
                "client_x509_cert_url" => env('CLIENT_X509_CERT_URL'),
                "universe_domain" => env('UNIVERSE_DOMAIN')
            ]
        ]);
        $text = $inputs['body'].' '.$inputs['body'];
        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();
        # scoreが0だと棒グラフに表示されなくなるため5を代入。チャートでは色を透明にして表示。
        if ($sentiment['score'] == 0) {
            $score = 5;
        } else {
            $score = $sentiment['score'] * 100;
        }
        $magnitude = $sentiment['magnitude'] * 10;

        $post = new Post();
            $post->title = $inputs['title'];
            $post->body = $inputs['body'];
            $post->user_id = auth()->user()->id;
            $post->score = $score;
            $post->magnitude = $magnitude;

        if ($request->hasFile('image')) {
            if (app()->isLocal()) {
                $original = request()->file('image')->getClientOriginalName();
                $name = date('Ymd_His').'_'.$original;
                request()->file('image')->storeAs('public/images', $name);
                $post->image = $name;
            } else {
                $image = $request->file('image');
                $path = Storage::disk('s3')->put('/', $image, 'public');
                $post->image = Storage::disk('s3')->url($path);
            }
        }
        $post->save();

        return redirect()->route('post.show', compact('post'))->with('message', '投稿を作成しました');
    }

    public function show(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }
        $previous = Post::where('id', '<', $post->id)->where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $next = Post::where('id', '>', $post->id)->where('user_id', $user->id)->orderBy('id')->first();

        return view('post.show', compact('post', 'previous', 'next'));
    }

    public function edit(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }
        $inputs = $request->validate([
            'title' => 'required | max:255',
            'body' => 'required | max:10000',
            'image' => 'image | max:10000',
            'score' => 'numeric',
            'magnitude' => 'numeric'
        ]);

        $projectId = 'cocolog';
        $language = new LanguageClient([
            'projectId' => $projectId,
            'keyFile' => [
                "type" => env('TYPE'),
                "project_id" => env('PROJECT_ID'),
                "private_key_id" => env('PRIVATE_KEY_ID'),
                "private_key" => str_replace('\\n', "\n",env('PRIVATE_KEY')),
                "client_email" => env('CLIENT_EMAIL'),
                "client_id" => env('CLIENT_ID'),
                "auth_uri" => env('AUTH_URI'),
                "token_uri" => env('TOKEN_URI'),
                "auth_provider_x509_cert_url" => env('AUTH_PROVIDER_X509_CERT_URL'),
                "client_x509_cert_url" => env('CLIENT_X509_CERT_URL'),
                "universe_domain" => env('UNIVERSE_DOMAIN')
            ]
        ]);
        $text = $inputs['body'].' '.$inputs['body'];
        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();
        # scoreが0だと棒グラフに表示されなくなるため5を代入。チャートでは色を透明にして表示。
        if ($sentiment['score'] == 0) {
            $score = 5;
        } else {
            $score = $sentiment['score'] * 100;
        }
        $magnitude = $sentiment['magnitude'] * 10;

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->score = $score;
        $post->magnitude = $magnitude;

        if ($request->hasFile('image')) {
            if (app()->isLocal()) {
                $original = request()->file('image')->getClientOriginalName();
                $name = date('Ymd_His').'_'.$original;
                request()->file('image')->storeAs('public/images', $name);
                $post->image = $name;
            } else {
                $image = $request->file('image');
                $path = Storage::disk('s3')->put('/', $image, 'public');
                $post->image = Storage::disk('s3')->url($path);
            }
        }
        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();

        if ($user->id !== $post->user_id) {
            return redirect('/');
        }
        
		$post->delete();

		return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }
}
