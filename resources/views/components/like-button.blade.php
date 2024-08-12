@props([
    'postId' => null,
    'userLiked' => null,
])

<button x-data="likeButton" @click="sendToggleRequest" id="toggleLike"
    class="rounded-full inline-flex justify-center items-center bg-gray-200 w-10 h-10">
    <svg xmlns="http://www.w3.org/2000/svg" :fill="liked ? 'red' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
        :stroke="liked ? 'red' : 'currentColor'" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
    </svg>
</button>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('likeButton', () => ({
            liked: Boolean({{ $userLiked }}),

            sendToggleRequest() {

                this.liked = !this.liked;

                this.makeRequest()
                    .then((res) => {
                        if (res.status === 401 || res.status === 419)
                            return window.location.href =
                                "{{ route('login', ['redirect' => url()->current()]) }}"
                    })
            },

            makeRequest() {
                return fetch(`http://travel-blog.test/blog/posts/{{ $postId }}/like`, {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': this.getCsrfToken(),
                    }
                });
            },

            getCsrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
        }))
    })
</script>
