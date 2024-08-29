@include('partials.head', ['title' => 'Blog'])
@include('partials.nav')

<main class="container mx-auto flex flex-col flex-1 py-4">
    <nav class="fixed left-10 bottom-10 z-[1]">
        <a href="{{ url()->previous() }}" class="rounded-full w-16 h-16 bg-gray-500 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff"
                class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </a>
    </nav>
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
