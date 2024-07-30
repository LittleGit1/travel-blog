@include('partials.head')
@include('partials.nav')

<main>
    <div class="container mx-auto relative">
        <nav class="fixed left-10 bottom-10 z-[1]">
            <a href="/blog/posts" class="rounded-full w-16 h-16 bg-gray-500 flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="#fff" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                </svg>
            </a>
        </nav>
        <div class="grid grid-cols-1 py-8 max-w-[640px] mx-auto rounded-md">
            <figure class="overflow-hidden rounded-tl-md rounded-tr-md">
                <img width="800" height="800" src="https://picsum.photos/1000" alt="">
            </figure>
            <div class="px-6 py-4 bg-gray-100 rounded-bl-md rounded-br-md">
                <h1 class="text-2xl font-medium">{{ $post->title }}</h1>
                <div class="inline-block mt-2">
                    <a href="/blog/posts/user/{{ $post->user->external_id }}"
                       class="text-xs mt-3">{{ $post->user->name }}</a>
                    <span class="text-xs mt-3"> |
                    <span>{{ \App\Helpers\DateHelper::getTimeago($post->created_at) }}</span></span>
                </div>

                <div class="mt-2 flex gap-x-2" x-data="postShow">
                    <x-like-button :userLiked="$userLiked"
                                   postId="{{ $post->id }}"
                                   :likes="$likes">
                    </x-like-button>


                    <x-comment-button @click="scrollIntoView"></x-comment-button>

                    <x-share-button></x-share-button>
                </div>

                <p class="mt-6">{{ $post->body }}</p>
            </div>
        </div>
    </div>
    <div id="comments" class="bg-sky-300 py-24">
        <div class="container mx-auto max-w-[640px] h-[500px] rounded-lg overflow-hidden" id="root">
            <livewire:comments postId="{{$post->id}}"/>
        </div>
    </div>
</main>

@include('partials.footer')

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('postShow', () => ({
            scrollIntoView() {
                document.getElementById('comments').scrollIntoView();
            }
        }))
    })
</script>