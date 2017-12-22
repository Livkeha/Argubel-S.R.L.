<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     // if (Auth::check() && Auth::user()->rol == "administrador")
     // {
     //   return redirect()->action('UsuariosController@verLista');
     // }
     //
     // if (Auth::check() && Auth::user()->rol == "cliente" && Auth::user()->primer_logueo == 1)
     // {
     //   return Redirect::route('/miDesarrollo/' . Auth::user()->project_id);
     // }

     public function redirectPath()
     {
       if (Auth::user()->rol == "administrador") {
         return "/home";
       }

       if (Auth::user()->rol == "cliente" && Auth::user()->primer_logueo == 1 && Auth::user()->project_id != null)
       {
         $idProyecto = Auth::user()->project_id;
         return '/miDesarrollo/' . "$idProyecto";
       }

       return "/home";
     }

    // protected $redirectTo = '/home';


    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
