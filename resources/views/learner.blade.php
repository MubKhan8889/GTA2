@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex-grow mr-6">
            <h3 class="text-lg font-semibold">Apprentice Information</h3>
            
            <p><strong>Name:</strong> 
                @if($apprentice->user) 
                    {{ $apprentice->user->name }} 
                @else 
                    No name available 
                @endif
            </p>
            <p><strong>ULN:</strong> {{ $apprentice->uln }}</p>
            <p><strong>Apprenticeship:</strong> {{ $apprentice->Apprenticeship->name }}</p>
            <p><strong>Apprenticeship Duration (months):</strong> {{ $apprentice->Apprenticeship->months }}</p>
            <p><strong>Cohort:</strong> {{ $apprentice->cohort }}</p>
            <p><strong>Status:</strong> {{ $apprentice->status }}</p>
            <p><strong>Start Date:</strong> {{ $apprentice->start_date }}</p>
            <p><strong>Expected Finish Date:</strong> {{ $apprentice->expected_finish_date }}</p>
            <p><strong>Finish Date:</strong> {{ $apprentice->finish_date ?? 'N/A' }}</p>
            <p><strong>Release Day:</strong> {{ $apprentice->release_day }}</p>

            <h3 class="text-lg font-semibold mt-4">Apprentice Progress</h3>
            <table class="w-full table-auto mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Progress Type</th>
                        <th class="border border-gray-300 px-4 py-2">Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Completed</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($progress['completed'], 2) }}%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">In Progress</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($progress['inProgress'], 2) }}%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Overdue</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($progress['overdue'], 2) }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex-grow">
            <h3 class="text-lg font-semibold">Assigned Duties</h3>

            @if($apprentice->duties->isEmpty())
                <p>No duties assigned yet.</p>
            @else
                <table class="w-full table-auto mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Duty Name</th>
                            <th class="border border-gray-300 px-4 py-2">Completed Date</th>
                            <th class="border border-gray-300 px-4 py-2">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($apprentice->duties as $duty)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $duty->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $duty->pivot->completed_date ?? 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $duty->pivot->due_date ?? 'N/A' }}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table> 
            @endif

            <h3 class="text-lg font-semibold mt-6">Assigned Hours</h3>
            
            @if($apprentice->hours->isEmpty())
                <p>No hours assigned yet.</p>
            @else
                <table class="w-full table-auto mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Month</th>
                            <th class="border border-gray-300 px-4 py-2">Date</th>
                            <th class="border border-gray-300 px-4 py-2">Training Center Hours</th>
                            <th class="border border-gray-300 px-4 py-2">Employer Training Records</th>
                            <th class="border border-gray-300 px-4 py-2">GTA Specialist Training</th>
                            <th class="border border-gray-300 px-4 py-2">VLE Training</th>
                            <th class="border border-gray-300 px-4 py-2">Total Hours</th>
                            <th class="border border-gray-300 px-4 py-2">Cumulaive Hours</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $cumulativeHours = 0;
                        @endphp

                        @foreach($apprentice->hours as $hour)
                            @php
                                $totalHours = $hour->employer_training + $hour->specialist_training + $hour->training_centre + $hour->vle_training;
                                $cumulativeHours += $totalHours;
                            @endphp

                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $hour->month }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hour->date }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hour->training_centre }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hour->employer_training }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hour->specialist_training }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hour->vle_training }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $totalHours }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $cumulativeHours }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
