<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Show the Assign Teacher page
    public function index()
    {
        $modules = Module::with('teachers')->get();

        // Teachers for listing (from teachers table)
        $teachers = Teacher::all();

        // Users with role = Teacher (for assigning modules)
        $teacherRole = Role::where('name', 'Teacher')->first();
        $users = $teacherRole ? User::where('role_id', $teacherRole->id)->get() : collect();

        return view('admin.assignTeacher', compact('modules', 'teachers', 'users'));
    }

    // Add new teacher (adds to users + teachers)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $teacherRole = Role::where('name', 'Teacher')->first();
        if (!$teacherRole) return redirect()->back()->with('error', 'Teacher role not found!');

        // Add to users table
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->name.'_'.time().'@example.com',
            'password' => Hash::make('password'),
            'role_id'  => $teacherRole->id,
        ]);

        // Add to teachers table
        Teacher::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Teacher added successfully!');
    }

    // Assign teacher to module
    public function assign(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'user_id'   => 'required|exists:users,id',
        ]);

        $module = Module::findOrFail($request->module_id);
        $module->teachers()->syncWithoutDetaching([$request->user_id]);

        return redirect()->back()->with('success', 'Teacher assigned successfully!');
    }

    // Remove teacher from module
    public function destroy(User $user)
    {
        $user->modules()->detach(); // remove from module_teacher
        $user->delete(); // remove from users

        return redirect()->back()->with('success', 'Teacher removed successfully!');
    }
}
