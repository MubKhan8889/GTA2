<?php


namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\ApprenticeDuty;
use App\Models\Duty;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DutyController extends Controller
{
    public function index(Request $request)
    {
        $dt = new DateTime();

        $userID = Auth::user()->id;
        $findApprentice = Apprentice::select()->where('id', '=', $userID)->first();

        $sortBy = $request->input('sort_by', 'apprentice_duty_id');
        $sortDirection = $request->input('sort_direction', 'asc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $apprenticeDuties = ApprenticeDuty::select()
            ->where('apprentice_id', '=', $findApprentice->apprentice_id)
            ->join('duty', 'duty.duty_id', '=', 'apprentice_duties.duty_id')
            ->orderBy($sortBy === 'due_date' ? 'due_date' : $sortBy, $sortDirection)
            ->get();

        $overallRAG = array(
            'total' => ApprenticeDuty::select()->where('apprentice_id', '=', $findApprentice->apprentice_id)->count(),
            'red' => 0,
            'yellow' => 0,
            'green' => ApprenticeDuty::select()->where('apprentice_id', '=', $findApprentice->apprentice_id)->where('completed_date', '!=', null)->count(),
        );

        $dutyDates = ApprenticeDuty::select()->where('apprentice_id', '=', $findApprentice->apprentice_id)->where('completed_date', '=', null)->pluck('due_date')->toArray();
        foreach($dutyDates as $dueDate)
        {
            if     (strtotime($dt->format('Y-m-d')) > strtotime($dueDate)) { $overallRAG['red'] += 1; }
            elseif (strtotime($dt->format('Y-m-d')) < strtotime($dueDate)) { $overallRAG['yellow'] += 1; }
        }

        return view('apprentice-progress', compact(['apprenticeDuties', 'overallRAG'], 'sortBy', 'sortDirection'));
    }
}