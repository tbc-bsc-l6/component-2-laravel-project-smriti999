<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Module;
use App\Models\Student;


class TeacherController extends Controller
{
    public function modules()
    {
        $teacher = auth()->user(); // logged in teacher
        $modules = $teacher->modules; // via pivot table

        return view('teacher.dashboard', compact('modules'));
    }

public function updateStudentStatus($moduleId, $studentId, Request $request)
{
    $module = Module::findOrFail($moduleId);
    $student = Student::findOrFail($studentId);

    // Convert button value to DB value
    $newStatus = $request->status === 'pass' ? 'passed' : 'failed';

    // ⭐ THIS IS THE FIX
    $module->students()->updateExistingPivot($student->id, [
        'status'       => $newStatus,
        'completed_at' => now(),   // ← VERY IMPORTANT
        'updated_at'   => now(),
    ]);

    return back()->with('success', 'Student status updated successfully!');
}



}