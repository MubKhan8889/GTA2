@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Edit Apprenticeship Information</h1>

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

        <form id="update-form" action="{{ route('duties.update', ['apprenticeship' => $apprenticeship, 'duty' => $duty]) }}" method="POST">
            @csrf
            @method('PUT')

            @php
                $isAdmin = Auth::user()->role == 'admin';
            @endphp
            <div>
                <label for="name" class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" name="name" value="{{ $duty->name }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>
            <div>
                <label for="duration" class="block text-gray-700 font-semibold">Duration:</label>
                <input type="text" name="duration" value="{{ $duty->duration }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>
            
            <button id="update-button" type="submit"
                class="w-full font-bold py-2 px-4 rounded-lg">
                Update
            </button>
        </form>
    </div>
</div>
@endsection