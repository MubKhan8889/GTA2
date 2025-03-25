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

                <!-- Hours Info -->
                <p>Apprenticeship Start Date: 11/10/2020</p>
                <p>OTJ Target Overall: 1252.1</p>
                <p>No. of Months: 36</p>

                <!-- Hours Table -->
                <table class="h-min mr-6 mt-6">
                    <tr>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">Month</th>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">Date</th>
                        <!--<th class="text-left px-3 py-0.5 border-2 border-gray-400">Expected Hours</th>-->
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">Training Center Hours</th>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">Employer Training Records</th>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">GTA Specialist Training</th>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">VLE Training</th>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">Total Hours</th>
                        <th class="text-left px-3 py-0.5 border-2 border-gray-400">Cumulaive Hours</th>
                    </tr>

                    @if(!$apprenticeHours->isEmpty())
                        @php
                            $cumulativeHours = 0;
                        @endphp

                        @foreach($apprenticeHours as $hours)
                            @php
                                $totalHours = $hours->employer_training + $hours->specialist_training + $hours->training_centre + $hours->vle_training;
                                $cumulativeHours += $totalHours;
                            @endphp

                            <tr>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $hours->month }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $hours->date }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $hours->training_centre }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $hours->employer_training }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $hours->specialist_training }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $hours->vle_training }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $totalHours }}</th>
                                <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">{{ $cumulativeHours }}</th>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection