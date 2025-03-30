@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Employer Management</h1>

        @if(session('success'))
            <div id="success-message" style="color: green;">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => { location.reload(); }, 2000);
            </script>
        @endif

        <a href="{{ route('employers.create') }}" class="text-blue-500 hover:underline">Register Employer</a>

        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">
                        <a href="{{ route('employers.index', ['sort' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline">
                            Name 
                            @if($sortOrder === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        </a>
                    </th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employers as $employer)
                    <tr>
                        <td class="border p-2">{{ $employer->user->name }}</td>
                        <td class="border p-2">{{ $employer->user->email }}</td>
                        <td class="border p-2">
                            <a href="{{ route('employers.edit', $employer) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('employers.destroy', $employer) }}" method="POST" class="inline-block">
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
