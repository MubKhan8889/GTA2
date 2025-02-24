<x-app-layout>
    <h1 class="text-2xl">Dashboard for Admin</h1>

    <div class="flex">

        <!-- Main Content -->
        <div class="w-3/4 p-6 bg-gray-100">
            <div class="p-4 bg-white shadow rounded">
                <h2 class="text-xl font-bold">Welcome, {{ Auth::user()->name }}</h2>

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