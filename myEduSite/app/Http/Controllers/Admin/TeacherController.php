<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Admin middleware applied via route
    // No constructor needed if middleware applied in routes

    /**
     * Show all teachers
     */
    public function index()
    {
        $teachers = User::whereHas('role', function ($q) {
            $q->where('name', 'Teacher');
        })->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Create a new teacher
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Find Teacher role
        $teacherRole = UserRole::where('name','Teacher')->first();
        if (!$teacherRole) {
            return back()->with('error', 'Teacher role not found!');
        }

        // Create teacher
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // default password
            'user_role_id' => $teacherRole->id,
        ]);

        return back()->with('success', 'Teacher created successfully!');
    }

    /**
     * Remove a teacher
     */
    public function destroy(User $user)
    {
        if ($user->hasRole('Teacher')) {
            $user->delete();
            return back()->with('success', 'Teacher removed successfully!');
        }

        return back()->with('error', 'Cannot delete this user!');
    }
}
