<?php
namespace App\Http\Controllers\OldStudent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $oldStudent = Auth::guard('oldstudent')->user();

        $completedModules = $oldStudent->modules()
            ->whereNotNull('module_student.completed_at')
            ->get();

        return view('oldstudent.dashboard', compact('oldStudent', 'completedModules'));
    }
}
