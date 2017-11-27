<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UsuariosController extends Controller
{
  public function verLista()
  {

      $usuarios = DB::table('users')->orderBy('apellido', 'asc')->get();
      // {{dd($posts);}}

        return view('lista-usuarios', compact('usuarios'));

  }
}
