@extends('layouts.app')

@section('content')
@php
    $role = Auth::user()->role;
    $isAdmin = $role == 'admin';
@endphp

<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4"> {{ ($isAdmin == true) ? "Edit Apprenticeship Information" : "Apprenticeship View" }}</h1>

        @if(session('success'))
        <div id="success-message" style="color: green;">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    location.reload();
                }, 2000);
            </script>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="update-form" action="{{ route('apprenticeships.update', $apprenticeship) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" name="name" value="{{ $apprenticeship->name }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>
            <div>
                <label for="months" class="block text-gray-700 font-semibold">Months:</label>
                <input type="text" name="months" value="{{ $apprenticeship->months }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>

            <h3 class="mt-6 text-xl font-semibold text-gray-700">Apprenticeship Duties</h3>
        </form>

        @if ($isAdmin)
            <a href="{{ route('duties.create', ['apprenticeship' => $apprenticeship]) }}" class="text-blue-500 hover:underline">Create Duty</a>
        @endif

        @if (count($duties) == 0)
            <p>No duties added for this apprenticeship.</p>
        @else
            <table class="w-full mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Duration</th>
                        @if(!$isAdmin)
                            <th class="border p-2">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($duties as $duty)
                        <tr>
                            <td class="border p-2">{{ $duty->name }}</td>
                            <td class="border p-2">{{ $duty->duration }}</td>
                            @if(!$isAdmin)
                                <td class="border p-2">
                                    <a href="{{ route('duties.edit', ['duty' => $duty, 'apprenticeship' => $apprenticeship]) }}" class="text-blue-500">Edit</a>
                                    <form action="{{ route('duties.destroy', ['duty' => $duty, 'apprenticeship' => $apprenticeship]) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if ($isAdmin)
            <button form="update-form" id="update-button" type="submit"
                class="w-full font-bold py-2 px-4 rounded-lg">
                Update
            </button>
        @endif
    </div>
</div>
@endsection
