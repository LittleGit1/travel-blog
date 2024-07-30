<div x-init="observe({{$observe}})">
    @if(!$isReply)
        <div x-data="{ showReplies: false, showReplyForm: false}" class="flex gap-3 bg-white rounded-lg p-3">

            @if(!is_null($comment->user))
                <img class="rounded-full w-10 h-10 object-cover select-none" src="https://picsum.photos/30" alt="">
            @else
                <img class="rounded-full w-10 h-10 object-cover select-none"
                     src="{{asset('/img/avatar_placeholder.png')}}" alt="">
            @endif

            <div class="grow">

                <div class="flex gap-x-1 pb-1">
                    <span
                        class="text-xs font-medium">{{!is_null($comment->user) ? $comment->user->username : 'User'}}</span>
                    <span
                        class="text-xs text-gray-500">{{\App\Helpers\DateHelper::getTimeago($comment->created_at)}}</span>
                </div>

                <p class="text-sm">{{$comment->body}}</p>

                <div class="flex gap-x-2">
                    @auth
                        <span @click="showReplyForm = !showReplyForm"
                              class="cursor-pointer text-xs text-gray-600 font-medium inline-block mt-1 select-none">Reply</span>
                    @endauth

                    @if(count($comment->replies) > 0)
                        <span @click="showReplies = !showReplies"
                              class="cursor-pointer text-xs text-gray-600 font-medium inline-block my-1 select-none">View replies...</span>
                    @endif

                </div>

                @if(count($comment->replies) > 0)
                    <ul x-show="showReplies" class="flex flex-col gap-2 mt-3">
                        @foreach($comment->replies as $reply)
                            <livewire:comment :observe="false" :comment="$reply" :key="$reply->id"></livewire:comment>
                        @endforeach
                    </ul>
                @endif

                @auth
                    <div x-show="showReplyForm" class="mt-3">
                        <x-post-comment-form></x-post-comment-form>
                    </div>
                @endauth

            </div>

            <x-comment-like :$likes :$userLiked :selfAlignCenter="$isReply"></x-comment-like>

        </div>
    @else
        <div class="flex gap-3 bg-white rounded-lg py-1">

            @if(!is_null($comment->user))
                <img class="rounded-full w-10 h-10 object-cover select-none" src="https://picsum.photos/30" alt="">
            @else
                <img class="rounded-full w-10 h-10 object-cover select-none"
                     src="{{asset('/img/avatar_placeholder.png')}}" alt="">
            @endif

            <div class="grow">

                <div class="flex gap-x-1 pb-1">
                    <span
                        class="text-xs font-medium">{{!is_null($comment->user) ? $comment->user->username : 'User'}}</span>
                    <span
                        class="text-xs text-gray-500">{{\App\Helpers\DateHelper::getTimeago($comment->created_at)}}</span>
                </div>

                <p class="text-sm">{{$comment->body}}</p>

                <div class="flex gap-x-2">
                    @auth
                        <span @click="showReplyForm = !showReplyForm"
                              class="cursor-pointer text-xs text-gray-600 font-medium inline-block mt-1 select-none">Reply</span>
                    @endauth
                </div>

            </div>

            <x-comment-like :$likes :$userLiked :selfAlignCenter="$isReply"></x-comment-like>

        </div>
    @endif
</div>

