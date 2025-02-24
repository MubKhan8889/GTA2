@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-gray-600']) }}>
    {{ $value ?? $slot }}
</label>