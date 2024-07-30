@include('partials.head')
@include('partials.nav')

<main class="container mx-auto">
    <form action="/blog/posts/create" method="POST">
        @csrf
        @method('POST')
        <div class="flex gap-4">
            <div class="flex flex-col gap-y-1 basis-[66.66%]">
                <label class="text-xs" for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old("title") ?? "" }}">
            </div>
            <div class="flex flex-col gap-y-1 basis-[33.33%]">
                <label class="text-xs" for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old("slug") ?? "" }}">
            </div>
        </div>
        <div class="flex flex-col gap-y-1">
            <label class="text-xs" for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="10">{{ old('body') ?? "" }}</textarea>
        </div>
        <div class="mt-4">
            <a class="rounded-md bg-red-500 text-white px-4 py-3 inline-block"
                href="{{ url()->previous() }}">Cancel</a>
            <button class="border-0 rounded-md bg-green-500 text-white px-4 py-3" type="submit">Save</button>
        </div>
    </form>
</main>

@include('partials.footer')
