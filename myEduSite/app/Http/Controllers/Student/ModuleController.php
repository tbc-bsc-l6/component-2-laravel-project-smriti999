<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    // Show available modules
    public function available()
    {
        $student = Auth::guard('student')->user();

        $modules = Module::where('is_available', true)
            ->withCount(['students as enrolled_count' => function ($q) {
                $q->whereNull('module_student.completed_at');
            }])
            ->having('enrolled_count', '<', 10)
            ->get();

        return view('student.modules.available', compact('modules'));
    }

    // Enroll in a module
    public function enroll(Module $module)
{
    $student = Auth::guard('student')->user();

    if ($student->modules()->where('module_id', $module->id)->exists()) {
        return back()->with('error', 'You are already enrolled in this module.');
    }

    $student->modules()->attach($module->id, [
        'enrolled_at' => now(),
        'status' => 'pending',
    ]);

    return back()->with('success', 'You have successfully enrolled in the module.');
}
}
