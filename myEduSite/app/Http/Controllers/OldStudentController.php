<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OldStudentController extends Controller
{
    public function index()
    {
        // Get logged-in old student
        $oldStudent = Auth::guard('oldstudent')->user();

        // Fetch completed modules
        $modules = $oldStudent->modules()
                              ->whereNotNull('module_student.completed_at')
                              ->get();

        // Pass $modules to Blade
        return view('oldstudent.dashboard', compact('modules'));
    }
}
