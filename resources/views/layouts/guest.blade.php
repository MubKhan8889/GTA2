<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GTA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=hanken-grotesk:400,600,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center bg-white">
            <!-- GTA logo goes here -->
            <img src="{{ route('image.show', 'GTALogo.png') }}" alt="Group Training Associaton Logo">

            <!-- Authentication goes here -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-200 border-2 border-gray-400 overflow-hidden xl:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
