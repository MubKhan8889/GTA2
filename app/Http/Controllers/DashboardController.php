<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Display details of a specific apprentice
    public function show()
    {
        if (!Auth::check()) { return route('login'); }
        $role = Auth::user()->role;

        $dashboardArray = array(
            'apprentice' => 'apprentice-dashboard',
            'tutor' => 'tutor-dashboard',
            'admin' => 'admin-dashboard',
            'employer' => 'employer-dashboard',
        );

        return view($dashboardArray[$role]);
    }
}

