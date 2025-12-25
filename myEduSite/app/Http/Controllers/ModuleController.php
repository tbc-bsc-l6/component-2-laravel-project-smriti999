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

    dd($request->all()); // <- This will show if 'module' is coming

    Module::create([
        'module' => $request->module,
    ]);

    return redirect()->route('admin.create')
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
        $request->validate([
            'module' => 'required|string|max:255|unique:modules,module,' . $module->id,
        ]);

        $module->update([
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
