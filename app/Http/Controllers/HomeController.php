<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {

       if (Auth::check() && Auth::user()->project_id != null && Auth::user()->primer_logueo != false) {

         $nombreProyecto = strtoupper(DB::table('projects')->where("id", "=", Auth::user()->project_id)->value('nombre'));

         return view('index', compact('nombreProyecto'));

       }

       if(Auth::check() && Auth::user()->primer_logueo == false && Auth::user()->rol == "cliente")
       {
         $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

         return view('cambiar-password', compact('usuarioReferido'));
       }

       return view('index');
     }


    public function view()
    {
        return view('index');
    }
}
