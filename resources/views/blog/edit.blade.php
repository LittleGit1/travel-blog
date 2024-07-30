@include('partials.head', ['title' => 'Edit post'])
@include('partials.nav')

<main class="container mx-auto bg-gray-100">
    <form action="/blog/posts/{{$post->slug}}" method="POST" class="p-4 flex flex-col gap-y-2">
        @csrf
        @method('PUT')

        <div class="flex gap-4">
            <div class="flex flex-col gap-y-1 basis-[66.66%]">
                <label class="text-xs" for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="flex flex-col gap-y-1 basis-[33.33%]">
                <label class="text-xs" for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ $post->slug }}">
            </div>
        </div>

        <div class="flex flex-col gap-y-1">
            <label class="text-xs" for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="10">{{ $post->body }}</textarea>
        </div>
        <div>
            <a class="rounded-md bg-red-500 text-white px-4 py-3 inline-block" href="/users/{{$post->user_id}}/posts">Cancel</a>
            <button class="border-0 rounded-md bg-green-500 text-white px-4 py-3" type="submit">Save</button>
        </div>
    </form>
</main>

@include('partials.footer')