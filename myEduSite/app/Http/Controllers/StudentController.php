<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function dashboard()
    {
        $student = Auth::guard('student')->user();

        // Modules currently enrolled (status pending)
        $currentModules = $student->modules()->wherePivot('pass_status', 'pending')->get();

        // Completed modules (passed/failed)
        $completedModules = $student->modules()->wherePivotIn('pass_status', ['passed','failed'])->get();

        // Available modules (not yet enrolled, and is_available)
        $availableModules = Module::where('is_available', 1)
                                  ->whereNotIn('id', $student->modules->pluck('id'))
                                  ->get();

        return view('student.dashboard', compact('student', 'currentModules', 'completedModules', 'availableModules'));
    }

    public function enroll(Request $request, $module_id)
    {
        $student = Auth::guard('student')->user();

        $currentModulesCount = $student->modules()->wherePivot('pass_status', 'pending')->count();

        if ($currentModulesCount >= 4) {
            return back()->with('error', 'You cannot enroll in more than 4 modules at a time.');
        }

        if ($student->modules()->where('module_id', $module_id)->exists()) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        $student->modules()->attach($module_id, ['enrolled_at' => now(), 'pass_status' => 'pending']);

        return back()->with('success', 'Module enrolled successfully!');
    }
}
