<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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



    // Show assign teacher page
    public function assignTeacherPage()
    {
        $modules = Module::with('teachers')->get();

        // Get all users with role = Teacher
        $teacherRole = Role::where('name', 'Teacher')->first();
        $teachers = User::where('role_id', $teacherRole->id)->get();

        return view('admin.assignTeacher', compact('modules', 'teachers'));
    }

    // Add teacher (as a User with role = Teacher)
    public function addTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $teacherRole = Role::where('name', 'Teacher')->first();

        User::create([
            'name'     => $request->name,
            'email'    => $request->name.'_'.time().'@example.com', // dummy unique email
            'password' => Hash::make('password'),
            'role_id'  => $teacherRole->id,
        ]);

        return redirect()->route('admin.assignTeacher')
            ->with('success', 'Teacher added successfully');
    }

    // Assign teacher to module
    public function assignTeacherSubmit(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'user_id'   => 'required|exists:users,id',
        ]);

        $module = Module::findOrFail($request->module_id);
        $module->teachers()->syncWithoutDetaching([$request->user_id]);

        return redirect()->route('admin.assignTeacher')
            ->with('success', 'Teacher assigned');
    }

    // Remove teacher from module
    public function removeTeacher(Module $module, User $user)
    {
        $module->teachers()->detach($user->id);

        return redirect()->route('admin.assignTeacher')
            ->with('success', 'Teacher removed');
    }
}
