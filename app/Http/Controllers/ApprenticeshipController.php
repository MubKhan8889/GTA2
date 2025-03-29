<?php

namespace App\Http\Controllers;

use App\Models\Apprenticeship;
use App\Models\Apprentice;
use App\Models\Assignments;  // Use the Assignments model
use Illuminate\Http\Request;

class ApprenticeshipController extends Controller
{
    // Fetch all apprenticeships
    public function getApprenticeships()
    {
        $apprenticeships = Apprenticeship::all();  // Fetch all apprenticeships
        return response()->json($apprenticeships);
    }

    // Fetch all apprentices
    public function getApprentices()
    {
        $apprentices = Apprentice::all();  // Fetch all apprentices
        return response()->json($apprentices);
    }

    // Assign apprenticeship to an apprentice
    public function assignApprenticeship(Request $request)
    {
        // Validate the request
        $request->validate([
            'apprentice_id' => 'required|exists:apprentices,apprentice_id',  // Ensure apprentice exists
            'apprenticeship_id' => 'required|exists:apprenticeships,apprenticeship_id',  // Ensure apprenticeship exists
        ]);

        // Create an assignment using the correct model
        $assignment = Assignments::create([  // Use the Assignments model (plural)
            'apprentice_id' => $request->apprentice_id,
            'apprenticeship_id' => $request->apprenticeship_id,
            'assigned_date' => now(),  // Assign the current date
        ]);

        // Return a response
        return response()->json([
            'message' => 'Apprenticeship assigned successfully.',
            'data' => $assignment,
        ]);
    }
}
