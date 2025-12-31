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

    $newStatus = $request->status === 'pass' ? 'passed' : 'failed';

    $module->students()->updateExistingPivot($student->id, [
        'status' => $newStatus,
        'updated_at' => now(),
    ]);

    return back()->with('success', 'Student status updated successfully!');
}


}