<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
class DashboardController extends Controller
{

public function index()
{
    $student = Auth::guard('student')->user();

    if (!$student) {
        abort(403, 'Student not authenticated');
    }

    $currentModules = $student->modules()
        ->whereNull('module_student.completed_at')
        ->get();

    $completedModules = $student->modules()
        ->whereNotNull('module_student.completed_at')
        ->get();

    $availableModules = Module::where('is_available', 1)
        ->whereDoesntHave('students', function ($q) use ($student) {
            $q->where('student_id', $student->id);
        })
        ->withCount('students')
        ->get()
        ->filter(fn ($module) => $module->students_count < 10);

    return view('student.dashboard', compact(
        'student',
        'currentModules',
        'completedModules',
        'availableModules'
    ));
}
}