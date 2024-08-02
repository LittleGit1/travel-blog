<nav class="bg-gray-100 h-full">
    <ul>
        <x-nav-link href="/account/posts">Posts</x-nav-link>
        @if(Auth::user()->admin)
            <x-nav-link href="/account/users">Users</x-nav-link>
            <x-nav-link href="/account/categories">Post Categories</x-nav-link>
        @endif
    </ul>
</nav>
