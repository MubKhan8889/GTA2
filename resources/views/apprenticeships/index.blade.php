@extends('layouts.app')
@section('content')

@php
    $role = Auth::user()->role;
@endphp

<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Apprenticeship Management</h1>

        @if(session('success'))
            <div id="success-message" style="color: green;">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => { location.reload(); }, 2000);
            </script>
        @endif

        @if ($role == "admin")
            <a href="{{ route('apprenticeships.create') }}" class="text-blue-500 hover:underline">Create Apprenticeship</a>
        @endif

        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">
                        <a href="{{ route('apprenticeships.index', ['sort' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline">
                            Name 
                            @if($sortOrder === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        </a>
                    </th>
                    <th class="border p-2">Months</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apprenticeships as $apprenticeship)
                    <tr>
                        <td class="border p-2">{{ $apprenticeship->name }}</td>
                        <td class="border p-2">{{ $apprenticeship->months }}</td>
                        <td class="border p-2">
                        <a href="{{ route('apprenticeships.edit', $apprenticeship) }}" class="text-blue-500">{{ ($role == "admin") ? "Edit" : "View" }} </a>
                        @if ($role == "admin")
                            <form action="{{ route('apprenticeships.destroy', $apprenticeship) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection