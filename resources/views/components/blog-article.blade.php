@props([
    'post' => null,
])

<a class="p-4 rounded-xl bg-gray-100 flex flex-col min-h-[150px]" href="/blog/posts/{{ $post->slug }}">
    <h3 class="text-2xl font-medium grow">{{ $post->title }}</h3>
    <span class="text-xs mt-2">
        {{ $post->user->username }} | {{ $post->created_at->diffForHumans() }}
    </span>
</a>
