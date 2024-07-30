@props([
    "selfAlignCenter",
    "likes" => 0,
    'userLiked' => false
])

<button wire:click="likeComment" class="rounded-full px-1 py-1 inline-block items-center {{$selfAlignCenter ? 'self-center' : 'self-start'}}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="{{$userLiked ? 'red' : '#00000033'}}" viewBox="0 0 24 24" stroke-width="1.5"
         stroke="{{$userLiked ? 'red' : '#00000033'}}" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
    </svg>
    @if($likes > 0)
        <span class="text-xs font-medium select-none {{$userLiked ? 'text-red-600' : 'text-gray-400'}}">{{$likes}}</span>
    @endif
</button>
