@extends('layout')

@section('header')
    <x-dashboard-header>
        <div>
            <ul>
                <li>
                    <a href="/account" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Dashboard</a>
                </li>
            </ul>
        </div>
    </x-dashboard-header>
@endsection

@section('content')
    <div class="flex gap-x-2 items-center">
        <h1 class="text-3xl font-medium">Flights</h1>
        <a href="/account/journey/flights/create">
            <x-svg-icon icon_name="plus_circle" size="size-7"></x-svg-icon>
        </a>
    </div>

    <table class="w-full">
        <tr>
            <th class="text-left font-semibold text-lg w-[10%]">#</th>
            <th class="text-left font-semibold text-lg w-[30%]">Origin</th>
            <th class="text-left font-semibold text-lg w-[30%]">Destination</th>
            <th class="text-left font-semibold text-lg w-[15%]">Edit</th>
            <th class="text-left font-semibold text-lg w-[15%]">Delete</th>
        </tr>
        @foreach ($flights as $key => $flight)
            <tr class="hover:bg-gray-200">
                <td class="w-[10%]">{{ $key + 1 }}</td>
                <td class="w-[30%]">{{ $flight->origin_name }}</td>
                <td class="w-[30%]">{{ $flight->destination_name }}</td>
                <td class="flex items-center w-[15%]">
                    <a href="/account/journey/flights/{{ $flight->id }}/edit" class="w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                </td>
                <td class="w-[15%]">
                    <form action="/account/journey/flights/{{ $flight->id }}" method="POST" class="flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-6 h-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="flex gap-x-2 items-center">
        <h1 class="text-3xl font-medium">Countries</h1>
        <a href="/account/journey/countries/create">
            <x-svg-icon icon_name="plus_circle" size="size-7"></x-svg-icon>
        </a>
    </div>

    <table class="w-full">
        <tr>
            <th class="text-left font-semibold text-lg w-[10%]">#</th>
            <th class="text-left font-semibold text-lg w-[30%]">Name</th>
            <th class="text-left font-semibold text-lg w-[15%]">Edit</th>
            <th class="text-left font-semibold text-lg w-[15%]">Delete</th>
        </tr>
        @foreach ($countries as $key => $country)
            <tr class="hover:bg-gray-200">
                <td class="w-[10%]">{{ $key + 1 }}</td>
                <td class="w-[30%]">{{ $country->name }}</td>
                <td class="flex items-center w-[15%]">
                    <a href="/account/journey/countries/{{ $country->id }}/edit" class="w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                </td>
                <td class="w-[15%]">
                    <form action="/account/journey/countries/{{ $country->id }}" method="POST" class="flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-6 h-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
