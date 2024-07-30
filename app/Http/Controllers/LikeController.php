<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LikeController extends Controller
{
    public function like(Request $request, Post $post)
    {

        if(Auth()->guest()){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userId = Auth()->user()->getAuthIdentifier();

        $like = PostLike::all()->where('user_id', $userId)->where('post_id', $post->id)->first();

        $hasAlreadyLiked = !is_null($like);

        if ($hasAlreadyLiked) {
            $like->delete();
            return response()->json(["success" => true, "likes" => PostLike::where('post_id', $post->id)->count()], 200);
        }
        $newLike = new PostLike;
        $newLike->user_id = $userId;
        $newLike->post_id = $post->id;
        $newLike->save();

        return response()->json(["success" => true, "likes" => PostLike::where('post_id', $post->id)->count()],200);

    }
}
