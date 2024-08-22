@props([
    'asLink' => false,
    'category' => null,
])

@if ($asLink)
    <a class="rounded-full px-3 py-2 text-sm bg-gray-200 h-9 inline-flex hover:bg-white transition-color duration-[0.3s]"
        href="/blog/posts?category={{ $category->slug }}">
        {{ $category->title }}
    </a>
@else
    <span class="rounded-full px-3 py-2 text-sm bg-gray-200 h-9 inline-flex">
        {{ $category->title }}
    </span>
@endif
