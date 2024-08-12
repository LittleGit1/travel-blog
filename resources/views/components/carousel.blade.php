@props([
    'images' => false,
])

<div x-data="carousel" class="relative max-w-full overflow-hidden rounded-xl">
    <div class="absolute top-[50%] z-10 translate-y-[-50%] left-2 right-2 flex justify-between">
        <button @click="moveSlide(-1)"
            class="bg-[#ffffff44] hover:bg-[#ffffffcc] transition-colors duration-100 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </button>
        <button @click="moveSlide(1)"
            class="bg-[#ffffff44] hover:bg-[#ffffffcc] transition-colors duration-100 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>
    </div>
    <div class="slides relative flex transition-transform duration-500">
        @foreach ($images as $image)
            <img class="slide min-w-full border-box aspect-square object-cover" width="800" height="800"
                src="{{ asset('img/posts/carousel/' . $image->public_path) }}" alt="">
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('carousel', () => ({
            currentIndex: 0,

            moveSlide(direction) {
                this.showSlide(this.currentIndex + direction);
            },

            showSlide(index) {
                const slides = document.querySelectorAll('img.slide');

                if (index >= slides.length) {
                    this.currentIndex = 0;
                } else if (index < 0) {
                    this.currentIndex = slides.length - 1;
                } else {
                    this.currentIndex = index;
                }
                const newTransformValue = -this.currentIndex * 100 + '%';
                document.querySelector('.slides').style.transform =
                    `translateX(${newTransformValue})`;
            }
        }))
    })
</script>
