<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all courses
        $courses = Course::all();

        // Pass courses to the view
        return view('home', compact('courses'));
    }
}
