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

        $user = null;

        switch ($role) {
            case 'admin':
                $user = \App\Models\User::where('email', $email)->first();
                break;

            case 'teacher':
                $user = \App\Models\Teacher::where('email', $email)->first();
                break;

            case 'student':
                $user = \App\Models\Student::where('email', $email)->first();
                break;

            case 'oldstudent':
                $user = \App\Models\OldStudent::where('email', $email)->first();
                break;
        }

        if (!$user || !Hash::check($password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Login the user using web guard
        Auth::login($user);

        // Redirect based on role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
            case 'oldstudent':
                return redirect()->route('oldstudent.dashboard');
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
