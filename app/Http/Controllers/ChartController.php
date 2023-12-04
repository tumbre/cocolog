<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller
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
    
    public function index()
    {
        $user = auth()->user();
        $scores = array_map(fn($score) => $score / 10, Post::where('user_id', $user->id)->pluck('score')->toArray());
        $indexes = Post::where('user_id', $user->id)->pluck('id');
        $magnitude = Post::where('user_id', $user->id)->pluck('magnitude');
        $titles = Post::where('user_id', $user->id)->pluck('title');
        $dates = Post::where('user_id', $user->id)->pluck('created_at');
        $formattedDates = $dates->map(function ($date) {
            return Carbon::parse($date)->format('n/j');
        });
        
        return view('chart', compact('scores', 'indexes', 'magnitude', 'titles', 'formattedDates'));
    }
}