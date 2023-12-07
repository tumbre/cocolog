<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;

class PostService
{
    public function getPostsBySearch(Request $request, $user, $anniversary = false)
    {
        $posts = Post::where('user_id', $user->id);

        if ($anniversary) {
            $posts->where('anniversary', true);
        }

        $search = $request->input('search');

        if ($search) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            $posts->where(function ($query) use ($wordArraySearched) {
                foreach ($wordArraySearched as $value) {
                    $query->orWhere('title', 'like', '%' . $value . '%')
                        ->orWhere('body', 'like', '%' . $value . '%');
                }
            });
        }

        return $posts->orderBy('created_at', 'desc')->paginate(12)->appends(['search' => $search]);
    }
}