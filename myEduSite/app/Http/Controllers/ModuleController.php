<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Teacher;

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



public function assignTeacherPage()
{
    $modules = Module::all();
    $teachers = Teacher::all();
    return view('admin.assignTeacher', compact('modules', 'teachers'));
}

    // Add new teacher
    public function addTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teachers,name',
        ]);

        Teacher::create(['name' => $request->name]);

        return redirect()->route('admin.assignTeacher')
                         ->with('success', 'Teacher added successfully!');
    }

    // Assign teacher to module
    public function assignTeacher(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $module = Module::findOrFail($request->module_id);
        $module->teachers()->syncWithoutDetaching($request->teacher_id);

        return redirect()->route('admin.assignTeacher')
                         ->with('success', 'Teacher assigned successfully!');
    }

    // Remove teacher from module
    public function removeTeacher(Module $module, Teacher $teacher)
    {
        $module->teachers()->detach($teacher->id);

        return redirect()->route('admin.assignTeacher')
                         ->with('success', 'Teacher removed successfully!');
    }

}
