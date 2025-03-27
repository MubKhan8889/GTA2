@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Edit Employer</h1>

    <form action="{{ route('employers.update', $employer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Name:</label>
            <input type="text" name="name" value="{{ $employer->user->name }}" required class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label>Email:</label>
            <input type="email" name="email" value="{{ $employer->user->email }}" required class="w-full border p-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Employer</button>
    </form>
</div>
@endsection
