<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guard($role)->check()) {
            return $next($request);
        }

        return redirect('/login');
    }
}