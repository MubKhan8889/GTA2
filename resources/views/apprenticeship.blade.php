@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="min-w-3/4 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Welcome, {{ Auth::user()->name ?? 'Apprentice' }}
            </h2>

            <!-- Assign Apprenticeship Section: Visible only for admins and tutors -->
            @if(Auth::user()->role == "admin" || Auth::user()->role == "tutor")
                <h3 class="font-bold mt-8 mb-2">Assign Apprenticeship</h3>
                <div class="mb-4">
                    <input type="text" id="apprenticeName" placeholder="Apprentice Name" class="mb-2 form-input w-full" />
                    <select id="selectedApprenticeship" class="mb-2 form-select w-full">
                        <option value="">Select Apprenticeship</option>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                    <button onclick="handleAssign()" class="btn btn-primary">Assign Apprenticeship</button>
                </div>
            @else
                <p class="text-gray-500 mt-4">You do not have permission to assign apprenticeships.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let apprenticeships = [];
    let apprentices = [];

    // Fetch apprenticeships and apprentices from the backend
    async function fetchApprenticeships() {
        const res = await fetch('/apprenticeships');
        apprenticeships = await res.json();
        populateApprenticeships();
    }

    async function fetchApprentices() {
        const res = await fetch('/apprentices');
        apprentices = await res.json();
    }

    function populateApprenticeships() {
        const selectElement = document.getElementById('selectedApprenticeship');
        apprenticeships.forEach((apprenticeship) => {
            const option = document.createElement('option');
            option.value = apprenticeship.apprenticeship_id;
            option.textContent = `${apprenticeship.name} (${apprenticeship.months} months)`;
            selectElement.appendChild(option);
        });
    }

    async function handleAssign() {
        const apprenticeName = document.getElementById('apprenticeName').value;
        const selectedApprenticeship = document.getElementById('selectedApprenticeship').value;

        if (!selectedApprenticeship || !apprenticeName) {
            alert("Please enter both apprentice name and select an apprenticeship.");
            return;
        }

        const apprenticeId = apprentices.find((apprentice) => apprentice.name === apprenticeName)?.apprentice_id;

        if (!apprenticeId) {
            alert("Apprentice not found.");
            return;
        }

        const response = await fetch('/assign', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                apprenticeId,
                apprenticeshipId: selectedApprenticeship,
            }),
        });

        const result = await response.json();
        alert(result.message);
    }

    // Fetch data on page load
    fetchApprenticeships();
    fetchApprentices();
</script>
@endsection