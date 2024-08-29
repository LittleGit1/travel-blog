<nav class="min-w-[200px]">
    <ul>
        <x-nav-link href="/account/profile">Profile</x-nav-link>
        <x-nav-link href="/account/posts">Posts</x-nav-link>
        @if (Auth::user()->admin)
            <x-nav-link href="/account/users">Users</x-nav-link>
            <x-nav-link href="/account/categories">Post Categories</x-nav-link>
            <x-nav-link href="/account/journey">Journey</x-nav-link>
        @endif
        <form action="/auth" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">Sign out</button>
        </form>
    </ul>
</nav>
