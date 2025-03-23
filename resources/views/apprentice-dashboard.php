@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Apprentice') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Main Content -->
        <div class="w-3/4 p-6">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <!-- Display Apprentice Name Dynamically -->
                <h2 class="text-xl font-semibold">
                    Welcome, {{ Auth::user()->name ?? 'Apprentice' }}
                </h2>

                <!-- RAG Status -->
                <div class="mt-4">
                    <h3 class="font-semibold">Overall RAG</h3>
                    <div class="flex items-center space-x-2">
                        <span class="bg-green-500 w-6 h-6 inline-block"></span> <span>Progress RAG</span>
                        <span class="bg-yellow-500 w-6 h-6 inline-block"></span> <span>OTJ RAG</span>
                        <span class="bg-red-500 w-6 h-6 inline-block"></span> <span>Employment RAG</span>
                    </div>
                </div>

                <!-- Interactive Skills Section -->
                <div class="mt-4" x-data="{ activeTab: 'progress' }">
                    <h3 class="font-semibold">Skills Progress</h3>
                    <div class="flex space-x-4">
                        <button @click="activeTab = 'progress'" 
                                :class="{'bg-blue-500 text-white': activeTab === 'progress', 'bg-gray-200': activeTab !== 'progress'}" 
                                class="px-4 py-2 rounded">
                            In Progress
                        </button>
                        <button @click="activeTab = 'overdue'" 
                                :class="{'bg-blue-500 text-white': activeTab === 'overdue', 'bg-gray-200': activeTab !== 'overdue'}" 
                                class="px-4 py-2 rounded">
                            Overdue
                        </button>
                    </div>
                    
                    <div class="mt-4">
                        <!-- In Progress Duties -->
                        <ul x-show="activeTab === 'progress'" class="list-disc pl-6">
                            @foreach(Auth::user()->apprentice->duties as $duty)
                                @if($duty->pivot->completed_date === null && $duty->pivot->due_date >= now())
                                    <li>{{ $duty->name }} (Due: {{ $duty->pivot->due_date->format('F j, Y') }})</li>
                                @endif
                            @endforeach
                        </ul>

                        <!-- Overdue Duties -->
                        <ul x-show="activeTab === 'overdue'" class="list-disc pl-6">
                            @foreach(Auth::user()->apprentice->duties as $duty)
                                @if($duty->pivot->completed_date === null && $duty->pivot->due_date < now())
                                    <li>{{ $duty->name }} (Overdue since: {{ $duty->pivot->due_date->format('F j, Y') }})</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Hours Information -->
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold">Your hours this month</h3>
                        <ul class="list-disc pl-6">
                            <li>Training Center: 12.2</li>
                            <li>Employer: 8.5</li>
                            <li>Specialist Training: 0</li>
                            <li>VLE Training: 2.8</li>
                            <li>Total hours: 23.5</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold">Your hours in total</h3>
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
@endsection
