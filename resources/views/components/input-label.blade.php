@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-gray-800']) }}>
    {{ $value ?? $slot }}
</label>