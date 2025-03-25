<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Hours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoursController extends Controller
{
    public function index(Request $request)
    {
        $userID = Auth::user()->id;
        $findApprentice = Apprentice::select()->where('id', '=', $userID)->first();

        $sortBy = $request->input('sort_by', 'due_date');
        $sortDirection = $request->input('sort_direction', 'asc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $apprenticeDuties = Hours::select()
            ->where('apprentice_id', '=', $findApprentice->apprentice_id)
            ->join('duty', 'duty.duty_id', '=', 'apprentice_duties.duty_id')
            ->orderBy($sortBy === 'due_date' ? 'due_date' : $sortBy, $sortDirection)
            ->get();

        return view('apprentice-hours', compact('apprenticeHours', 'sortBy', 'sortDirection'));
    }
}
