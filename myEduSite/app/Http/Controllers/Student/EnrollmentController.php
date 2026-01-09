<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll($moduleId)
    {
        $student = Auth::user()->student; // logged-in student's model
        $module = Module::findOrFail($moduleId);

        // ❌ Check if module is available
        if (!$module->is_available) {
            return back()->with('error', 'Module is not available.');
        }

        // ❌ Check if student already enrolled in this module
        if ($student->modules()->where('module_id', $moduleId)->exists()) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        // ❌ Check max 4 active modules per student
        // Get all active modules where pivot.completed_at is null
        $activeModulesCount = $student->modules()
            ->wherePivot('completed_at', null)
            ->count();

        if ($activeModulesCount >= 4) {
            return back()->with('error', 'You can enroll in a maximum of 4 active modules.');
        }

        // ❌ Check max 10 active students per module
        $activeStudentsCount = $module->students()
            ->wherePivot('completed_at', null)
            ->count();

        if ($activeStudentsCount >= 10) {
            return back()->with('error', 'Module is full. Maximum 10 students allowed.');
        }

        // ✅ Enroll the student
        $student->modules()->attach($moduleId, [
            'enrolled_at' => now(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Successfully enrolled in the module.');
    }
}
