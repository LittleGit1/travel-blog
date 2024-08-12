<nav x-data="navigation" x-cloak class="w-full flex justify-end">

    <button @click="toggleDrawer" :class="drawerOpen ? 'bg-slate-200' : 'bg-transparent'"
        class="cursor-pointer fixed top-4 right-4 w-12 h-12 px-3 rounded-[4px] transition-[background-color] duration-[0.4s] ease-in border-none hover:bg-slate-200">
        <div class="w-6 h-[0.09rem] bg-black mb-[0.4rem]"></div>
        <div :class="drawerOpen ? 'w-4' : 'w-6'"
            class="h-[0.09rem] bg-black transition-[width] duration-[0.4s] mt-[0.4rem]"></div>
    </button>

    <div :class="drawerOpen ? 'translate-x-[0%]' : 'translate-x-[-100%]'"
        class="fixed left-0 top-0 h-full w-[20%] flex flex-col justify-between z-10 bg-white transition-transform duration-[400ms] ease-in">

        <ul>
            <x-nav-link href="/">Home</x-nav-link>
            <x-nav-link href="/blog/posts">Blog</x-nav-link>
        </ul>

        <ul>
            <x-nav-link href="/account/dashboard" :requiresAuth="true" :isIconLink="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </x-nav-link>
        </ul>

    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navigation', () => ({
            drawerOpen: false,
            toggleDrawer() {
                this.drawerOpen = !this.drawerOpen;
            }
        }))
    })
</script>
