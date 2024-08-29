@extends('layout')

@section('header')
    <x-dashboard-header>
        <div>
            <ul>
                <li>
                    <a href="/blog/posts/create" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Create Post</a>
                </li>
            </ul>
        </div>
    </x-dashboard-header>
@endsection

@section('content')
    <h1>Dashboard</h1>
@endsection
