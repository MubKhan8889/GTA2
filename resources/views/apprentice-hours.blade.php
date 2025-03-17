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
                        <th class="text-left px-3 py-0.5">Month</th>
                        <th class="text-left px-3 py-0.5">Date</th>
                        <th class="text-left px-3 py-0.5">Expected Hours</th>
                        <th class="text-left px-3 py-0.5">Training Center Hours</th>
                        <th class="text-left px-3 py-0.5">Employer Training Records</th>
                        <th class="text-left px-3 py-0.5">GTA Specialist Training</th>
                        <th class="text-left px-3 py-0.5">VLE Training</th>
                        <th class="text-left px-3 py-0.5">Total Hours</th>
                        <th class="text-left px-3 py-0.5">Cumulative Hours</th>
                    </tr>
                    <tr>
                        <th class="text-left font-normal px-3 py-0.5">1</th>
                        <th class="text-left font-normal px-3 py-0.5">10/20</th>
                        <th class="text-left font-normal px-3 py-0.5">16.2</th>
                        <th class="text-left font-normal px-3 py-0.5">32.5</th>
                        <th class="text-left font-normal px-3 py-0.5">19.5</th>
                        <th class="text-left font-normal px-3 py-0.5">6.5</th>
                        <th class="text-left font-normal px-3 py-0.5"></th>
                        <th class="text-left font-normal px-3 py-0.5">58.5</th>
                        <th class="text-left font-normal px-3 py-0.5">58.5</th>
                    </tr>
                    <tr>
                        <th class="text-left font-normal px-3 py-0.5">2</th>
                        <th class="text-left font-normal px-3 py-0.5">11/20</th>
                        <th class="text-left font-normal px-3 py-0.5">56.2</th>
                        <th class="text-left font-normal px-3 py-0.5">13</th>
                        <th class="text-left font-normal px-3 py-0.5"></th>
                        <th class="text-left font-normal px-3 py-0.5"></th>
                        <th class="text-left font-normal px-3 py-0.5">8.5</th>
                        <th class="text-left font-normal px-3 py-0.5">21.5</th>
                        <th class="text-left font-normal px-3 py-0.5">80</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection