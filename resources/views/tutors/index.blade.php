@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Tutor Management</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('tutors.create') }}" class="text-blue-500 hover:underline">Register Tutor</a>

        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tutors as $tutor)
                    <tr>
                        <td class="border p-2">{{ $tutor->user->name }}</td>
                        <td class="border p-2">{{ $tutor->user->email }}</td>
                        <td class="border p-2">
                            <a href="{{ route('tutors.edit', $tutor) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('tutors.destroy', $tutor) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
