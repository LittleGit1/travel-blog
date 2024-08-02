<section class="bg-slate-500 py-12">
    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl text-white">Welcome back, {{Auth::user()->name}}</h1>
            {{ $slot }}
        </div>
    </div>
</section>
