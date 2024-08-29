@extends('layout')

@section('header')
    <x-dashboard-header>
        <div>
            <ul>
                <li>
                    <a href="/account" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Dashboard</a>
                    <a href="/blog/posts/create" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Create
                        post</a>
                </li>
            </ul>
        </div>
    </x-dashboard-header>
@endsection

@section('content')
    <form action="/account/password" method="POST">
        @csrf
        @dump($errors)
        @method('PATCH')
        @if ($errors->has('incorrect_password'))
            <span>{{ $errors->first('incorrect_password') }}</span>
        @endif
        @if ($errors->has('old_password'))
            <span>{{ $errors->first('old_password') }}</span>
        @endif
        <label for="old_password">Old password</label>
        <input type="password" name="old_password" id="old_password">

        @if ($errors->has('new_password'))
            <span>{{ $errors->first('new_password') }}</span>
        @endif
        <label for="new_password">New password</label>
        <input type="password" name="new_password" id="new_password">

        @if ($errors->has('retype_password'))
            <span>{{ $errors->first('retype_password') }}</span>
        @endif
        <label for="retype_password">Retype password</label>
        <input type="password" name="retype_password" id="retype_password">

        <button type="submit">Save</button>

    </form>
@endsection
