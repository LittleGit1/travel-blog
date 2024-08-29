@include('partials.head')

<header>
    @yield('header')
</header>

<section class="w-full">
    <main class="container mx-auto h-full">
        @yield('content')
    </main>
</section>

@include('partials.footer')
