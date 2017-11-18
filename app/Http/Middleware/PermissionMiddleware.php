<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

 public function handle($request, Closure $next, $permission)
 {
     // if (Auth::guest()) {
     //     return redirect('/login');
     // }

     if (Auth::guest()) {
         return redirect('/index');
     }

     if (! $request->user()->can($permission)) {
       return redirect('/index');
        // abort(403);
     }

     return $next($request);
 }
}
