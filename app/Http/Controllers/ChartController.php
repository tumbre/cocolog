<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('AuthenticateUser');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $numberOfDays = $request->input('numberOfDays', 30);

        $latestPosts = Post::where('user_id', $user->id)
            ->where('created_at', '<=', now())
            ->where('created_at', '>=', Carbon::now()->subDays($numberOfDays))
            ->orderBy('created_at')
            ->get();

        $scores = $latestPosts->pluck('score')->map(fn($score) => $score / 10);
        $indexes = $latestPosts->pluck('id');
        $magnitude = $latestPosts->pluck('magnitude');
        $titles = $latestPosts->pluck('title');
        $formattedDates = $latestPosts->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('n/j');
        });

        return view('chart', compact('scores', 'indexes', 'magnitude', 'titles', 'formattedDates', 'numberOfDays'));
    }
}
