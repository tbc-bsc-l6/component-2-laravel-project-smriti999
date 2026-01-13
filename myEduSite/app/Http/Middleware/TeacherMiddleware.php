<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    //check teacher or not
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('teacher')->check()) {
            abort(403, 'Unauthorized: Teacher role required.');
        }

        return $next($request);
    }
}
