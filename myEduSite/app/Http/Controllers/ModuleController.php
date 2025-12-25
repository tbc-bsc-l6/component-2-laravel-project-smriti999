<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    // Show all modules
    public function index()
    {
        $modules = Module::all(); // Get all modules
        return view('admin.index', compact('modules')); // Correct view path
    }

    // Show form to create a module
    public function create()
    {
        return view('admin.create_module'); // Correct view path
    }

    // Store a new module
 public function store(Request $request)
{
    $request->validate([
        'module' => 'required|string|max:255|unique:modules,module',
    ]);

    // Debug: make sure the value is coming
    // dd($request->all());

    $module = new Module();
    $module->module = $request->module; // Assign directly
    $module->save(); // Save to database

    return redirect()->route('admin.create_module')
                     ->with('success', 'Module added successfully!');
}


    // Show form to edit a module
    public function edit(Module $module)
    {
        return view('admin.edit', compact('module')); // Correct view path
    }

    // Update a module
public function update(Request $request, Module $module)
{
    // Validate
    $request->validate([
        'module' => 'required|string|max:255|unique:modules,module,' . $module->id,
    ]);

    // Direct DB update (like your Blog example)
    Module::where('id', $module->id)->update([
        'module' => $request->module,
    ]);

    return redirect()->route('admin.index')
                     ->with('success', 'Module updated successfully!');
}




    // Delete a module
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.index')
                         ->with('success', 'Module deleted successfully!');
    }
}
