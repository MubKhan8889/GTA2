@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Employer') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Main Content -->
        <div class="p-6">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <!-- Display Employer Name Dynamically -->
                <h2 class="text-xl font-semibold">
                    Welcome, {{ Auth::user()->name ?? 'Employer' }}
                </h2>

                <!-- RAG Status -->
                <div class="mt-4">
                    <h3 class="font-semibold">Overall Apprentice RAG</h3>
                    <div class="flex items-center space-x-2">
                        <span class="bg-green-500 w-6 h-6 inline-block"></span> <span>Progress RAG</span>
                        <span class="bg-yellow-500 w-6 h-6 inline-block"></span> <span>OTJ RAG</span>
                        <span class="bg-red-500 w-6 h-6 inline-block"></span> <span>Employment RAG</span>
                    </div>
                </div>

                <!-- Active Apprentices -->
                <div class="mt-4">
                    <h3 class="font-semibold">Active Apprentices</h3>
                    <ul class="list-disc pl-6">
                        <li>Apprentice 1: Mechanical Engineering</li>
                        <li>Apprentice 2: Electrical Maintenance</li>
                        <li>Apprentice 3: Vehicle Diagnostics</li>
                    </ul>
                </div>

                <!-- Overdue Tasks -->
                <div class="mt-4">
                    <h3 class="font-semibold">Overdue Apprentice Tasks</h3>
                    <ul class="list-disc pl-6">
                        <li>Apprentice 4: Safety Compliance Training</li>
                        <li>Apprentice 5: Advanced Diagnostics Report</li>
                        <li>Apprentice 6: Final Assessment Preparation</li>
                    </ul>
                </div>

                <!-- Hours Information -->
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold">Overall hours this month</h3>
                        <ul class="list-disc pl-6">
                            <li>Training Center: 14.5</li>
                            <li>Employer: 10.2</li>
                            <li>Specialist Training: 1.5</li>
                            <li>VLE Training: 3.1</li>
                            <li>Total hours: 29.3</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold">Overall hours in total</h3>
                        <ul class="list-disc pl-6">
                            <li>Training Center: 92.7</li>
                            <li>Employer: 45.8</li>
                            <li>Specialist Training: 22.0</li>
                            <li>VLE Training: 50.3</li>
                            <li>Total hours: 210.8</li>
                            <li>Expected Hours: 200</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
