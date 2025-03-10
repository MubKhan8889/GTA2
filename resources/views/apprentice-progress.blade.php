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

                <!-- Overall duties progress -->
                <table class="ml-6 mt-3 bg-gray-200">
                    <tr>
                        <th class="px-3 py-1 border-3 border-gray-400">Completed</th>
                        <th class="px-3 py-1">In progress</th>
                        <th class="px-3 py-1">Overdue</th>
                    </tr>
                    <tr>
                        <th class="px-3 pt-1"><span class="bg-green-400 inline-block h-4 w-2/3"></span></th>
                        <th class="px-3 pt-1"><span class="bg-yellow-400 inline-block h-4 w-1/2"></span></th>
                        <th class="px-3 pt-1"><span class="bg-red-400 inline-block h-4 w-1/3"></span></th>
                    </tr>
                </table>

                <!-- Duties info -->
            </div>
        </div>
    </div>
</x-app-layout>