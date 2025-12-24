<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class ModuleController extends Controller
{
    // Admin: show create module form
    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.create_module', compact('teachers'));
    }

    // Admin: store new module
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Module::create([
            'name' => $request->name,
            'description' => $request->description,
            'teacher_id' => $request->teacher_id,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Module created!');
    }

    // Admin: toggle module availability
    public function toggle($id)
    {
        $module = Module::findOrFail($id);
        $module->is_available = !$module->is_available;
        $module->save();

        return back()->with('success', 'Module availability updated!');
    }
}