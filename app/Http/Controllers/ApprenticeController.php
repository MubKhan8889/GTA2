<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprenticeController extends Controller
{
    // Displays all apprentices
    public function index()
{
    $apprentices = Apprentice::with('user', 'apprenticeship')->get(); 

    return view('learners.index', compact('apprentices'));
}

// Display details of a specific apprentice
public function show($apprentice_id)
{
    $apprentice = Apprentice::with('user', 'apprenticeship')->where('apprentice_id', $apprentice_id)->first();

    if (!$apprentice) {
        return redirect('/apprentices')->with('error', 'Apprentice not found');
    }

    return view('learner', compact('apprentice'));
}
}

