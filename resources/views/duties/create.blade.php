@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-6">Create Duty for {{$apprenticeship->name}}</h1>

            @if(session('success'))
                <div id="success-message" style="color: green;">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => { location.reload(); }, 2000);
                </script>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger p-3 bg-red-500 text-white rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('duties.store', ['apprenticeship' => $apprenticeship]) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" name="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration:</label>
                        <input type="text" name="duration" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <button type="submit" class="bg-gray-400 text-black py-2 px-4 rounded">
                        Create duty
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
