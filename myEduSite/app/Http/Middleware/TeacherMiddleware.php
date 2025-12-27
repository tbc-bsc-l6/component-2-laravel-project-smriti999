<?php

namespace App\Http\Middleware;

use Closure;

class TeacherMiddleware
{
    public function handle($request, \Closure $next)
{
    if (!auth('teacher')->check()) {
        abort(403);
    }
    return $next($request);
}

}
