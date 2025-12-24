<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Controllers\Admin\TeacherController as AdminTeacher;
use App\Http\Controllers\TeacherController;

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

// Blogs public
Route::get('/blogs', function () {
    $blogs = Blog::latest()->get();
    return view('blogs', compact('blogs'));
})->name('blogs.index');

Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

/*
|--------------------------------------------------------------------------
| Authenticated Blog Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/blogs/create', function () {
        return view('createblog');
    })->name('blogs.create');

    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

    Route::get('/blog/{blog}/edit', function (Blog $blog) {
        if (Gate::denies('update-blog', $blog)) {
            abort(403);
        }
        return view('editblog', compact('blog'));
    })->name('blogs.edit');

    Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

/*
|--------------------------------------------------------------------------
| Dashboard & Profile
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

    // Modules
    Route::get('/modules/create', [ModuleController::class,'create'])->name('modules.create');
    Route::post('/modules/store', [ModuleController::class,'store'])->name('modules.store');
    Route::put('/modules/toggle/{id}', [ModuleController::class,'toggle'])->name('modules.toggle');

    // Admin actions
    Route::post('/assign-teacher', [AdminController::class,'assignTeacher'])->name('admin.assignTeacher');
    Route::post('/change-role', [AdminController::class,'changeRole'])->name('admin.changeRole');
    Route::post('/add-teacher', [AdminController::class,'addTeacher'])->name('admin.addTeacher');
    Route::delete('/remove-teacher/{user}', [AdminController::class,'removeTeacher'])->name('admin.removeTeacher');
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/

Route::prefix('teacher')->middleware([TeacherMiddleware::class])->group(function() {
    Route::get('/dashboard', [TeacherController::class,'index']);
    Route::get('/module/{module}/students', [TeacherController::class,'students']);
    Route::post('/module/{module}/student/{student}/status', [TeacherController::class,'markStatus']);
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::post('/enroll/{module_id}', [StudentController::class, 'enroll'])->name('student.enroll');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
