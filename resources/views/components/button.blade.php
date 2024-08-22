@props([
    'htmlElement' => 'button',
    'backgroundColor' => 'bg-red-600',
    'color' => 'text-white',
])

@if ($htmlElement === 'anchor')
    <a {{ $attributes }}
        class="px-3 py-2 rounded-xl {{ $color }}  {{ $backgroundColor }}">{{ $slot }}</a>
@else
    <button {{ $attributes }} class="px-3 py-2 rounded-xl {{ $color }}  {{ $backgroundColor }}">
        {{ $slot }}
    </button>
@endif
