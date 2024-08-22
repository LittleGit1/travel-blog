@extends('layout')

@section('header')
    <x-dashboard-header>
        <div>
            <ul>
                <li>
                    <a href="/account/dashboard"
                        class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Dashboard</a>
                    <a href="/blog/posts/create" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Create
                        post</a>
                </li>
            </ul>
        </div>
    </x-dashboard-header>
@endsection

@section('content')
    <form action="/account/categories/create" method="POST">
        @csrf

        <div>
            @if ($errors->has('exists'))
                <p>Already exists</p>
            @endif
        </div>
        <div class="flex gap-4">
            <div class="flex flex-col gap-y-1 basis-[50%]">
                <label class="text-xs" for="title">Name</label>
                <input type="text" id="title" name="title" value="{{ old('title') ?? '' }}">
            </div>
            <div class="flex flex-col gap-y-1 basis-[50%]">
                <label class="text-xs" for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug') ?? '' }}">
            </div>
        </div>

        <div class="mt-2">
            <a href="{{ URL()->previous() }}" class="rounded-md bg-red-500 text-white px-4 py-3 inline-block">Cancel</a>
            <button class="border-0 rounded-md bg-green-500 text-white px-4 py-3" type="submit">Save</button>
        </div>
    </form>
@endsection
