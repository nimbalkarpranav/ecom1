<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if ($role && Auth::user()->role !== $role) {
             
            return redirect('/home')->with('error', 'Access denied. Admins only.');
        }

        return $next($request);
    }
}
