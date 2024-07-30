@props([
    "isFirst" => false,
    "title" => "",
    "author" => []
])

<a class="p-4 rounded-xl bg-gray-100 {{$isFirst ? "col-span-3" : ""}}" {{$attributes}}>
    <h3 class="text-lg font-medium">{{ $title }}</h3>
    <h6 class="text-xs mt-2">{{ $author->name }}</h6>
</a>
