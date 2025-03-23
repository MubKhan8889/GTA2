<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the dashboard for the apprentice.
     */
    public function showDashboard()
    {
        // Get the logged-in apprentice's data
        $apprentice = Auth::user()->apprentice;

        // Get in-progress and overdue duties for the apprentice
        $duties = $this->getDuties($apprentice);

        // Calculate the RAG status
        $ragStatus = $this->calculateRagStatus($apprentice);

        // Pass the data to the view
        return view('apprentice-dashboard', [
            'apprentice' => $apprentice,
            'ragStatus' => $ragStatus,
            'duties' => $duties,
        ]);
    }

    /**
     * Get in-progress and overdue duties for the apprentice.
     *
     * @param Apprentice $apprentice
     * @return array
     */
    private function getDuties($apprentice)
    {
        // Fetch duties that belong to the apprentice
        $dutiesInProgress = [];
        $dutiesOverdue = [];

        foreach ($apprentice->duties as $duty) {
            // In-progress duties: completed_date is null, and due_date is today or in the future
            if (!$duty->pivot->completed_date && $duty->pivot->due_date >= now()) {
                $dutiesInProgress[] = $duty;
            }

            // Overdue duties: completed_date is null, and due_date is past
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
        $completedDuties = $apprentice->duties->filter(function ($duty) {
            return !is_null($duty->pivot->completed_date);
        })->count();

        $inProgressDuties = $apprentice->duties->filter(function ($duty) {
            return is_null($duty->pivot->completed_date) && Carbon::parse($duty->pivot->due_date)->gte(Carbon::now());
        })->count();

        $overdueDuties = $apprentice->duties->filter(function ($duty) {
            return is_null($duty->pivot->completed_date) && Carbon::parse($duty->pivot->due_date)->lt(Carbon::now());
        })->count();

        // Calculate progress percentage
        $progressPercentage = $totalDuties > 0 ? round(($completedDuties / $totalDuties) * 100, 2) : 0;
        $inProgressPercentage = $totalDuties > 0 ? round(($inProgressDuties / $totalDuties) * 100, 2) : 0;
        $overduePercentage = $totalDuties > 0 ? round(($overdueDuties / $totalDuties) * 100, 2) : 0;

        // Determine RAG status based on percentages
        $progressRAG = $this->determineRagColor($progressPercentage);
        $otjRAG = $this->determineRagColor($inProgressPercentage);
        $employmentRAG = $this->determineRagColor($overduePercentage);

        // Return RAG status array
        return [
            'progress' => $progressRAG,
            'otj' => $otjRAG,
            'employment' => $employmentRAG,
        ];
    }

    /**
     * Determine the RAG color based on a percentage.
     *
     * @param float $percentage
     * @return string
     */
    private function determineRagColor($percentage)
    {
        if ($percentage >= 75) {
            return 'green';  // Green: Good progress
        } elseif ($percentage >= 50) {
            return 'yellow'; // Yellow: In progress but needs attention
        } else {
            return 'red';    // Red: Behind schedule or critical issues
        }
    }
}
