<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController
{
    public function post_like(Post $post)
    {

        $userId = Auth::user()->getAuthIdentifier();

        $like = PostLike::where([
            ['post_id', '=', $post->id],
            ['user_id', '=', Auth::user()->id]
        ])
            ->first();

        if (!is_null($like)) {
            $like->delete();
            return response()->json(["success" => true, "liked" => false], 200);
        }

        PostLike::create([
            'post_id'   => $post->id,
            'user_id'   => $userId
        ]);

        return response()->json(["success" => true, "liked" => true], 200);
    }

    public function user_has_liked(Post $post)
    {

        if (Auth::guest()) return response()->json(["liked" => false], 200);

        $like = PostLike::where([
            ['post_id', '=', $post->id],
            ['user_id', '=', Auth::user()->id]
        ])
            ->first();

        if (is_null($like)) return response()->json(["liked" => false], 200);

        return response()->json(["liked" => true], 200);
    }
}
