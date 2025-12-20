<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class TeacherController extends Controller
{
    // Teacher dashboard: show assigned modules
    public function index()
    {
        $modules = auth()->user()->modules; // only modules assigned
        return view('teacher.dashboard', compact('modules'));
    }

    // View students of a module
    public function students($module_id)
    {
        $module = Module::findOrFail($module_id);
        $students = $module->students;
        return view('teacher.students', compact('module','students'));
    }

    // Set PASS/FAIL for a student
    public function markStatus(Request $request, $module_id, $student_id)
    {
        $module = Module::findOrFail($module_id);
        $student = $module->students()->where('user_id', $student_id)->first();

        $module->students()->updateExistingPivot($student_id, [
            'status' => $request->status,
            'completed_at' => now()
        ]);

        return back()->with('success','Status updated!');
    }
}
