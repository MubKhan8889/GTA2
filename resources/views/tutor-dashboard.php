<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Tutor') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-200 h-screen p-4">
            <div class="bg-gray-300 p-4 text-center font-bold">
                GTA logo here
            </div>
            <ul class="mt-4 space-y-2">
                <li class="p-2 bg-white rounded">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="p-2 bg-white rounded">
                    <a href="{{ route('apprentice-progress') }}">Apprentice progress</a>
                </li>
                <li class="p-2 bg-white rounded">
                    <a href="{{ route('edit-apprentice') }}">Edit apprentice info</a>
                </li>
                <li class="p-2 bg-white rounded">
                    <a href="{{ route('archive-learners') }}">Archive learners</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-6">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <!-- Display Tutor Name Dynamically -->
                <h2 class="text-xl font-semibold">
                    Welcome, {{ Auth::user()->name ?? 'Tutor' }}
                </h2>

                <!-- RAG Status -->
                <div class="mt-4">
                    <h3 class="font-semibold">Overall Learner RAG</h3>
                    <div class="flex items-center space-x-2">
                        <span class="bg-green-500 w-6 h-6 inline-block"></span> <span>Progress RAG</span>
                        <span class="bg-yellow-500 w-6 h-6 inline-block"></span> <span>OTJ RAG</span>
                        <span class="bg-red-500 w-6 h-6 inline-block"></span> <span>Employment RAG</span>
                    </div>
                </div>

                <!-- Progress & Overdue Duties -->
                <div class="mt-4">
                    <h3 class="font-semibold">Overall in Progress Duties</h3>
                    <ul class="list-disc pl-6">
                        <li>Group 1: Foundation Skills</li>
                        <li>Group 1: Vehicle trim and panel components</li>
                        <li>Starting and changing systems</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h3 class="font-semibold">Overall Overdue Duties</h3>
                    <ul class="list-disc pl-6">
                        <li>Group 5: Steering and Suspension</li>
                        <li>Group 6: Transmission and Driveline</li>
                        <li>Gateway 2</li>
                    </ul>
                </div>

                <!-- Hours Information -->
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold">Overall hours this month</h3>
                        <ul class="list-disc pl-6">
                            <li>Training Center: 12.2</li>
                            <li>Employer: 8.5</li>
                            <li>Specialist Training: 0</li>
                            <li>VLE Training: 2.8</li>
                            <li>Total hours: 23.5</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold">Overall hours in total</h3>
                        <ul class="list-disc pl-6">
                            <li>Training Center: 85.4</li>
                            <li>Employer: 32.2</li>
                            <li>Specialist Training: 16.5</li>
                            <li>VLE Training: 42.9</li>
                            <li>Total hours: 176.8</li>
                            <li>Expected Hours: 150</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
