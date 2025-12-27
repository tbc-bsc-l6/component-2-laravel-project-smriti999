<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $users   = User::all();      // or User::count()
    $modules = Module::all();    // or Module::count()

    return view('admin.dashboard', compact('users', 'modules'));
}
    // SHOW page
    public function changeRolePage()
    {
        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin.changeRole', compact('users', 'roles'));
    }

    // UPDATE role
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

     // Remove teacher from a module only
    public function removeTeacherFromModule(Module $module, User $teacher)
    {
        $teacher->modules()->detach($module->id);
        return redirect()->back()->with('success', 'Teacher removed from module successfully!');
    }

    // Remove teacher completely
    public function destroy(User $user)
    {
        $user->modules()->detach();
        $user->delete();
        return redirect()->back()->with('success', 'Teacher removed successfully!');
    }

    public function toggleModuleAvailability(Module $module)
{
    $module->is_available = !$module->is_available; // toggle true/false
    $module->save();

    $status = $module->is_available ? 'available' : 'unavailable';
    return redirect()->back()->with('success', "Module '{$module->module}' is now {$status}.");
}

}
