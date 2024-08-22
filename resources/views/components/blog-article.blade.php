@props([
    'post' => null,
])

<a class="p-4 rounded-xl bg-gray-100 flex flex-col min-h-[150px] grow" href="/blog/posts/{{ $post->slug }}">
    <h3 class="text-2xl font-medium">{{ $post->title }}</h3>
    <span class="text-xs mt-2">
        {{ $post->user->username }} | {{ $post->created_at->diffForHumans() }}
    </span>
    @if ($post->categories->count() > 0)
        <ul class="flex gap-2 mt-auto">
            @foreach ($post->categories as $category)
                <li>
                    <x-category-pill :category="$category"></x-category-pill>
                </li>
            @endforeach
        </ul>
    @endif
</a>
