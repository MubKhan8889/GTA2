@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-6 py-3 border-b-2 border-gray-400 bg-gray-100 text-lg font-medium leading-5 text-gray-700 w-full underline'
            : 'inline-flex items-center px-6 py-3 border-b-2 border-gray-400 bg-gray-200 text-lg font-normal leading-5 text-gray-600 w-full';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>