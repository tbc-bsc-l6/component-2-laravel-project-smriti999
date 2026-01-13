<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OldStudentMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('oldstudent')->check()) {
            return $next($request);
        }

        abort(403, 'Unauthorized: Old Student role required.');
    }
}
