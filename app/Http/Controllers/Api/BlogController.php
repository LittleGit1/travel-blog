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

        $like = PostLike::all()->where('user_id', $userId)->where('post_id', $post->id)->first();

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
}
