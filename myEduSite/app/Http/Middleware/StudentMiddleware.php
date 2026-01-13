<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('student')->check()) {
            return $next($request);
        }

        abort(403, 'Unauthorized: Student role required.');
    }
}
