<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        $modules = Module::with('teachers')->get();
        $teacherRole = Role::where('name', 'Teacher')->first();
        $teachers = User::where('role_id', $teacherRole->id)->get();
        $users = User::all();

        return view('admin.dashboard', compact('modules', 'teachers', 'users'));
    }

    // Show Assign Teacher Page
    public function assignTeacherPage()
    {
        $modules = Module::with('teachers')->get();
        $teacherRole = Role::where('name', 'Teacher')->first();
        $teachers = User::where('role_id', $teacherRole->id)->get();

        return view('admin.assignTeacher', compact('modules', 'teachers'));
    }

    // Add new teacher (also adds to users table)
    public function addTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $teacherRole = Role::where('name', 'Teacher')->first();
        if (!$teacherRole) {
            return back()->with('error', 'Teacher role not found');
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->name . '_' . time() . '@example.com', // unique dummy email
            'password' => Hash::make('password'),
            'role_id'  => $teacherRole->id,
        ]);

        return redirect()->route('admin.assignTeacherPage')->with('success', 'Teacher added successfully.');
    }

    // Assign teacher to a module (POST)
    public function assignTeacherSubmit(Request $request)
    {
        $request->validate([
            'module_id'  => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $module = Module::findOrFail($request->module_id);
        $module->teachers()->syncWithoutDetaching([$request->teacher_id]);

        return back()->with('success', 'Teacher assigned successfully.');
    }

    // Remove teacher from a module
    public function removeTeacher(Module $module, User $user)
    {
        $module->teachers()->detach($user->id);

        return back()->with('success', 'Teacher removed successfully.');
    }
}
