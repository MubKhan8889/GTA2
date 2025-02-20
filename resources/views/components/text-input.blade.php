@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-400 border-2 focus:border-sky-400 focus:ring-sky-400 rounded-md']) }}>
