@extends('layout')

@section('header')
    <x-dashboard-header>
        <div>
            <ul>
                <li>
                    <a href="/blog/posts/create" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Create
                        Post</a>
                </li>
            </ul>
        </div>
    </x-dashboard-header>
@endsection

@section('content')
    <form action="/account/profile" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{ Auth::user()->email }}">

        <button type="submit">Update</button>
        <a href="/account/profile">Cancel</a>

    </form>
@endsection
