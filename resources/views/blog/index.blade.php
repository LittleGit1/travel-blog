@include('partials.head', ['title' => 'Blog'])
@include('partials.nav')

<main class="container mx-auto flex flex-col flex-1 py-4">
    <div class="flex flex-1 flex-col">
        <ul class="grid grid-cols-3 gap-3 py-4 grow">
            @foreach ($posts as $post)
                @if ($loop->first)
                    <x-blog-article :isFirst="true" :post="$post" />
                    @continue
                @else
                @endif
                <x-blog-article :isFirst="false" :post="$post" />
            @endforeach
        </ul>
    </div>
    {{ $posts->links() }}
</main>

@include('partials.footer')
