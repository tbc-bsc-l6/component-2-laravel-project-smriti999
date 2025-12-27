<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Show all courses
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Show a single course
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
