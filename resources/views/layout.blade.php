@include('partials.head')

<header>
    @yield('header')
</header>
<section class="flex flex-1">
    <aside class="w-[20%]">
        @include('partials.dashboard-nav')
    </aside>
    <main class="w-[80%] h-full p-4">
        @yield('content')
    </main>
</section>

@include('partials.footer')
