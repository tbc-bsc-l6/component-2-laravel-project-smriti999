<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage (shows blogs)
Route::get('/', [BlogController::class, 'index'])->name('home');

// Static pages
Route::view('/courses', 'courses')->name('courses');

Route::view('/about', 'about')->name('about');

Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| Blog Routes (Public)
|--------------------------------------------------------------------------
*/

// Blog list page
Route::get('/blogs', function () {
    $blogs = Blog::latest()->get();
    return view('blogs', compact('blogs'));
})->name('blogs.index');

// Single blog page
Route::get('/blog/{blog}', function (Blog $blog) {
    return view('showblog', compact('blog'));
})->name('blogs.show');

/*
|--------------------------------------------------------------------------
| Blog Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Create blog
    Route::get('/blogs/create', function () {
        return view('createblog');
    })->name('blogs.create');

    Route::post('/blogs', [BlogController::class, 'store'])
        ->name('blogs.store');

    // Edit blog
    Route::get('/blog/{blog}/edit', function (Blog $blog) {
        if (Gate::denies('update-blog', $blog)) {
            abort(403);
        }
        return view('editblog', compact('blog'));
    })->name('blogs.edit');

    Route::put('/blog/{blog}', [BlogController::class, 'update'])
        ->name('blogs.update');

    // Delete blog
    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])
        ->name('blogs.destroy');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Routes of 3
Route::middleware(['auth','role:Admin'])->group(function () {
    // admin routes
});

Route::middleware(['auth','role:Teacher'])->group(function () {
    // teacher routes
});

Route::middleware(['auth','role:Student'])->group(function () {
    // student routes
});



//route for admin teacher student
Route::middleware(['auth','role:Admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/modules/create',[ModuleController::class,'create'])->name('modules.create');
    Route::post('/modules/store',[ModuleController::class,'store'])->name('modules.store');
    Route::put('/modules/toggle/{id}',[AdminController::class,'toggleModule'])->name('modules.toggle');

    Route::post('/admin/assignTeacher',[AdminController::class,'assignTeacher'])->name('admin.assignTeacher');
    Route::post('/admin/changeRole',[AdminController::class,'changeRole'])->name('admin.changeRole');
});

Route::middleware(['auth','role:Teacher'])->group(function(){
    Route::get('/teacher/dashboard',[TeacherController::class,'index'])->name('teacher.dashboard');
    Route::get('/teacher/students/{module_id}',[TeacherController::class,'students'])->name('teacher.students');
    Route::post('/teacher/markStatus/{module_id}/{student_id}',[TeacherController::class,'markStatus'])->name('teacher.markStatus');
});

Route::middleware(['auth','role:Student'])->group(function(){
    Route::get('/student/dashboard',[StudentController::class,'index'])->name('student.dashboard');
    Route::post('/student/enroll/{module_id}',[StudentController::class,'enroll'])->name('student.enroll');
});

Route::middleware(['auth','role:Admin'])->group(function(){
    Route::post('/admin/assignTeacher',[AdminController::class,'assignTeacher'])->name('admin.assignTeacher');
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
