<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OldStudentController extends Controller
{
    public function dashboard()
    {
        $oldStudent = Auth::guard('oldstudent')->user();
        $completedModules = $oldStudent->modules()->wherePivotNotNull('status')->get();

        return view('oldstudent.dashboard', compact('oldStudent', 'completedModules'));
    }
}
