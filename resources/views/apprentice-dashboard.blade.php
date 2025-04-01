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
                    Welcome, {{ $apprentice->user->name ?? 'Apprentice' }}
                </h2>

                <!-- RAG Status -->
                <div class="mt-4">
                    <h3 class="font-semibold">Overall RAG</h3>
                    <div class="flex items-center space-x-2">
                        <span class="bg-{{ $ragStatus['progress'] }}-500 w-6 h-6 inline-block"></span> 
                        <span>Progress RAG</span>
                        <span class="bg-{{ $ragStatus['otj'] }}-500 w-6 h-6 inline-block"></span> 
                        <span>OTJ RAG</span>
                        <span class="bg-{{ $ragStatus['employment'] }}-500 w-6 h-6 inline-block"></span> 
                        <span>Employment RAG</span>
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
                            @foreach($duties['inProgress'] as $duty)
                                <li>{{ $duty->name }} (Due: {{ date('F j, Y', strtotime($duty->pivot->due_date)) }})</li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
