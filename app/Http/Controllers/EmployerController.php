<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort', 'asc');

        $employers = Employer::with('user')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->orderBy('users.name', $sortOrder)
            ->select('employers.*')
            ->get();

        return view('employers.index', compact('employers', 'sortOrder'));
    }

    public function create()
    {
        return view('employers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employer',
        ]);

        Employer::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('employers.index')->with('success', 'Employer registered successfully!');
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();

        return redirect()->route('employers.index')->with('success', 'Employer deleted successfully!');
    }

    public function edit(Employer $employer)
    {
        return view('employers.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employer->user->id,
        ]);

        $employer->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('employers.index')->with('success', 'Employer updated successfully!');
    }
}
