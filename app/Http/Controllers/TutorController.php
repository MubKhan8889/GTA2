<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TutorController extends Controller
{
    public function index()
    {
        $tutors = Tutor::with('user')->get();
        return view('tutors.index', compact('tutors'));
    }

    public function create()
    {
        return view('tutors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'tutor',
        ]);

        Tutor::create(['id' => $user->id]);

        return redirect()->route('tutors.create')->with('success', 'Tutor Registered Successfully!');
    }

    public function edit(Tutor $tutor)
    {
        return view('tutors.edit', compact('tutor'));
    }

    public function update(Request $request, Tutor $tutor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $tutor->user_id,
        ]);

        $tutor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('tutors.index')->with('success', 'Tutor updated successfully!');
    }

    public function destroy(Tutor $tutor)
    {
        $tutor->user->delete();
        $tutor->delete();
        
        return redirect()->route('tutors.index')->with('success', 'Tutor deleted successfully!');
    }
}
