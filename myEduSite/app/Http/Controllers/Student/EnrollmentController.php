<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll($moduleId)
    {
        $student = Auth::user()->student; // student linked to user
        $module = Module::findOrFail($moduleId);

        // ❌ Module archived
        if (!$module->is_available) {
            return back()->with('error', 'Module is not available.');
        }

        // ❌ Student already enrolled
        if ($student->modules()->where('module_id', $moduleId)->exists()) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        // ❌ Max 4 active modules per student
        $activeModules = $student->modules()
            ->whereNull('module_student.completed_at')
            ->count();

        if ($activeModules >= 4) {
            return back()->with('error', 'You can enroll in maximum 4 active modules.');
        }

        // ❌ Max 10 active students per module
        $activeStudents = $module->activeStudents()->count();

        if ($activeStudents >= 10) {
            return back()->with('error', 'Module is full. Maximum 10 students allowed.');
        }

        // ✅ Enroll student
        $student->modules()->attach($moduleId, [
            'enrolled_at' => now(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Successfully enrolled in module.');
    }
}
