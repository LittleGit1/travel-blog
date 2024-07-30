@include('partials.head')

<x-admin-nav>
    <a href="/admin/blog/categories/create" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Create Category</a>
</x-admin-nav>

@include('partials.admin-nav')

<main class="container mx-auto">
    <ul class="flex flex-col gap-y-2 mt-4">
        @foreach ($categories as $category)
            <li class="bg-gray-50 hover:bg-gray-100">
                <a href="/admin/blog/categories/{{ $category->slug }}/edit" class="py-3 px-4 flex justify-between">
                    <div>
                        {{ $category->title }}
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</main>

@include('partials.footer')
