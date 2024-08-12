@props([
    'isIconLink' => false,
    'requiresAuth' => false,
])

@if ($isIconLink)
    <li class="block">
        <a class="inline-block ml-4 my-[0.8rem]"
            href="{{ $requiresAuth && Auth::guest() ? route('login', ['redirect' => '/account/dashboard']) : $attributes['href'] }}">
            {{ $slot }}
        </a>
    </li>
@else
    <li class="block">
        <a class="block px-4 py-[0.8rem] transition-[background-color] duration-200 ease-in hover:bg-slate-200 visited:text-inherit font-['Work_Sans'] text-2xl"
            href="{{ $requiresAuth && Auth::guest() ? route('login', ['redirect' => '/dashboard']) : $attributes['href'] }}">{{ $slot }}</a>
    </li>
@endif
