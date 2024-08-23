<?php

namespace App\Livewire;

use App\Models\CommentLike;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $comment;

    public $commentBody;

    public $likes = 0;

    public $userLiked = false;

    public $isReply = false;

    public $observe = false;


    public function mount($comment): void
    {
        $this->comment = PostComment::with('likes')->where('id', $this->comment->id)->first();
        $this->commentBody = "";
        $this->likes = $comment->likes->count();

        if (!Auth::guest()) {
            $this->userLiked = CommentLike::where([
                ['user_id', Auth::id()],
                ['post_comment_id', $this->comment->id],
            ])->count() > 0;
        }

        if ($this->comment->parent_id != null)
            $this->isReply = true;
    }

    public function render()
    {
        return view('livewire.comment');
    }

    public function likeComment()
    {
        if (Auth::guest())
            return $this->redirect("/auth?redirect=" . url()->previous());

        if (!$this->userLiked) {
            $newLike = new CommentLike;
            $newLike->post_comment_id = $this->comment->id;
            $newLike->user_id = Auth::id();
            $newLike->save();

            $this->likes = CommentLike::where('post_comment_id', $this->comment->id)->count();
            $this->userLiked = true;
        } else {
            CommentLike::where([
                ['post_comment_id', $this->comment->id],
                ['user_id', Auth::id()],
            ])->delete();
            $this->likes = CommentLike::where('post_comment_id', $this->comment->id)->count();
            $this->userLiked = false;
        }
    }

    public function submitComment()
    {
        $this->validate([
            "commentBody"  => "required"
        ]);

        PostComment::create([
            'parent_id' => $this->comment->id,
            'user_id'   => Auth::user()->id,
            'post_id'   => $this->comment->post->id,
            'comment'      => $this->commentBody
        ]);

        $this->commentBody = "";
    }
}
