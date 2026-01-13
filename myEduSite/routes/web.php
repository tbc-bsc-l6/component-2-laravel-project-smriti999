<?php

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\EnrollmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Student\ModuleController as StudentModuleController;
use App\Http\Controllers\Student\StudentController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Controllers\Admin\TeacherController as AdminTeacher;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OldStudentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware(['auth:oldstudent'])
    ->prefix('old-student')
    ->name('oldstudent.')
    ->group(function () {

        Route::get('/dashboard', [OldStudentController::class, 'index'])
            ->name('dashboard');

        Route::get('/oldstudent/history', [OldStudentController::class, 'history'])
    ->name('oldstudent.history');
Route::post('/admin/students/{id}/convert-old', 
    [AdminController::class, 'convertToOldStudent']
)->name('admin.students.convertOld');
    });


//admin dashboard
Route::prefix('admin')->middleware([AdminMiddleware::class])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});


// Homepage (shows blogs)
Route::get('/', [BlogController::class, 'index'])->name('home');

// Static pages
Route::view('/courses', 'courses')->name('courses');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');







Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', BlogController::class);
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
//for api of live search
Route::get('/api/modules/search', [ModuleController::class, 'searchModules']);









// my worked urls 


// Remove student from module (Admin)
Route::delete('admin/modules/{module}/students/{student}/remove', [App\Http\Controllers\AdminController::class, 'removeStudentFromModule'])
    ->name('admin.modules.students.remove');


Route::middleware([AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

       
    // List all modules
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');

    // Show form to create a module
    Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');

    // Store new module
    Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');

    // Show form to edit a module
    Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');

    // Update a module
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');

    // Delete a module
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    // Toggle availability
    Route::patch('/modules/{module}/toggle', [ModuleController::class, 'toggleModuleAvailability'])
        ->name('modules.toggle');

    //change role from current role
    Route::get('/change-role', [AdminController::class, 'changeRolePage'])->name('changeRolePage');
    Route::post('/change-role', [AdminController::class, 'changeRole'])->name('changeRole');

    //adding new teacher assign
    Route::get('/assign-teacher', [AdminController::class, 'assignTeacherPage'])->name('assignTeacher');
    Route::post('/assign-teacher', [AdminController::class, 'assignTeacher'])->name('assignTeacherSubmit');
    Route::post('/add-teacher', [AdminController::class, 'storeTeacher'])->name('addTeacher');

    //remove teacher permanently
    Route::delete('/teacher/remove/{teacher}', [AdminController::class, 'removeTeacher'])->name('removeTeacher');

    //remove teacher form module
    Route::delete('/modules/{module}/teachers/{teacher}', [AdminController::class, 'removeTeacherFromModule'])
        ->name('removeTeacherFromModule');
     
      

        });





 
    
    


 // Teacher routes
Route::prefix('teacher')
    ->middleware(['auth:teacher', 'teacher'])
    ->name('teacher.') // all route names will start with teacher.
    ->group(function () {

        // Teacher dashboard
        Route::get('/dashboard', [TeacherController::class, 'modules'])
            ->name('dashboard');

        // List students in a module
        Route::get('/modules/{module}/students', [TeacherController::class, 'students'])
            ->name('modules.students');

        // Mark PASS/FAIL for a student in a module
        Route::post(
            '/modules/{module}/students/{student}/status',
            [TeacherController::class, 'updateStudentStatus']
        )->name('student.status'); // final route name: teacher.student.status
    });


  
//student 
Route::prefix('student')
    ->middleware(['auth:student'])
    ->name('student.')
    ->group(function () {

        // Student dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Enroll in a module
        Route::post('/enroll/{module}', [StudentModuleController::class, 'enroll'])
            ->name('enroll'); // points to Student\ModuleController
    });

   
/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';