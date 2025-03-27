<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class DashboardController extends Controller
{
    // Display details of a specific apprentice
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == 'apprentice'){
            return view('apprentice-dashboard');
        }
        return redirect()->route('learners.index');
    }
}

