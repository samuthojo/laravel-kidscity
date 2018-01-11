<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsLoggedAsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
     public function handle($request, Closure $next, $guard = null)
     {

         if (Auth::guard($guard)->check()) {
           if($request->user()->is_admin) {
             //User is an admin
             return $next($request);
           }
         }

        return redirect()->route('cms_login');

     }
}
