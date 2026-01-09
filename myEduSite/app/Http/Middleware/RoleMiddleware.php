<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        $userRole = null;
        if ($user instanceof \App\Models\User) {
            $userRole = 'admin';
        } elseif ($user instanceof Teacher) {
            $userRole = 'teacher';
        } elseif ($user instanceof Student) {
            $userRole = 'student';
        } elseif ($user instanceof OldStudent) {
            $userRole = 'oldstudent';
        }

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
