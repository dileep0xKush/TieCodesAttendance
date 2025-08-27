<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has a 'superadmin' role
        if (Auth::check() && Auth::user()->type == 'superadmin') {
            return $next($request);  // Allow the request to proceed
        }

        // If the user is not a superadmin, redirect to the home page
        return redirect('/');
    }
}
