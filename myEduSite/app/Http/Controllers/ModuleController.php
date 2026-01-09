<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // Show all modules
    public function index()
    {
        $modules = Module::all(); // Get all modules
        return view('admin.index', compact('modules')); // admin.index blade
    }

    // Show form to create a module
    public function create()
    {
        return view('admin.create_module'); // admin.create_module blade
    }

    // Store a new module
    public function store(Request $request)
    {
        $request->validate([
            'module' => 'required|string|max:255|unique:modules,module',
        ]);

        $module = new Module();
        $module->module = $request->module;
        $module->save();

        // Redirect to create page with success message
        return redirect()->route('admin.modules.create')
                         ->with('success', 'Module added successfully!');
    }

    // Show form to edit a module
    public function edit(Module $module)
    {
        return view('admin.edit', compact('module')); // admin.edit blade
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

        // Redirect to module list with success message
        return redirect()->route('admin.modules.index')
                         ->with('success', 'Module updated successfully!');
    }

    // Delete a module
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('admin.modules.index')
                         ->with('success', 'Module deleted successfully!');
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
