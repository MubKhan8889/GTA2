<?php

namespace App\Http\Controllers;

use App\Models\Hours;
use App\Models\User;
use App\Models\Apprenticeship;
use App\Models\Apprentice;
use App\Models\ApprenticeDuty;
use App\Models\Duty;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprenticeController extends Controller
{
    // Displays all apprentices
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'name'); 
        $sortDirection = $request->input('sort_direction', 'asc');
    
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }
    
        $apprentices = Apprentice::with('user', 'apprenticeship')
                            ->leftJoin('users', 'users.id', '=', 'apprentice.id') 
                            ->orderBy($sortBy === 'name' ? 'users.name' : $sortBy, $sortDirection)
                            ->whereNull('archived_at')
                            ->get();
    
                            return view('learners.index', compact('apprentices', 'sortBy', 'sortDirection'));
    }

// Display details of a specific apprentice
public function show($apprentice_id)
{
    $apprentice = Apprentice::with('user', 'apprenticeship', 'duties') 
                            ->where('apprentice_id', $apprentice_id)
                            ->first();

    if (!$apprentice) {
        return redirect('/learners')->with('error', 'Apprentice not found');
    }

    $totalDuties = $apprentice->duties->count();
    $completedCount = $apprentice->duties->whereNotNull('pivot.completed_date')->count();
    $inProgressCount = $apprentice->duties->whereNull('pivot.completed_date')
                                          ->where('pivot.due_date', '>=', now())
                                          ->count();
    $overdueCount = $apprentice->duties->whereNull('pivot.completed_date')
                                          ->where('pivot.due_date', '<', now())
                                          ->count();

    $progress = [
        'completed' => $totalDuties > 0 ? round(($completedCount / $totalDuties) * 100, 2) : 0,
        'inProgress' => $totalDuties > 0 ? round(($inProgressCount / $totalDuties) * 100, 2) : 0,
        'overdue' => $totalDuties > 0 ? round(($overdueCount / $totalDuties) * 100, 2) : 0,
    ];

    return view('learner', compact('apprentice', 'progress'));
}

// Directs to apprentice edit page, with calculated percentages to display in progress table
public function edit($apprentice_id)
{
    $apprentice = Apprentice::with(['duties' => function ($query) {
        $query->withPivot('completed_date', 'due_date');
    }])->findOrFail($apprentice_id);

    $totalDuties = $apprentice->duties->count();
    $completedCount = $apprentice->duties->whereNotNull('pivot.completed_date')->count();
    $inProgressCount = $apprentice->duties->whereNull('pivot.completed_date')->where('pivot.due_date', '>=', now())->count();
    $overdueCount = $apprentice->duties->whereNull('pivot.completed_date')->where('pivot.due_date', '<', now())->count();

    $completedPercentage = $totalDuties > 0 ? ($completedCount / $totalDuties) * 100 : 0;
    $inProgressPercentage = $totalDuties > 0 ? ($inProgressCount / $totalDuties) * 100 : 0;
    $overduePercentage = $totalDuties > 0 ? ($overdueCount / $totalDuties) * 100 : 0;

    $progress = [
        'completed' => $completedPercentage,
        'inProgress' => $inProgressPercentage,
        'overdue' => $overduePercentage,
    ];

    return view('learners.edit', compact('apprentice', 'progress'));
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
        'duties' => 'nullable|array',
        'duties.*.duty_id' => 'exists:duties,duty_id',
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

    // Update apprentice duties
    if ($request->has('duties')) {
        foreach ($request->duties as $dutyId => $dutyData) {
            if (isset($dutyData['due_date'])) {
                $apprentice->duties()->updateExistingPivot($dutyId, [
                    'completed_date' => $dutyData['completed_date'],
                    'due_date' => $dutyData['due_date'],
                ]);
            }
        }
    }
    $totalDuties = $apprentice->duties->count();
    $completedCount = $apprentice->duties->whereNotNull('pivot.completed_date')->count();
    $inProgressCount = $apprentice->duties->whereNull('pivot.completed_date')
                                         ->where('pivot.due_date', '>=', now())
                                         ->count();
    $overdueCount = $apprentice->duties->whereNull('pivot.completed_date')
                                       ->where('pivot.due_date', '<', now())
                                       ->count();

    $completedPercentage = $totalDuties > 0 ? round(($completedCount / $totalDuties) * 100, 2) : 0;
    $inProgressPercentage = $totalDuties > 0 ? round(($inProgressCount / $totalDuties) * 100, 2) : 0;
    $overduePercentage = $totalDuties > 0 ? round(($overdueCount / $totalDuties) * 100, 2) : 0;

    $progress = [
        'completed' => $completedPercentage,
        'inProgress' => $inProgressPercentage,
        'overdue' => $overduePercentage,
    ];

    return redirect()->back()
                     ->with('success', "Apprentice successfully updated.")
                     ->with('progress', $progress);
}

// Deletes Apprentice and corresponding user record
public function destroy($id)
{
    DB::beginTransaction();

    try {
        $apprentice = Apprentice::findOrFail($id);
        $dutiesDeleted = ApprenticeDuty::where('apprentice_id', $apprentice->apprentice_id)->delete();
        $hoursDeleted = Hours::where('apprentice_id', $apprentice->apprentice_id)->delete(); 

        if ($apprentice->id !== null) {
            $user = User::find($apprentice->id);

            if ($user) {
                $user->delete();
            }
        }

        $apprentice->delete();
        
        DB::commit();

        return redirect()->route('learners.index')->with('success', 'Apprentice and related records deleted successfully!');
    } catch (\Exception $e) {
        // Rollback if any errors
        DB::rollBack();

        return redirect()->route('learners.index')->with('error', 'An error occurred while deleting the apprentice and related records.');
    }
}


// Archives an apprentice
public function archive($id)
{
    $apprentice = Apprentice::findOrFail($id);
    $apprentice->archived_at = now();
    $apprentice->save();

    return redirect()->route('learners.index')->with('success', 'Apprentice archived successfully.');
}

public function unarchive($id)
{
    $apprentice = Apprentice::findOrFail($id);
    $apprentice->archived_at = null;
    $apprentice->save();

    return redirect()->route('learners.archived')->with('success', 'Apprentice restored successfully.');
}

// Returns archived apprentices
public function archivedLearners()
{
    $apprentices = Apprentice::whereNotNull('archived_at')->with('user')->get();
    
    return view('learners.archived', compact('apprentices'));
}

// Returns register apprentice page
public function Create(){
    $apprenticeships = Apprenticeship::select()->get();
    return view('learners.create', compact('apprenticeships'));
}

// Register new Apprentice
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed',
        'uln' => 'required|string',
        'cohort' => 'required|string',
        'status' => 'required|string',
        'start_date' => 'required|date',
        'exp_finish_date' => 'date',
        'finish_date' => 'required|date',
        'release_day' => 'required|string',
        'apprenticeship_id' => 'required|exists:Apprenticeship,apprenticeship_id',
    ]);

    $user = new User([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'apprentice',
    ]);

    $user->save();

    $apprentice = new Apprentice([
        'uln' => $request->uln,
        'cohort' => $request->cohort,
        'status' => $request->status,
        'start_date' => $request->start_date,
        'finish_date' => $request->finish_date,
        'exp_finish_date' => $request->finish_date,
        'release_day' => $request->release_day,
        'apprenticeship_id' => $request->apprenticeship_id,
        'id' => $user->id,
    ]);

    $apprentice->save();

    // Create apprentice duties
    $apprenticeship = Apprenticeship::select()->where('apprenticeship_id', '=', $apprentice->apprenticeship_id)->first();

    $dt = new DateTime();
    $deadline = $dt->add(new DateInterval('P1Y'))->format('Y-m-d');

    foreach ($apprenticeship->duties as $duty)
    {
        $apprenticeDuty = ApprenticeDuty::create([
            'apprentice_id' => $apprentice->apprentice_id,
            'duty_id' => $duty->duty_id,
            'completed_date' => null,
            'due_date' => $deadline,
        ]);
    }

    return redirect()->route('learners.create')->with('success', 'Apprentice registered successfully!');
}


// Fetch all apprenticeships
public function fetchApprenticeships()
{
    $apprenticeships = Apprenticeship::all();
    return view('learners.create', compact('apprenticeships'));
}

}