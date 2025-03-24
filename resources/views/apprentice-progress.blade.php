@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your progress') }}
        </h2>
    </x-slot>

    <div class="flex">

        <!-- Main Content -->
        <div class="min-w-3/4 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <!-- Display Apprentice Name Dynamically -->
                <h2 class="text-xl font-semibold">
                    Welcome, {{ Auth::user()->name ?? 'Apprentice' }}
                </h2>

                @if($apprenticeDuties->isEmpty())
                    <p>brah</p>
                @else
                    <b>bruh</b>
                @endif

                <!-- Overall duties progress -->
                <h3 class="font-bold mt-8 mb-2">Duties RAG</h3>
                <table class="bg-gray-200">
                    <tr>
                        <th class="px-3 py-1 border-2 border-gray-400">Completed</th>
                        <th class="px-3 py-1 border-2 border-gray-400">In progress</th>
                        <th class="px-3 py-1 border-2 border-gray-400">Overdue</th>
                    </tr>
                    <tr>
                        <th class="p-0 border-2 border-gray-400"><span class="bg-green-400 inline-block h-4 w-2/3 mr-[100%]"></span></th>
                        <th class="p-0 border-2 border-gray-400"><span class="bg-yellow-300 inline-block h-4 w-1/2 mr-[100%]"></span></th>
                        <th class="p-0 border-2 border-gray-400"><span class="bg-red-400 inline-block h-4 w-1/3 mr-[100%]"></span></th>
                    </tr>
                </table>

                <!-- Duties info -->
                <h3 class="font-bold mt-8 mb-2">Duties</h3>
                <div class="flex">
                    <!-- Year 1 -->
                    <table class="h-min mr-6">
                        <tr>
                            <th class="text-left px-3 py-0.5">Year 1</th>
                            <th class="text-left px-3 py-0.5">Completed Date</th>
                            <th class="text-left px-3 py-0.5">Due Date</th>
                        </tr>

                        @if(!$apprenticeDuties->isEmpty())
                            @foreach($apprenticeDuties as $duty)
                                @php
                                    if     ($duty->completed_date == null) { $colourIn = 'bg-yellow-400'; }
                                    elseif (new DateTime('Today') > strtotime($duty->due_date)) { $colourIn = 'bg-red-400'; }
                                    elseif ($duty->completed_date != null) { $colourIn = 'bg-green-400'; }
                                @endphp

                                <tr>
                                    <th class="text-left font-normal px-3 py-0.5">{{ $duty->name }}</th>
                                    <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400 {{ $colourIn }}">{{ $duty->completed_date }}</th>
                                    <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $duty->due_date }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection