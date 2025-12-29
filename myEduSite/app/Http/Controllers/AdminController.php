<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /* =========================
       DASHBOARD
    ========================== */
    public function index()
    {
        $users   = User::all();
        $modules = Module::all();

        return view('admin.dashboard', compact('users', 'modules'));
    }

    /* =========================
       CHANGE USER ROLE
    ========================== */
    public function changeRolePage()
    {
        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin.changeRole', compact('users', 'roles'));
    }

    public function changeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role_id = $request->role_id;
        $user->save();

        return back()->with('success', 'User role updated successfully');
    }

    /* =========================
       ASSIGN TEACHER PAGE
    ========================== */
    public function assignTeacherPage()
{
    $modules = Module::with('teachers')->get();
    
    // Get all teachers from teachers table
    $teachers = Teacher::all();

    return view('admin.assignTeacher', compact('modules', 'teachers'));
}
//store teacher

public function storeTeacher(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    \DB::transaction(function() use ($request) {
        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role_id' => 2, // teacher role
        ]);

        // Create Teacher linked to that User
        Teacher::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // teacher role
        ]);
    });

    return back()->with('success', 'Teacher created successfully!');
}



    /* =========================
       ASSIGN TEACHER TO MODULE
    ========================== */
    public function assignTeacher(Request $request)
{
    $request->validate([
        'module_id'  => 'required|exists:modules,id',
        'teacher_id' => 'required|exists:teachers,id', // validate against teachers table
    ]);

    $module = Module::findOrFail($request->module_id);

    // Assign teacher to module (assuming a many-to-many relationship)
    $module->teachers()->syncWithoutDetaching([$request->teacher_id]);

    return back()->with('success', 'Teacher assigned successfully!');
}


    /* =========================
       REMOVE TEACHER FROM MODULE
    ========================== */
   // Remove teacher from a specific module
public function removeTeacherFromModule(Module $module, Teacher $teacher)
{
    $teacher->modules()->detach($module->id);

    return back()->with('success', 'Teacher removed from module successfully!');
}

// Remove teacher completely
 public function removeTeacher($teacherId)
{
    $teacher = Teacher::find($teacherId);

    if (!$teacher) {
        return back()->with('error', 'Teacher not found!');
    }

    // Detach teacher from all modules
    $teacher->modules()->detach();

    // Delete teacher
    $teacher->delete();

    return back()->with('success', 'Teacher removed successfully.');
}

    /* =========================
       TOGGLE MODULE AVAILABILITY
    ========================== */
    public function toggleModuleAvailability(Module $module)
    {
        $module->is_available = !$module->is_available;
        $module->save();

        $status = $module->is_available ? 'available' : 'unavailable';
        return back()->with('success', "Module '{$module->module}' is now {$status}.");
    }
}
