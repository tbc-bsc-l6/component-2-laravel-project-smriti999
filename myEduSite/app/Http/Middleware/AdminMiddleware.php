<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
   // app/Http/Middleware/AdminMiddleware.php
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Make sure we check the correct column
        if (!$user || !$user->role || $user->role->role !== 'Admin') {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }

}
