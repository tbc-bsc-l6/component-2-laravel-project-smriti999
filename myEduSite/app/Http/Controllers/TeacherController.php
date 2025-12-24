<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class TeacherController extends Controller
{
    // Teacher middleware applied via route
    // No constructor needed if middleware applied in routes

    /**
     * Show dashboard with assigned modules
     */
    public function index()
    {
        $modules = auth()->user()->modules; // only modules assigned
        return view('teacher.dashboard', compact('modules'));
    }

    /**
     * Show students of a module
     */
    public function students($module_id)
    {
        $module = Module::findOrFail($module_id);
        $students = $module->students; // all students enrolled in this module
        return view('teacher.students', compact('module','students'));
    }

    /**
     * Set PASS/FAIL for a student
     */
    public function markStatus(Request $request, $module_id, $student_id)
    {
        $request->validate([
            'status' => 'required|in:PASS,FAIL',
        ]);

        $module = Module::findOrFail($module_id);

        // Update pivot table
        $module->students()->updateExistingPivot($student_id, [
            'status' => $request->status,
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Status updated!');
    }
}
