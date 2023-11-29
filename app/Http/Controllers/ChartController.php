<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $scores = Post::where('user_id', $user)->pluck('score');
        $magnitude = Post::where('user_id', $user)->pluck('magnitude');
        $titles = Post::where('user_id', $user)->pluck('title');
        $dates = Post::where('user_id', $user)->pluck('created_at');
        $formattedDates = $dates->map(function ($date) {
            return Carbon::parse($date)->format('n/j');
        });
        
        return view('chart', compact('scores', 'magnitude', 'formattedDates'));
    }
}