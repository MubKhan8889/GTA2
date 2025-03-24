<?php


namespace App\Http\Controllers;

use App\Models\ApprenticeDuty;
use App\Models\Duty;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'due_date');
        $sortDirection = $request->input('sort_direction', 'asc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $apprenticeDuties = ApprenticeDuty::select()
            ->join('duty', 'duty.duty_id', '=', 'apprentice_duties.duty_id')
            ->orderBy($sortBy === 'due_date' ? 'due_date' : $sortBy, $sortDirection)
            ->get();

        return view('apprentice-progress', compact('apprenticeDuties', 'sortBy', 'sortDirection'));
    }
}