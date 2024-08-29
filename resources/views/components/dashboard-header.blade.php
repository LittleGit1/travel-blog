<section class="bg-slate-500 py-12">
    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl text-white pb-1">Welcome back, {{ Auth::user()->name }}</h1>
                <span class="text-gray-300">Joined {{ Auth::user()->created_at->diffForHumans() }}</span>
            </div>

            <div class="flex gap-4 items-center">
                {{ $slot }}

                <div x-data="adminNav" class="relative">
                    <figure @click="drawerOpen = !drawerOpen" class="cursor-pointer">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt=""
                                class="object-cover rounded-full w-12 h-12">
                        @else
                            <img src="{{ Storage::url('public/img/placeholder.png') }}" alt=""
                                class="object-cover rounded-full w-12 h-12">
                        @endif
                    </figure>

                    <div @click.outside="drawerOpen = false" class="absolute bg-gray-100 -translate-x-1/2"
                        x-show="drawerOpen" x-cloak>
                        @include('partials.dashboard-nav')
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('adminNav', () => ({
            drawerOpen: false
        }));
    })
</script>
