<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::whereHas('role', function ($q) {
            $q->where('name', 'Teacher');
        })->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

  public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Fetch Teacher role
        $teacherRole = Role::where('name', 'Teacher')->first();

        if (!$teacherRole) {
            return redirect()->back()->with('error', 'Teacher role not found!');
        }

        // Create the teacher
        User::create([
            'name'     => $request->name,
            'email'    => $request->name . '_' . time() . '@example.com', // dummy unique email
            'password' => Hash::make('password'),
            'role_id'  => $teacherRole->id, // must point to Teacher role
        ]);

        return redirect()->back()->with('success', 'Teacher added successfully!');
    }


    public function destroy(User $user)
    {
        // optional: detach from modules
        $user->modules()->detach();

        $user->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}
