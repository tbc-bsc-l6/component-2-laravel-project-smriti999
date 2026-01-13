<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OldStudentController extends Controller
{
    //shows oldstudent dashboard
    public function index()
    {
        $oldStudent = Auth::guard('oldstudent')->user();

        $modules = $oldStudent->completedModules()
            ->orderBy('module_old_student.completed_at', 'desc') // ✅ FIXED
            ->get();

        return view('oldstudent.dashboard', compact('modules'));
    }
    
    //history of passed or failed
    public function history()
    {
        $oldStudent = Auth::guard('oldstudent')->user();

        $modules = $oldStudent->completedModules()
            ->orderBy('module_old_student.completed_at', 'desc') // ✅ FIXED
            ->get();

        return view('oldstudent.history', compact('modules'));
    }
}
