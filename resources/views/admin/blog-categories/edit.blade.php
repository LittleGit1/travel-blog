@include('partials.head')
<x-admin-nav></x-admin-nav>
@include('partials.admin-nav')

<main class="container mx-auto">
    <div class="my-4">
        <form action="/admin/blog/categories/{{ $category->slug }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex gap-4">
                <div class="flex flex-col gap-y-1 basis-[50%]">
                    <label class="text-xs" for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ $category->title }}">
                </div>
                <div class="flex flex-col gap-y-1 basis-[50%]">
                    <label class="text-xs" for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ $category->slug }}">
                </div>
            </div>
            <div class="my-2">
                <a href="{{URL()->previous()}}" class="rounded-md bg-red-500 text-white px-4 py-3 inline-block">Cancel</a>
                <button type="submit" class="border-0 rounded-md bg-green-500 text-white px-4 py-3">Save</button>
            </div>
        </form>
    </div>
</main>

@include('partials.footer')
