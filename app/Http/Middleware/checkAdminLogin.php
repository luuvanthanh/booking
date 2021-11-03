<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            $user = Auth::user();
            if ($user->isAdmin == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('getLogin');
            }
        } else {
            return redirect()->route('getLogin');
        }
    }
}
