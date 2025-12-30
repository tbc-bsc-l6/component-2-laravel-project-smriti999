<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Module;
use App\Models\Student;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class TeacherController extends Controller
{
    public function modules()
    {
        $teacher = auth()->user(); // logged in teacher
        $modules = $teacher->modules; // via pivot table

        return view('teacher.dashboard', compact('modules'));
    }

}