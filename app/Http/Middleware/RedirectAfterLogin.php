<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAfterLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Redirect admin users to the Voyager admin dashboard
            if (Auth::user()->role->name === 'user') {
                return redirect('/registration-form');
            }

            // Redirect regular users to the custom user dashboard
//            return redirect('/registration-form');
        }

        return $next($request);
    }
}