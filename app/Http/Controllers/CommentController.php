<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Notifications\CommentNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController
{
    public function store(Request $request, $postId): JsonResponse
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $newComment = new PostComment;
        $newComment->user_id = Auth()->user()->getAuthIdentifier();
        $newComment->post_id = $postId;
        $newComment->body = $request->comment;
        $newComment->save();

        return response()->json(["success" => true]);
    }
}
