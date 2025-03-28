<?php
namespace App\Http\Controllers;

use App\Models\ApprenticeDuty;
use App\Models\Duty;
use Illuminate\Http\Request;

class ApprenticeDutyController extends Controller
{
    public function assignDuty(Request $request, $apprentice_id)
    {
        $request->validate([
            'duty_id' => 'required|exists:duties,id',
        ]);

        ApprenticeDuty::create([
            'apprentice_id' => $apprentice_id,
            'duty_id' => $request->duty_id,
        ]);

        return redirect()->back()->with('success', 'Duty assigned successfully!');
    }

    public function removeDuty($apprentice_id, $duty_id)
    {
        ApprenticeDuty::where('apprentice_id', $apprentice_id)
                      ->where('duty_id', $duty_id)
                      ->delete();

        return redirect()->back()->with('success', 'Duty removed successfully.');
    }
}
