<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;

class AdminController extends Controller
{
    // Admin dashboard
    public function index()
{
    $modules = Module::all(); // all modules
    $teachers = User::whereHas('roles', function($q){
        $q->where('name','Teacher');
    })->get(); // all teachers
    $users = User::all(); // for role change form

    return view('admin.dashboard', compact('modules','teachers','users'));
}

    // Show form to create a module
    public function createModule()
    {
        return view('admin.create_module');
    }

    // Store module
    public function storeModule(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Module::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_available' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success','Module created!');
    }

    // Assign teacher to module
    public function assignTeacher(Request $request)
{
    // Validate form input
    $request->validate([
        'module_id' => 'required|exists:modules,id',
        'teacher_id' => 'required|exists:users,id',
    ]);

    // Get the module and teacher
    $module = Module::findOrFail($request->module_id);
    $teacher = User::findOrFail($request->teacher_id);

    // Attach teacher to module without removing existing
    $module->teachers()->syncWithoutDetaching($teacher);

    return back()->with('success', 'Teacher assigned to module successfully!');
}


    // Change user role
    public function changeRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $role = Role::where('name', $request->role_name)->first();

        $user->roles()->sync([$role->id]); // remove old roles and attach new
        return back()->with('success','Role changed!');
    }

    // Toggle module availability
    public function toggleModule($id)
    {
        $module = Module::findOrFail($id);
        $module->is_available = !$module->is_available;
        $module->save();

        return back()->with('success','Module availability updated!');
    }
}
