<?php

namespace App\Http\Controllers;

use App\Models\Apprenticeship;
use App\Models\Apprentice;
use App\Models\Assignments;
use Illuminate\Http\Request;

class ApprenticeshipController extends Controller
{
    // Fetch all apprenticeships
    public function getApprenticeships()
    {
        $apprenticeships = Apprenticeship::all();
        return response()->json($apprenticeships);
    }

    // Fetch all apprentices
    public function getApprentices()
    {
        $apprentices = Apprentice::all();
        return response()->json($apprentices);
    }

    // Assign apprenticeship to an apprentice
    public function assignApprenticeship(Request $request)
    {
        $request->validate([
            'apprentice_id' => 'required|exists:apprentices,apprentice_id',
            'apprenticeship_id' => 'required|exists:apprenticeships,apprenticeship_id',
        ]);

        $assignment = Assignments::create([
            'apprentice_id' => $request->apprentice_id,
            'apprenticeship_id' => $request->apprenticeship_id,
            'assigned_date' => now(),
        ]);

        return response()->json([
            'message' => 'Apprenticeship assigned successfully.',
            'data' => $assignment,
        ]);
    }
}
