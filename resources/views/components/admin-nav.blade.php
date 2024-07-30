<section class="py-12 bg-slate-700">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="font-medium text-2xl text-white">Welcome back, {{ Auth()->user()->name }}</h1>
        <div>
            {{ $slot }}
        </div>
    </div>
</section>
