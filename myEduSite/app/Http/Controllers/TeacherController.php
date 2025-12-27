<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\User;

class TeacherController extends Controller
{
    // Show teacher dashboard with assigned modules
    public function modules()
    {
        $teacher = Auth::user();

        // Get assigned modules with students
        $modules = $teacher->modules()->with('students')->get();

        return view('teacher.dashboard', compact('modules'));
    }

    // Show students of a module
    public function students(Module $module)
    {
        $students = $module->students; // pivot includes pass_status, completed_at
        return view('teacher.students', compact('module', 'students'));
    }

    // Set PASS / FAIL for a student
    public function setStatus(Request $request, Module $module, User $student)
    {
        $status = $request->input('pass_status'); // 'PASS' or 'FAIL'

        $module->students()->updateExistingPivot($student->id, [
            'pass_status' => $status,
            'completed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Status updated!');
    }
}
