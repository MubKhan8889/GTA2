<?php

namespace App\Http\Controllers;

use App\Models\ApprenticeDuty;
use App\Models\Apprenticeship;
use App\Models\Duty;
use DB;
use Illuminate\Http\Request;

class DutyApprenticeshipController extends Controller
{
    public function create(Apprenticeship $apprenticeship)
    {
        return view('duties.create', compact('apprenticeship'));
    }

    public function edit(Apprenticeship $apprenticeship, Duty $duty)
    {
        $duty = Duty::select()->where('duty_id', $duty->duty_id)->first();

        if (!$duty) { return redirect('apprenticeship.index')->with('error', 'Duty not found'); }

        return view('duties.edit', compact(['apprenticeship', 'duty']));
    }
    
    // Register new apprenticeship
    public function store(Request $request, Apprenticeship $apprenticeship)
    {
        $request->validate([
            'name' => 'required|string',
            'duration' => 'required|string',
        ]);

        $duty = new Duty([
            'apprenticeship_id' => $apprenticeship->apprenticeship_id,
            'name' => $request->name,
            'duration' => $request->duration,
        ]);

        $duty->save();

        return redirect()->route('apprenticeships.edit', ['apprenticeship' => $apprenticeship])->with('success', 'Duty added successfully!');
    }

    // Updates data for apprenticeship
    public function update(Request $request, Apprenticeship $apprenticeship, Duty $duty)
    {
        $request->validate([
            'name' => 'required|string',
            'duration' => 'required|string',
        ]);

        // Update apprentice record
        $duty->update([
            'name' => $request->name,
            'duration' => $request->duration,
        ]);

        return redirect()->route('apprenticeships.edit', ['apprenticeship' => $apprenticeship])->with('success', "Apprenticeship successfully updated.");
    }

    public function destroy(Apprenticeship $apprenticeship, Duty $duty)
    {
        DB::beginTransaction();

        try {
            ApprenticeDuty::where('duty_id', '=', $duty->duty_id)->delete();
            $duty->delete();

            DB::commit();

            return redirect()->route('apprenticeships.edit', parameters: ['apprenticeship' => $apprenticeship])->with('success', 'Duties and related RAGs deleted successfully!');
        } catch (\Exception $e) {
            // Rollback if any errors
            DB::rollBack();

            return redirect()->route('apprenticeships.edit', ['apprenticeship' => $apprenticeship])->with('error', 'An error occurred while deleting the duty.');
        }
    }
}
