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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OldStudentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);




// Teacher routes
// routes/web.php

Route::middleware(['auth:teacher', 'teacher'])->group(function () {
    // Dashboard route
    Route::get('teacher/dashboard', [TeacherController::class, 'modules'])
        ->name('teacher.dashboard'); // <- change from teacher.modules

    // Students of a module
    Route::get('teacher/modules/{module}/students', [TeacherController::class, 'students'])
        ->name('teacher.modules.students');

    // Mark PASS/FAIL
    Route::post('teacher/modules/{module}/students/{student}/status', [TeacherController::class, 'markStatus'])
        ->name('teacher.modules.students.status');
});

//


Route::middleware('auth:student')->group(function() {
    Route::get('student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('student/enroll/{module_id}', [StudentController::class, 'enroll'])->name('student.enroll');
});

Route::middleware(['auth:oldstudent', 'oldstudent'])->group(function () {
    Route::get('oldstudent/dashboard', [OldStudentController::class, 'dashboard'])->name('oldstudent.dashboard');
});

//admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware('role:web'); // web = admin


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
| Student Routes
|--------------------------------------------------------------------------
*/



Route::middleware(['auth'])->group(function () {
    Route::get('/admin/modules/create', [ModuleController::class, 'create'])
        ->name('admin.modules.create');

    Route::post('/admin/modules', [ModuleController::class, 'store'])
        ->name('admin.modules.store');
    Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('modules', [ModuleController::class, 'index'])->name('admin.index');
    Route::get('create_module', [ModuleController::class, 'create'])->name('admin.create_module');
    Route::post('modules', [ModuleController::class, 'store'])->name('admin.store');
    Route::get('modules/{module}/edit', [ModuleController::class, 'edit'])->name('admin.edit');
    Route::put('modules/{module}', [ModuleController::class, 'update'])->name('admin.update');

    Route::delete('modules/{module}', [ModuleController::class, 'destroy'])->name('admin.destroy');
});  


Route::prefix('admin')->middleware(['auth'])->group(function () {

    /* =========================
       DASHBOARD
    ========================== */
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    /* =========================
       ASSIGN TEACHER
    ========================== */
    Route::get('/assign-teacher', [AdminController::class, 'assignTeacherPage'])
        ->name('admin.assignTeacher');

    Route::post('/add-teacher', [AdminController::class, 'storeTeacher'])
        ->name('admin.addTeacher');

    Route::post('/assign-teacher', [AdminController::class, 'assignTeacher'])
        ->name('admin.assignTeacherSubmit');

    /* =========================
       CHANGE ROLE
    ========================== */
    Route::get('/change-role', [AdminController::class, 'changeRolePage'])
        ->name('admin.changeRolePage');

    Route::post('/change-role', [AdminController::class, 'changeRole'])
        ->name('admin.changeRole');

    /* =========================
       REMOVE TEACHER
    ========================== */
Route::delete('/admin/teacher/remove/{teacherId}', [AdminController::class, 'removeTeacher'])
    ->name('admin.removeTeacher');

    Route::delete(
        '/modules/{module}/teachers/{teacher}',
        [AdminController::class, 'removeTeacherFromModule']
    )->name('admin.removeTeacherFromModule');

    
    /* =========================
       TOGGLE MODULE
    ========================== */
    Route::patch(
        '/modules/{module}/toggle-availability',
        [AdminController::class, 'toggleModuleAvailability']
    )->name('admin.toggleModuleAvailability');

});

});
/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
