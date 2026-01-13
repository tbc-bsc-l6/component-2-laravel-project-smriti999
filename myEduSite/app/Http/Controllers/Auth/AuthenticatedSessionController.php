<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|string',
        ]);

        $role = strtolower($request->role);
        $email = $request->email;
        $password = $request->password;

        $user = null;
        $guard = 'web';

        // Match user and guard
        switch ($role) {
            case 'admin':
                $user = User::where('email', $email)->first();
                $guard = 'web';
                break;
            case 'teacher':
                $user = Teacher::where('email', $email)->first();
                $guard = 'teacher';
                break;
            case 'student':
                $user = Student::where('email', $email)->first();
                $guard = 'student';
                break;
            case 'oldstudent':
                $user = OldStudent::where('email', $email)->first();
                $guard = 'oldstudent';
                break;
            default:
                return back()->withErrors(['role' => 'Invalid role selected']);
        }

        if (!$user || !Hash::check($password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials for this role']);
        }

        Auth::guard($guard)->login($user);
        $request->session()->regenerate();

        // Redirect by role
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            'oldstudent' => redirect()->route('oldstudent.dashboard'),
        };
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('teacher')->logout();
        Auth::guard('student')->logout();
        Auth::guard('oldstudent')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
