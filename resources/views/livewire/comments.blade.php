<div class="h-full bg-gray-100">
    <div class="{{ count($items) > 0 ? 'block' : 'hidden' }} h-full flex flex-col justify-between">
        <div x-data="commentsObserver" class="flex flex-col gap-2 p-3 overflow-y-scroll overflow-hidden scrollbar-hide">
            @foreach($items as $comment)
                <livewire:comment :comment="$comment" :observe="$loop->last" wire:key="comment-{{ $comment->id }}"/>
            @endforeach
        </div>
        <div class="bg-white px-4 py-4">
            <x-post-comment-form />
        </div>
    </div>
    <div class="{{count($items) === 0 ? 'block' : 'hidden'}} h-full">
        <x-no-comments/>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('commentsObserver', () => ({
                observer: null,

                init() {
                    this.observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                console.log("calling");
                                this.$wire.loadMore();
                            } else {
                                this.observer.unobserve(this.$el);
                            }
                        })
                    }, {
                        root: null,
                        rootMargin: "0px",
                        threshold: 1.0
                    });
                },

                observe(bool) {
                    if (bool) this.observer.observe(this.$el);
                }
            })
        )
    })
</script>
