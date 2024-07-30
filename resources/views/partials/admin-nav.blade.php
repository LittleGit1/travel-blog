<section class="flex gap-x-4 bg-gray-100">
    <div class="container mx-auto">
        <nav>
            <a href="/admin" class="rounded-md bg-gray-100 text-black px-4 py-3 inline-block hover:bg-gray-50">Dashboard</a>
            @if (Auth()->user()->admin)
                <a href="/admin/blog/categories" class="rounded-md bg-gray-100 text-black px-4 py-3 inline-block hover:bg-gray-50">Categories</a>
            @endif
        </nav>
    </div>
</section>