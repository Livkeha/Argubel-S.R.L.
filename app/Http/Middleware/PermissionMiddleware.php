<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
use Session;

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
         // return redirect('/denegado');
         Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
         return Redirect::route('index');
     }

     if (! $request->user()->can($permission)) {
       Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
       return Redirect::route('index');
        // abort(403);
     }

     return $next($request);
 }
 
}
