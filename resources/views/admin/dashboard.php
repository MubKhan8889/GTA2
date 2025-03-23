<x-app-layout>
    <h1 class="text-2xl">Dashboard for Admin</h1>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-200 p-4">
            <h2 class="text-lg font-bold">GTA logo here</h2>
            <p class="mt-2 font-semibold">{{ $user->name }}</p> <!-- Dynamic Admin Name -->
           

        <!-- Main Content -->
        <div class="w-3/4 p-6 bg-gray-100">
            <div class="p-4 bg-white shadow rounded">
                <h2 class="text-xl font-bold">Welcome, {{ $user->name }}</h2>

                <!-- Section: Add New Apprentice -->
                <div class="mt-4">
                    <h3 class="font-bold">Add New Apprentice</h3>
                    <form action="{{ route('add-apprentice') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-semibold">Apprentice Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-semibold">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-semibold">Apprentice Status</label>
                            <select id="status" name="status" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Apprentice</button>
                    </form>
                </div>

                <!-- Section: Apprentice List (Dynamic) -->
                <div class="mt-8">
                    <h3 class="font-bold">Apprentice List</h3>
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apprentices as $apprentice)
                            <tr>
                                <td class="px-4 py-2">{{ $apprentice->name }}</td>
                                <td class="px-4 py-2">{{ $apprentice->email }}</td>
                                <td class="px-4 py-2">{{ ucfirst($apprentice->status) }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('edit-apprentice', $apprentice->id) }}" class="text-blue-500">Edit</a>
                                    <a href="{{ route('delete-apprentice', $apprentice->id) }}" class="text-red-500 ml-4">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h3 class="font-bold">Overall Learner RAG</h3>
                    <p>Progress RAG <span class="bg-green-400 px-2"> </span></p>
                    <p>OTJ RAG <span class="bg-yellow-400 px-2"> </span></p>
                    <p>Employment RAG <span class="bg-red-400 px-2"> </span></p>
                </div>

                <div class="mt-4">
                    <h3 class="font-bold">Overall in Progress Duties</h3>
                    <ul>
                        <li>Group 1: Foundation Skills</li>
                        <li>Group 1: Vehicle trim and panel components</li>
                        <li>Starting and changing systems</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h3 class="font-bold">Overall Overdue Duties</h3>
                    <ul>
                        <li>Group 5: Steering and Suspension</li>
                        <li>Group 6: Transmission and Driveline</li>
                        <li>Gateway 2</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h3 class="font-bold">Overall Hours</h3>
                    <p>Training Center: 85.4</p>
                    <p>Employer: 32.2</p>
                    <p>Specialist Training: 16.5</p>
                    <p>VLE Training: 42.9</p>
                    <p>Total hours: 176.8</p>
                    <p>Expected Hours: 150</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
