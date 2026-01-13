<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    //admindashboard
    public function index()
    {
        $users   = User::all();
        $modules = Module::all();

        return view('admin.dashboard', compact('users', 'modules'));
    }

   //change role page 
    public function changeRolePage()
        {
            // Eager load userRole relationship
            $users = User::with('userRole')->get();
            $roles = UserRole::all();

            return view('admin.changeRole', compact('users', 'roles'));
        }

    //can chnage role by admin
    public function changeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:user_roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $oldRole = optional($user->userRole)->role;
        $newRole = UserRole::findOrFail($request->role_id)->role;

        // teacher can not be oldstudent
        if ($oldRole === 'teacher' && $newRole === 'oldstudent') {
            return back()->with('error', 'Teacher cannot be changed into Old Student.');
        }

        DB::transaction(function () use ($user, $request, $oldRole, $newRole) {

            // Update role
            $user->user_role_id = $request->role_id;
            $user->save();

            //student to oldstudent
            if ($oldRole === 'student' && $newRole === 'oldstudent') {

                $student = $user->student;

                if ($student) {

                    // Create OldStudent
                    $oldStudent = \App\Models\OldStudent::create([
                        'user_id'  => $user->id,
                        'name'     => $user->name,
                        'email'    => $user->email,
                        'password' => $user->password,
                    ]);

                    //Move module_student to module_old_student
                    $records = DB::table('module_student')
                        ->where('student_id', $student->id)
                        ->get();

                    foreach ($records as $record) {
                        DB::table('module_old_student')->insert([
                            'old_student_id' => $oldStudent->id,
                            'module_id'      => $record->module_id,
                            'status'         => $record->status,
                            'enrolled_at'    => $record->enrolled_at ?? null,
                            'completed_at'   => $record->completed_at,
                            'created_at'     => now(),
                            'updated_at'     => now(),
                        ]);
                    }

                    //Delete from module_student 
                    DB::table('module_student')
                        ->where('student_id', $student->id)
                        ->delete();

                    //Delete student profile 
                    $student->delete();
                }

                return;
            }

            
            // REMOVE OLD ROLE RECORDS (NON-STUDENT CASES)
            if ($oldRole === 'teacher' && $user->teacher) {
                $user->teacher->delete();
            }

            if ($oldRole === 'oldstudent' && $user->oldStudent) {
                $user->oldStudent->delete();
            }

            
            //CREATE NEW ROLE RECORDS
            
            if ($newRole === 'teacher') {
                \App\Models\Teacher::create([
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'password'=> $user->password,
                    'role_id' => $user->user_role_id,
                ]);
            }

            if ($newRole === 'student') {
                \App\Models\Student::create([
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'password'=> $user->password,
                ]);
            }
        });

        return back()->with(
            'success',
            "User role changed from {$oldRole} to {$newRole} successfully."
        );
    }


        //assign teacher page 
            public function assignTeacherPage()
        {
            $modules = Module::with('teachers')->get();
            
            // Get all teachers from teachers table
            $teachers = Teacher::all();

            return view('admin.assignTeacher', compact('modules', 'teachers'));
        }

        //store teacher
        public function storeTeacher(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            \DB::transaction(function() use ($request) {
                // Create User
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'user_role_id' => 2, // teacher role
                ]);

                // Create Teacher linked to that User
                Teacher::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => 2, // teacher role
                ]);
            });

            return back()->with('success', 'Teacher created successfully!');
        }

        //assign teacher to module 
            public function assignTeacher(Request $request)
        {
            $request->validate([
                'module_id'  => 'required|exists:modules,id',
                'teacher_id' => 'required|exists:teachers,id', // validate against teachers table
            ]);

            $module = Module::findOrFail($request->module_id);

            // Assign teacher to module (assuming a many-to-many relationship)
            $module->teachers()->syncWithoutDetaching([$request->teacher_id]);

            return back()->with('success', 'Teacher assigned successfully!');
        }

        // Remove teacher from a specific module
        public function removeTeacherFromModule(Module $module, Teacher $teacher)
        {
            $teacher->modules()->detach($module->id);

            return back()->with('success', 'Teacher removed from module successfully!');
        }

        //remove student form module
        public function removeStudentFromModule($moduleId, $studentId)
        {
            $module = \App\Models\Module::findOrFail($moduleId);
            $student = \App\Models\Student::findOrFail($studentId);

            // Detach the student from the module
            $module->students()->detach($student->id);

            return back()->with('success', 'Student removed from module successfully!');
        }

        // Remove teacher completely form database
        public function removeTeacher($teacherId)
        {
            $teacher = Teacher::find($teacherId);

            if (!$teacher) {
                return back()->with('error', 'Teacher not found!');
            }

            // Detach teacher from all modules
            $teacher->modules()->detach();

            // Delete teacher
            $teacher->delete();

            return back()->with('success', 'Teacher removed successfully.');
        }
}
