<?php

namespace App\Http\Controllers;

use App\Models\ApprenticeDuty;
use App\Models\Apprenticeship;
use App\Models\Duty;
use DB;
use Illuminate\Http\Request;

class ApprenticeshipController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->query('sort', 'asc'); 
        $apprenticeships = Apprenticeship::select()->orderBy('apprenticeship_id', $sortOrder)->get();

        return view('apprenticeships.index', compact(['apprenticeships', 'sortOrder']));
    }

    public function show(Apprenticeship $apprenticeship)
    {
        $duties = Duty::select()->where('apprenticeship_id', $apprenticeship->apprenticeship_id)->orderBy('apprenticeship_id', 'asc');

        if (!$apprenticeship) { return redirect('apprenticeships.index')->with('error', 'Apprenticeship not found'); }

        return view('apprenticeship', compact(['apprenticeship', 'duties']));
    }

    public function create()
    {
        return view('apprenticeships.create');
    }

    public function edit(Apprenticeship $apprenticeship)
    {
        $duties = Duty::select()->where('apprenticeship_id', $apprenticeship->apprenticeship_id)->orderBy('apprenticeship_id', 'asc')->get();
    
        if (!$apprenticeship) { return redirect('/learners')->with('error', 'Apprenticeship not found'); }

        return view('apprenticeships.edit', compact(['apprenticeship', 'duties']));
    }
    
    // Register new apprenticeship
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'months' => 'required|string',
        ]);

        $apprenticeship = new Apprenticeship([
            'name' => $request->name,
            'months' => $request->months,
        ]);

        $apprenticeship->save();

        return redirect()->route('apprenticeships.create')->with('success', 'Apprenticeship registered successfully!');
    }

    // Updates data for apprenticeship
    public function update(Request $request, Apprenticeship $apprenticeship)
    {
        $apprenticeship = Apprenticeship::where('apprenticeship_id', $apprenticeship->apprenticeship_id)->firstOrFail();
        $duties = Duty::select()->where('apprenticeship_id', $apprenticeship->apprenticeship_id)->get();

        $request->validate([
            'name' => 'required|string',
            'months' => 'required|string',
            'duties' => 'nullable|array',
            'duties.*.duty_id' => 'exists:duties,duty_id',
        ]);

        // Update apprentice record
        $apprenticeship->update([
            'name' => $request->name,
            'months' => $request->months,
        ]);

        // Update apprentice duties
        if ($request->has('duties')) {
            foreach ($request->duties as $dutyId => $dutyData) {
                if (isset($dutyData['name'], $dutyData['duration'])) {
                    $duties->where('duty_id', '=', $dutyId)->update([
                        'name' => $dutyData['name'],
                        'duration' => $dutyData['duration'],
                    ]);
                }
            }
        }

        return redirect()->route('apprenticeships.edit', ['apprenticeship' => $apprenticeship])->with('success', "Apprenticeship successfully updated.");
    }

    public function destroy(Apprenticeship $apprenticeship)
    {
        DB::beginTransaction();

        try {
            ApprenticeDuty::select()
                ->join('duty', 'duty.duty_id', '=', 'apprentice_duties.duty_id')
                ->where('apprenticeship_id', '=', $apprenticeship->apprenticeship_id)
                ->delete();
            Duty::where('apprenticeship_id', $apprenticeship->apprenticeship_id)->delete();
            $apprenticeship->delete();

            DB::commit();

            return redirect()->route('apprenticeships.index')->with('success', 'Apprenticeship and related duties deleted successfully!');
        } catch (\Exception $e) {
            // Rollback if any errors
            DB::rollBack();

            return redirect()->route('apprenticeships.index')->with('error', 'An error occurred while deleting the apprenticeship and related records.');
        }
    }
}