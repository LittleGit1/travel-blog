<section class="flex gap-x-4 bg-gray-100">
    <div class="container mx-auto">
        <nav>
            <a href="/users/{{ Auth()->user()->id }}/posts"
                class="rounded-md bg-gray-100 text-black px-4 py-3 inline-block hover:bg-gray-50">My posts</a>
            <a href="/blog/posts/create"
                class="rounded-md bg-gray-100 text-black px-4 py-3 inline-block hover:bg-gray-50">New
                post</a>
        </nav>
    </div>
</section>
