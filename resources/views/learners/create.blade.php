@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-4">Register Apprentice</h1>
            <form action="register">
                <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Select Role -->
        <div class="mt-4 flex">
            <x-input-label for="role" :value="__('Role:')" class="mr-3 h-full my-auto"/>

            <x-dropdown-list id="role" name="role">
                <option value="apprentice" selected>Apprentice</option>
            </x-dropdown-list>
        </div>

        <!-- ULN -->
        <div class="mt-4 flex">
            <x-input-label for="uln" :value="__('ULN:')" class="mr-3 h-full my-auto"/>

            <x-text-input id="uln" class="block mt-1 w-full"/>
        </div>

        <!-- Cohort -->
        <div class="mt-4 flex">
            <x-input-label for="cohort" :value="__('Cohort:')" class="mr-3 h-full my-auto"/>
            <x-text-input id="cohort" class="block mt-1 w-full"/>
        </div>

        <!-- Status -->
        <div class="mt-4 flex">
            <x-input-label for="status" :value="__('Status:')" class="mr-3 h-full my-auto"/>

            <x-dropdown-list id="status" name="status">
                <option value="active" selected>Active</option>
                <option value="inactive" selected>Inactive</option>
            </x-dropdown-list>
        </div>

        <!-- Start Date -->
        <div class="mt-4 flex">
            <label for="start_date" class="mr-3 h-full my-auto">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Expected Finish Date -->
        <div class="mt-4 flex">
            <label for="expected_finish_date" class="mr-3 h-full my-auto">Expected Finish Date:</label>
            <input type="date" id="expected_finish_date" name="expected_finish_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Finish Date -->
        <div class="mt-4 flex">
            <label for="finish_date" class="mr-3 h-full my-auto">Finish Date:</label>
            <input type="date" id="finish_date" name="finish_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Release Day -->
        <div class="mt-4 flex">
            <x-input-label for="release_Day" :value="__('Release Day:')" class="mr-3 h-full my-auto"/>

            <x-dropdown-list id="release_Day" name="release_Day">
                <option value="monday" selected>Monday</option>
                <option value="tuesday" selected>Tuesday</option>
                <option value="wednesday" selected>Wednesday</option>
                <option value="thursday" selected>Thursday</option>
                <option value="friday" selected>Friday</option>
            </x-dropdown-list>
        </div>
        <x-primary-button class="ms-3">
                {{ __('Submit') }}
            </x-primary-button>
            </form>
            </div>
        </div>
    </div>
@endsection
