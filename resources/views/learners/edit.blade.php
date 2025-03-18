@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Edit Apprentice Information</h1>

        @if(session('success'))
            <div id="success-message" style="background-color: green; color: white; padding: 10px; margin-bottom: 10px;">
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
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="update-form" action="{{ route('learners.update', $apprentice->apprentice_id) }}" method="POST">
            @csrf
            @method('PUT')

            @php
                $isAdmin = auth()->user()->role == 'admin';
            @endphp
            <div>
                <label for="name" class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" name="name" value="{{ optional($apprentice->user)->name }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email:</label>
                <input type="email" name="email" value="{{ optional($apprentice->user)->email }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>
            <div>
                <label for="uln" class="block text-gray-700 font-semibold">ULN:</label>
                <input type="text" name="uln" value="{{ $apprentice->uln }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300"
                    @if(!$isAdmin) readonly class="bg-gray-200" @endif />
            </div>
            <div>
                <label for="cohort" class="block text-gray-700 font-semibold">Cohort:</label>
                <input type="text" name="cohort" value="{{ $apprentice->cohort }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" />
            </div>
            <div>
                <label for="status" class="block text-gray-700 font-semibold">Status:</label>
                <select name="status" class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300">
                    <option value="Active" {{ $apprentice->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $apprentice->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="Completed" {{ $apprentice->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div>
                <label for="start_date" class="block text-gray-700 font-semibold">Start Date:</label>
                <input type="date" name="start_date" value="{{ $apprentice->start_date }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" />
            </div>

            <div>
                <label for="expected_finish_date" class="block text-gray-700 font-semibold">Expected Finish Date:</label>
                <input type="date" name="expected_finish_date" value="{{ $apprentice->expected_finish_date ?? '' }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" />
            </div>

            <div>
                <label for="finish_date" class="block text-gray-700 font-semibold">Finish Date:</label>
                <input type="date" name="finish_date" value="{{ $apprentice->finish_date }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" />
            </div>
            <div>
                <label for="release_day" class="block text-gray-700 font-semibold">Release Day:</label>
                <select name="release_day" class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300">
                    <option value="Monday" {{ $apprentice->release_day == 'Monday' ? 'selected' : '' }}>Monday</option>
                    <option value="Tuesday" {{ $apprentice->release_day == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                    <option value="Wednesday" {{ $apprentice->release_day == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                    <option value="Thursday" {{ $apprentice->release_day == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                    <option value="Friday" {{ $apprentice->release_day == 'Friday' ? 'selected' : '' }}>Friday</option>
                </select>
            </div>
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-gray-700">Apprentice Progress</h3>
                <table class="w-full table-auto mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Progress Type</th>
                            <th class="px-4 py-2">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">Completed</td>
                            <td class="px-4 py-2">{{ number_format($progress['completed'], 2) }}%</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">In Progress</td>
                            <td class="px-4 py-2">{{ number_format($progress['inProgress'], 2) }}%</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Overdue</td>
                            <td class="px-4 py-2">{{ number_format($progress['overdue'], 2) }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>         
            <h3 class="mt-6 text-xl font-semibold text-gray-700">Assigned Duties</h3>
            @if($apprentice->duties->isEmpty())
                <p>No duties assigned yet.</p>
            @else
                <table class="w-full table-auto mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Duty Name</th>
                            <th class="px-4 py-2">Completed Date</th>
                            <th class="px-4 py-2">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($apprentice->duties as $duty)
                            <tr>
                                <td class="px-4 py-2">{{ $duty->name }}</td>
                                <td class="px-4 py-2">
                                    <input type="date" name="duties[{{ $duty->pivot->duty_id }}][completed_date]" 
                                        value="{{ $duty->pivot->completed_date ?? '' }}" 
                                        class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" />
                                </td>
                                <td class="px-4 py-2">
                                    <input type="date" name="duties[{{ $duty->pivot->duty_id }}][due_date]" 
                                        value="{{ $duty->pivot->due_date ?? '' }}" 
                                        class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" />
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <button id="update-button" type="submit"
                class="w-full font-bold py-2 px-4 rounded-lg">
                Update
            </button>

        </form>
    </div>
</div>
@endsection
