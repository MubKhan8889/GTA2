<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold">Apprentice Information</h3>
            
            <p><strong>Name:</strong> 
                @if($apprentice->user) 
                    {{ $apprentice->user->name }} 
                @else 
                    No name available 
                @endif
            </p>
            <p><strong>ULN:</strong> {{ $apprentice->uln }}</p>
            <p><strong>Cohort:</strong> {{ $apprentice->cohort }}</p>
            <p><strong>Status:</strong> {{ $apprentice->status }}</p>
            <p><strong>Start Date:</strong> {{ $apprentice->start_date }}</p>
            <p><strong>Expected Finish Date:</strong> {{ $apprentice->exp_finish_date }}</p>
            <p><strong>Release Day:</strong> {{ $apprentice->release_day }}</p>
        </div>
    </div>
</div>
