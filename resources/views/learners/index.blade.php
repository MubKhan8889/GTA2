<!-- resources/views/learners/index.blade.php -->

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">All Apprentices</h3>

                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Apprentice ID</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Cohort</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apprentices as $apprentice)
                            <tr>
                                <td class="border px-4 py-2">{{ $apprentice->apprentice_id }}</td>
                                <td class="border px-4 py-2">{{ $apprentice->user->name ?? 'No name available' }}</td>
                                <td class="border px-4 py-2">{{ $apprentice->cohort }}</td>
                                <td class="border px-4 py-2">{{ $apprentice->status }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('learner.show', $apprentice->apprentice_id) }}" class="text-blue-500">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
