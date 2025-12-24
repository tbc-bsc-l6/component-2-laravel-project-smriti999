<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        $users = User::all();
        $teachers = User::whereHas('role', fn($q) => $q->where('name','Teacher'))->get();

        return view('admin.dashboard', compact('modules','users','teachers'));
    }

    public function assignTeacher(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'module_id'  => 'required|exists:modules,id',
        ]);

        $module = Module::findOrFail($request->module_id);
        $module->teacher_id = $request->teacher_id;
        $module->save();

        return back()->with('success', 'Teacher assigned successfully.');
    }

    public function changeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role'    => 'required|string|in:Admin,Teacher,Student',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = UserRole::where('name', $request->role)->first();

        if(!$role) return back()->with('error','Role not found');

        $user->user_role_id = $role->id;
        $user->save();

        return back()->with('success','User role updated successfully.');
    }

    public function addTeacher(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',
        ]);

        $teacherRole = UserRole::where('name','Teacher')->first();
        if(!$teacherRole) return back()->with('error','Teacher role not found');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? 'password'),
            'user_role_id' => $teacherRole->id,
        ]);

        return back()->with('success','Teacher added successfully.');
    }

    public function removeTeacher(User $user)
    {
        if($user->hasRole('Teacher')){
            $user->delete();
            return back()->with('success','Teacher removed successfully.');
        }
        return back()->with('error','Cannot delete this user.');
    }
}
