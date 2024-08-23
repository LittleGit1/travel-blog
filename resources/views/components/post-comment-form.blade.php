<div class="flex outline outline-1 outline-offset-1 outline-slate-300 rounded-full px-1 -mx-1">
    <img src="https://picsum.photos/30" alt="" class="rounded-full w-10 h-10 object-cover my-1 mr-1">
    <div class="flex gap-x-2 items-center rounded-full min-h-10 grow my-1">
        <textarea wire:model="commentBody" name="comment_body" placeholder="What's on your mind..."
            class="text-sm rounded-tl-full rounded-bl-full resize-none grow h-10 pl-[0.6rem] pt-[0.6rem] focus:outline-none focus-visible:outline-none scrollbar-hide"></textarea>
        <button wire:click="submitComment"
            class="w-10 h-10 inline-flex rounded-full bg-gray-600 items-center justify-center self-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff"
                class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>
    </div>
</div>
