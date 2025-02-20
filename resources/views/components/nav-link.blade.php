@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 border-b-2 border-gray-400 bg-gray-50 text-md font-medium leading-5 text-gray-700'
            : 'inline-flex items-center px-4 py-2 border-b-2 border-gray-400 bg-gray-100 text-md font-normal leading-5 text-gray-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>