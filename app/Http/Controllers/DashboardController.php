<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Display details of a specific apprentice
    public function show()
    {
        if (!Auth::check()) {  redirect()->route('login'); }

        if (Auth::user()->role == 'apprentice') { 
            $userID = Auth::user()->id;
            $apprentice = Apprentice::select()->where('id', '=', $userID)->first();

            $duties = $this->getDuties($apprentice);
            $ragStatus = $this->calculateRagStatus($apprentice);

            return view('apprentice-dashboard', compact(['ragStatus', 'duties']));
        }
        return redirect()->route('learners.index');
    }

    /**
     * Get in-progress and overdue duties for the apprentice.
     */
    private function getDuties($apprentice)
    {
        $dutiesInProgress = [];
        $dutiesOverdue = [];

        foreach ($apprentice->duties as $duty) {
            if (!$duty->pivot->completed_date && $duty->pivot->due_date >= now()) {
                $dutiesInProgress[] = $duty;
            }
            if (!$duty->pivot->completed_date && $duty->pivot->due_date < now()) {
                $dutiesOverdue[] = $duty;
            }
        }

        return [
            'inProgress' => $dutiesInProgress,
            'overdue' => $dutiesOverdue
        ];
    }

    /**
     * Calculate the RAG status based on the apprentice's duties and status.
     */
    private function calculateRagStatus(Apprentice $apprentice)
    {
        $totalDuties = $apprentice->duties->count();
        $completedDuties = $apprentice->duties->filter(fn($duty) => !is_null($duty->pivot->completed_date))->count();
        $inProgressDuties = $apprentice->duties->filter(fn($duty) => is_null($duty->pivot->completed_date) && $duty->pivot->due_date >= now())->count();
        $overdueDuties = $apprentice->duties->filter(fn($duty) => is_null($duty->pivot->completed_date) && $duty->pivot->due_date < now())->count();

        $progressPercentage = $totalDuties > 0 ? round(($completedDuties / $totalDuties) * 100, 2) : 0;
        $inProgressPercentage = $totalDuties > 0 ? round(($inProgressDuties / $totalDuties) * 100, 2) : 0;
        $overduePercentage = $totalDuties > 0 ? round(($overdueDuties / $totalDuties) * 100, 2) : 0;

        return [
            'progress' => $this->determineRagColor($progressPercentage),
            'otj' => $this->determineRagColor($inProgressPercentage),
            'employment' => $this->determineRagColor($overduePercentage),
        ];
    }

    /**
     * Determine the RAG color based on a percentage.
     */
    private function determineRagColor($percentage)
    {
       return $percentage >= 75 ? 'green' : ($percentage >= 50 ? 'yellow' : 'red');
    }
}

