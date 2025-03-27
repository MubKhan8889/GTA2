<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->query('sort', 'asc'); 

        $tutors = Tutor::with('user')
    ->join('users', 'tutors.id', '=', 'users.id')
    ->orderBy('users.name', $sortOrder)
    ->select('tutors.*')
    ->get();


        return view('tutors.index', compact('tutors', 'sortOrder'));
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
        //  Begin database transaction
        DB::beginTransaction();

        try {
            if (!$tutor) {
                \Log::info('Tutor not found.');
                return redirect()->route('tutors.index')->with('error', 'Tutor not found!');
            }
            $tutor->delete();
            $tutor->user->delete();

            DB::commit();

            return redirect()->route('tutors.index')->with('success', 'Tutor deleted successfully!');
        } catch (\Exception $e) {
            // Rollback if any errors
            DB::rollBack();

            return redirect()->route('tutors.index')->with('error', 'An error occurred while deleting the tutor and user.');
        }
    }



}
