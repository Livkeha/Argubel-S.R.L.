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
      // $inversoresOcupados = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '!=', null)->get();

      $listaProyectos = [];

      foreach ($usuarios as $usuario) {
        $nombreProyecto = DB::table('projects')->where("id", "=", "$usuario->project_id")->value('nombre');
        $listaProyectos[$usuario->project_id] = ($nombreProyecto);
      }

      // $proyectosUsers = $usuarios->project_id;

      // $proyectos = DB::table('projects')->where()
      // {{dd($posts);}}

        return view('lista-usuarios', compact('usuarios', 'listaProyectos'));

  }
}
