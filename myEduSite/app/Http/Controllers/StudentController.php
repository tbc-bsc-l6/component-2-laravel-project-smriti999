<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::guard('student')->user();

        // Modules already enrolled
        $enrolledModules = $student->modules;

        // Completed modules (with PASS/FAIL)
        $completedModules = $enrolledModules->whereNotNull('pivot.status');

        // Available modules to enroll (max 4)
        $availableModules = Module::where('is_available', 1)
            ->whereNotIn('id', $enrolledModules->pluck('id'))
            ->take(max(0, 4 - $enrolledModules->count()))
            ->get();

        return view('student.dashboard', compact('student', 'enrolledModules', 'completedModules', 'availableModules'));
    }

    public function enroll(Request $request, Module $module)
    {
        $student = Auth::guard('student')->user();

        if ($student->modules()->count() >= 4) {
            return back()->with('error', 'Maximum of 4 modules can be enrolled.');
        }

        $student->modules()->attach($module->id, ['enrolled_at' => now()]);

        return back()->with('success', "Enrolled in module: {$module->module}");
    }
}
