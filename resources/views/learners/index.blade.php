@extends('layouts.app')
@section('content')
@php
    $role = Auth::user()->role;
@endphp
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Apprentice Management</h1>
            @if ($role == "admin")
                <a href="{{ route('learners.create') }}" class="text-blue-500 hover:underline">Register Apprentice</a>     
            @endif
            @if ($apprentices->isEmpty())
                <p>No apprentices found.</p>
            @else
            <div class="mb-4">
                <a href="{{ route('learners.index', ['sort_by' => 'name', 'sort_direction' => $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline">
                    Sort by Name
                </a> |
                <a href="{{ route('learners.index', ['sort_by' => 'cohort', 'sort_direction' => $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline">
                    Sort by Cohort
                </a> |
                <a href="{{ route('learners.index', ['sort_by' => 'status', 'sort_direction' => $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline">
                    Sort by Status
                    </a>
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Cohort</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apprentices as $apprentice)
                            <tr>
                                <td class="border px-4 py-2">{{ $apprentice->user->name ?? 'No name available' }}</td>
                                <td class="border px-4 py-2">{{ $apprentice->cohort }}</td>
                                <td class="border px-4 py-2">{{ $apprentice->status }}</td>
                                <td class="border px-4 py-2">
                                <!-- View Button (for all users) -->
                                <a href="{{ route('learner.show', $apprentice->apprentice_id) }}" class="text-blue-500 hover:underline">View</a> ||
                                <!-- Edit Button (only for Tutor & Admin) -->
                                <a href="{{ route('learners.edit', $apprentice->apprentice_id) }}" class="text-yellow-500 hover:underline mx-2">Edit</a> ||
                                <!-- Archive Button (for Tutors, Employees & Admins) -->
                                <form action="{{ route('learners.archive', $apprentice->apprentice_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to archive this apprentice?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-gray-500 hover:underline">Archive</button>
                                </form>
                                <!-- Delete Button (only for Admin) -->
                                @if ($role == "admin")
                                     ||
                                    <form action="{{ route('learners.destroy', $apprentice->apprentice_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this apprentice?')" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
