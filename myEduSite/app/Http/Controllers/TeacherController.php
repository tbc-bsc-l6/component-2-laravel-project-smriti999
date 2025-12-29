<?php
// app/Http/Controllers/TeacherDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Module;
use App\Models\Student;

class TeacherController extends Controller
{
    // Show dashboard
    public function index()
    {
        // Assume the teacher is fixed or you get the first one
        $teacher = Teacher::first();  // replace with your logic if you want specific teacher

        // Load modules with students
        $modules = $teacher->modules()->with('students')->get();

        return view('teacher.dashboard', compact('teacher', 'modules'));
    }

    // Set PASS / FAIL for a student in a module
    public function setResult(Request $request, Module $module, Student $student)
    {
        $request->validate([
            'result' => 'required|in:PASS,FAIL',
        ]);

        // Attach result with timestamp
        $student->modules()->updateExistingPivot($module->id, [
            'result' => $request->result,
            'completed_at' => now()
        ]);

        return back()->with('success', 'Result updated successfully.');
    }
}
