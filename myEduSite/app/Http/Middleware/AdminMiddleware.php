<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Check if user_role_id = 1 (Admin)
        if (auth()->user()->user_role_id != 1) {
            abort(403); // Not admin
        }

        return $next($request);
    }
}
