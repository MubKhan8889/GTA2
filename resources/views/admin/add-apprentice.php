@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Apprentice') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mt-6">
        <div class="w-1/2 p-6 bg-white rounded-lg shadow-md">
            <form method="POST" action="{{ route('admin.add.apprentice.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Apprentice Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md shadow-md">Add Apprentice</button>
                </div>
            </form>
        </div>
    </div>
@endsection

