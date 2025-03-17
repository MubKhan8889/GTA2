@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your progress') }}
        </h2>
    </x-slot>

    <div class="flex">

        <!-- Main Content -->
        <div class="min-w-3/4 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <!-- Display Apprentice Name Dynamically -->
                <h2 class="text-xl font-semibold">
                    Welcome, {{ Auth::user()->name ?? 'Apprentice' }}
                </h2>

                <!-- Overall duties progress -->
                <h3 class="font-bold mt-8 mb-2">Duties RAG</h3>
                <table class="bg-gray-200">
                    <tr>
                        <th class="px-3 py-1 border-2 border-gray-400">Completed</th>
                        <th class="px-3 py-1 border-2 border-gray-400">In progress</th>
                        <th class="px-3 py-1 border-2 border-gray-400">Overdue</th>
                    </tr>
                    <tr>
                        <th class="p-0 border-2 border-gray-400"><span class="bg-green-400 inline-block h-4 w-2/3 mr-[100%]"></span></th>
                        <th class="p-0 border-2 border-gray-400"><span class="bg-yellow-300 inline-block h-4 w-1/2 mr-[100%]"></span></th>
                        <th class="p-0 border-2 border-gray-400"><span class="bg-red-400 inline-block h-4 w-1/3 mr-[100%]"></span></th>
                    </tr>
                </table>

                <!-- Duties info -->
                <h3 class="font-bold mt-8 mb-2">Duties</h3>
                <div class="flex">
                    <!-- Year 1 -->
                    <table class="h-min mr-6">
                        <tr>
                            <th class="text-left px-3 py-0.5">Year 1</th>
                            <th class="text-left px-3 py-0.5">Completed Date</th>
                            <th class="text-left px-3 py-0.5">Due Date</th>
                        </tr>
                        <tr>
                            <th class="text-left font-normal px-3 py-0.5">Group 1: Foundation Skills</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400 bg-green-400">08/12/22</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">01/01/23</th>
                        </tr>
                        <tr>
                            <th class="text-left font-normal px-3 py-0.5">Group 1: Other Skills</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400  bg-yellow-300">Not due</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">01/01/23</th>
                        </tr>
                        <tr>
                            <th class="text-left font-normal px-3 py-0.5">Starting and Changing Systems</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400  bg-red-400">Overdue</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">01/01/23</th>
                        </tr>
                    </table>

                    <!-- Year 2 -->
                    <table class="h-min ml-6">
                        <tr>
                            <th class="text-left px-3 py-0.5">Year 2</th>
                            <th class="text-left px-3 py-0.5">Completed Date</th>
                            <th class="text-left px-3 py-0.5">Due Date</th>
                        </tr>
                        <tr>
                            <th class="text-left font-normal px-3 py-0.5">Group 2: Other Skills</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400  bg-green-400">18/6/23</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">01/01/24</th>
                        </tr>
                        <tr>
                            <th class="text-left font-normal px-3 py-0.5">Starting and Changing Systems</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400  bg-red-400">Overdue</th>
                            <th class="text-left font-normal px-3 py-0.5 border-2 border-gray-400">01/01/24</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection