<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Http\Controllers\ProfileController;
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

Route::get('/blogs', function () {
    $blogs = Blog::latest()->get();
    return view('blogs', compact('blogs'));
})->name('blogs.index');

Route::get('/blogs/{blog}', [BlogController::class, 'show'])
    ->name('blogs.show');

/*
|--------------------------------------------------------------------------
| Blog Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/blogs/create', function () {
        return view('createblog');
    })->name('blogs.create');

    Route::post('/blogs', [BlogController::class, 'store'])
        ->name('blogs.store');

    Route::get('/blog/{blog}/edit', function (Blog $blog) {
        if (Gate::denies('update-blog', $blog)) {
            abort(403);
        }
        return view('editblog', compact('blog'));
    })->name('blogs.edit');

    Route::put('/blog/{blog}', [BlogController::class, 'update'])
        ->name('blogs.update');

    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])
        ->name('blogs.destroy');
});

/*
|--------------------------------------------------------------------------
| Default Dashboard (Breeze - optional)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes (Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ROLE BASED DASHBOARDS
|--------------------------------------------------------------------------
*/

/* =======================
   ADMIN ROUTES
======================= */
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

    // Modules
    Route::get('/modules/create',[ModuleController::class,'create'])->name('modules.create');
    Route::post('/modules/store',[ModuleController::class,'store'])->name('modules.store');
    Route::put('/modules/toggle/{id}',[ModuleController::class,'toggle'])->name('modules.toggle');

    // Admin actions
    Route::post('/assign-teacher',[AdminController::class,'assignTeacher'])->name('admin.assignTeacher');
    Route::post('/change-role',[AdminController::class,'changeRole'])->name('admin.changeRole');
});



/* =======================
   TEACHER ROUTES
======================= */
Route::middleware(['auth', 'role:Teacher'])->group(function () {

    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])
        ->name('teacher.dashboard');

    Route::get('/teacher/students/{module_id}', [TeacherController::class, 'students'])
        ->name('teacher.students');

    Route::post('/teacher/markStatus/{module_id}/{student_id}',
        [TeacherController::class, 'markStatus'])
        ->name('teacher.markStatus');
});

/* =======================
   STUDENT ROUTES
======================= */
Route::middleware(['auth', 'role:Student'])->group(function () {

    Route::get('/student/dashboard', [StudentController::class, 'index'])
        ->name('student.dashboard');

    Route::post('/student/enroll/{module_id}', [StudentController::class, 'enroll'])
        ->name('student.enroll');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
