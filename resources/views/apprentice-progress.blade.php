<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your progress') }}
        </h2>
    </x-slot>

    <div class="flex">

        <!-- Main Content -->
        <div class="w-3/4 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <!-- Display Apprentice Name Dynamically -->
                <h2 class="text-xl font-semibold">
                    Welcome, {{ Auth::user()->name ?? 'Apprentice' }}
                </h2>

                <div class="font-semibold mt-6">
                    <h3>Year 1</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>