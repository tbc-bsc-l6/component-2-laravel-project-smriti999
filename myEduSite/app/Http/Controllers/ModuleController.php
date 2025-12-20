<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    // List all modules
    public function index()
    {
        $modules = Module::where('is_available', true)->get();
        return view('modules.index', compact('modules'));
    }

    // Show single module
    public function show($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.show', compact('module'));
    }

    // Admin: create module form
    public function create()
    {
        return view('admin.create_module');
    }

    // Admin: store module
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
        ]);

        Module::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_available'=>true,
        ]);

        return redirect()->route('modules.index')->with('success','Module created!');
    }

    // Admin: toggle availability
    public function toggle($id)
    {
        $module = Module::findOrFail($id);
        $module->is_available = !$module->is_available;
        $module->save();

        return back()->with('success','Module availability updated!');
    }
}
