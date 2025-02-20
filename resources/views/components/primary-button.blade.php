<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md text-sm text-white uppercase hover:bg-gray-600 active:bg-gray-800']) }}>
    {{ $slot }}
</button>
