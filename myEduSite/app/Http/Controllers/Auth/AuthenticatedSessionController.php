<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $role = $request->role;
        $email = $request->email;
        $password = $request->password;

        $guard = null;
        $user = null;

        // Determine guard and user table
        switch ($role) {
            case 'admin':
                $guard = 'web';
                $user = \App\Models\User::where('email', $email)->first();
                break;

            case 'teacher':
                $guard = 'teacher';
                $user = \App\Models\Teacher::where('email', $email)->first();
                break;

            case 'student':
                $guard = 'student';
                $user = \App\Models\Student::where('email', $email)->first();
                break;

            case 'oldstudent':
                $guard = 'oldstudent';
                $user = \App\Models\OldStudent::where('email', $email)->first();
                break;
        }

        if (!$user || !Hash::check($password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Login using the correct guard
        Auth::guard($guard)->login($user);

        // Redirect based on role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.modules');
            case 'student':
                return redirect()->route('student.dashboard');
            case 'oldstudent':
                return redirect()->route('oldstudent.dashboard');
        }
    }

    public function destroy(Request $request)
    {
        // Logout from all guards
        Auth::guard('web')->logout();
        Auth::guard('teacher')->logout();
        Auth::guard('student')->logout();
        Auth::guard('oldstudent')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
