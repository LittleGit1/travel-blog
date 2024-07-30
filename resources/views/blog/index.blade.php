@include('partials.head', ['title' => 'Blog'])
@include('partials.nav')

<main class="container mx-auto">
    <ul class="grid grid-cols-3 gap-3 py-4">
        @foreach ($posts as $post)
            @if ($loop->first)
                <x-blog-article :isFirst="true" :author="$post->user" title="{{$post->title}}" href="/blog/posts/{{ $post->slug }}"></x-blog-article>
                @continue
            @else
            @endif
            <x-blog-article :isFirst="false" :author="$post->user" title="{{$post->title}}" href="/blog/posts/{{ $post->slug }}">{{ $post->title }}</x-blog-article>
        @endforeach
    </ul>
    {{ $posts->links() }}
</main>

@include('partials.footer')
