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

        // ✅ CURRENT MODULES (Pending + NOT completed)
        $currentModules = $student->modules()
            ->wherePivot('status', 'pending')
            ->wherePivotNull('completed_at')   // 🔴 STEP 4 ADDED HERE
            ->get();

        // ✅ COMPLETED MODULES (Passed / Failed)
        $completedModules = $student->modules()
            ->wherePivotIn('status', ['passed', 'failed'])
            ->get();

        // ✅ AVAILABLE MODULES (not yet enrolled)
        $availableModules = Module::where('is_available', 1)
            ->whereNotIn('id', $student->modules->pluck('id'))
            ->get();

        return view(
            'student.dashboard',
            compact('student', 'currentModules', 'completedModules', 'availableModules')
        );
    }

    public function enroll(Request $request, $module_id)
    {
        $student = Auth::guard('student')->user();

        // ✅ Count only ACTIVE pending modules
        $currentModulesCount = $student->modules()
            ->wherePivot('status', 'pending')
            ->wherePivotNull('completed_at')
            ->count();

        if ($currentModulesCount >= 4) {
            return back()->with('error', 'You cannot enroll in more than 4 modules at a time.');
        }

        if ($student->modules()->where('module_id', $module_id)->exists()) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        // ✅ Attach module correctly
        $student->modules()->attach($module_id, [
            'enrolled_at' => now(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Module enrolled successfully!');
    }
}
