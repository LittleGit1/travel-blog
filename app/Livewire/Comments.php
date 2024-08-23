<?php

namespace App\Livewire;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $postId;

    public $items = [];
    public $currentPage = 1;

    public $commentBody;

    public function mount()
    {
        $this->loadItems();
    }

    public function loadMore()
    {
        $this->currentPage++;
        $this->loadItems();
    }

    private function loadItems()
    {
        $newItems = PostComment::with(['replies', 'likes'])->where([
            ['post_id', $this->postId],
            ['parent_id', null]
        ])->paginate(5, ['*'], 'page', $this->currentPage);

        // Merge the new items with the existing items
        if ($newItems) {
            $this->items = array_merge($this->items, $newItems->items());
        }
    }


    public function render()
    {
        $items = PostComment::with(['replies', 'likes'])->where([
            ['post_id', $this->postId],
            ['parent_id', null]
        ])->paginate(5, ['*'], 'page', $this->currentPage)->items();

        return view('livewire.comments', [
            'items' => $items,
        ]);
    }

    public function submitComment()
    {

        $this->validate([
            "commentBody"  => "required"
        ]);

        $newComment = PostComment::create([
            'user_id'   => Auth::user()->id,
            'post_id'   => $this->postId,
            'comment'      => $this->commentBody
        ]);

        $this->commentBody = "";
        $this->items = array_merge($this->items, [$newComment->load(['replies', 'likes'])]);
    }
}
