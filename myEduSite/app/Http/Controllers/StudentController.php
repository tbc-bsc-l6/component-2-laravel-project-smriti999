<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class StudentController extends Controller
{
    // Dashboard: show current and completed modules
    public function index()
    {
        $user = auth()->user();
        $current = $user->modules()->wherePivotNull('completed_at')->get();
        $completed = $user->modules()->wherePivotNotNull('completed_at')->get();

        return view('student.dashboard', compact('current','completed'));
    }

    // Enroll in a module
    public function enroll($module_id)
    {
        $user = auth()->user();
        $module = Module::findOrFail($module_id);

        // Check max 4 modules
        $currentCount = $user->modules()->wherePivotNull('completed_at')->count();
        if ($currentCount >= 4) {
            return back()->withErrors('You cannot enroll in more than 4 modules.');
        }

        // Check module max 10 students
        $moduleCount = $module->students()->wherePivotNull('completed_at')->count();
        if ($moduleCount >= 10) {
            return back()->withErrors('Module is full.');
        }

        $user->modules()->attach($module_id, ['enrolled_at'=>now()]);

        return back()->with('success','Enrolled successfully!');
    }
}
