<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Http\Request;

class ApprenticeController extends Controller
{
    public function show($id)
    {
        // Retrieves the apprentice and related account details
        $apprentice = Apprentice::with('account')->find($id);

        if (!$apprentice) {
            return response()->json(['message' => 'Apprentice not found'], 404);
        }

        return response()->json($apprentice);
    }
}
