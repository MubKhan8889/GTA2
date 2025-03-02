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
        return redirect('/learners')->with('error', 'Apprentice not found');
    }

    return view('learner', compact('apprentice'));
}

// Directs to apprentice edit page
public function edit($apprentice_id)
{
    $apprentice = Apprentice::with('user')->findOrFail($apprentice_id);
    
    if (!$apprentice->user) {
        abort(404, "User not found for this apprentice.");
    }

    return view('learners.edit', compact('apprentice'));
}

// Updates selected apprentice's data
public function update(Request $request, $apprentice_id)
{
    $apprentice = Apprentice::where('apprentice_id', $apprentice_id)->firstOrFail();


    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $apprentice->id . ',id',
        'uln' => 'nullable|string|max:255',
        'cohort' => 'nullable|string|max:255',
        'status' => 'required|in:Active,Inactive,Completed',
        'start_date' => 'nullable|date',
        'expected_finish_date' => 'nullable|date|after_or_equal:start_date',
        'finish_date' => 'nullable|date|after_or_equal:start_date',
        'release_day' => 'nullable|string|in:Monday,Tuesday,Wednesday,Thursday,Friday',
    ]);

    // Update user record
    if ($apprentice->user) {
        $apprentice->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

    // Update apprentice record
    $apprentice->update([
        'uln' => $request->uln,
        'cohort' => $request->cohort,
        'status' => $request->status,
        'start_date' => $request->start_date,
        'expected_finish_date' => $request->expected_finish_date,
        'finish_date' => $request->finish_date,
        'release_day' => $request->release_day,
    ]);

    $apprenticeName = $apprentice->user->name ?? 'Apprentice';

    return redirect()->back()->with('success', "Apprentice: $apprenticeName successfully updated.");
}

// Deletes the selected apprentice
public function destroy($id)
{
    $apprentice = Apprentice::findOrFail($id);
    $apprentice->delete();

    return redirect()->route('learners.index')->with('success', 'Apprentice deleted successfully!');
}
}