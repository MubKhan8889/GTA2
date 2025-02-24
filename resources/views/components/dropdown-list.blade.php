<select {{ $attributes->merge(['class' => 'block pl-3 pr-8 py-1 rounded-md border-2 border-gray-400 focus:border-sky-400 focus:ring-sky-400 text-start text-md leading-5 text-gray-600 bg-gray-200']) }}>
    {{ $slot }}
</select>