<?php

namespace App\Http\Middleware;

use Closure;

class IsLoggedAsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if(!is_null($user)) {
          if($user->is_admin)
            return redirect('/admin');
        }

        return $next($request);
    }
}
