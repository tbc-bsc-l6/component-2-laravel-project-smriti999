<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        $users = User::all();
        $teachers = User::where('role','teacher')->get();

        return view('admin.dashboard', compact('modules','users','teachers'));
    }

    public function assignTeacher(Request $request)
    {
        $module = Module::findOrFail($request->module_id);
        $module->teacher_id = $request->teacher_id;
        $module->save();

        return back()->with('success','Teacher assigned successfully.');
    }

    public function changeRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success','User role updated.');
    }
}
