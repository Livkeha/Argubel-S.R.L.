<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Session;

class UsuariosController extends Controller
{

  public function verLista()
  {

      $usuarios = DB::table('users')->orderBy('apellido', 'asc')->get();
      $totalProyectos = DB::table('projects')->orderBy('nombre', 'asc')->get();

      // {{dd($totalProyectos);}}

      // $inversoresOcupados = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '!=', null)->get();

      $listaProyectos = [];

      foreach ($usuarios as $usuario) {
        $nombreProyecto = DB::table('projects')->where("id", "=", "$usuario->project_id")->value('nombre');
        $listaProyectos[$usuario->project_id] = ($nombreProyecto);
      }

      // $proyectosUsers = $usuarios->project_id;

      // $proyectos = DB::table('projects')->where()
      // {{dd($posts);}}

        return view('lista-usuarios', compact('usuarios', 'listaProyectos', 'totalProyectos'));

  }

  public function ingresarEnDesarrollo($usuarioId)
  {

    $idDelProyecto = $_POST["desarrollo"];

    // {{dd($usuarioId, $idDelProyecto);}}

    $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->select('project_id')->update(
      ['project_id' => $idDelProyecto]
    );

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$idDelProyecto")->value('nombre');

    Session::flash('desarrolloIngresado', "\"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" ingresó al desarrollo \"" . $desarrolloAfectado . "\" satisfactoriamente.");

    return redirect()->action('UsuariosController@verLista');

  }

  public function abandonarDesarrollo($proyectoId, $usuarioId)
  {

    // {{dd($proyectoId, $usuarioId);}}

    $usuarioAfectado = DB::table('users')->where("project_id", "=", "$proyectoId")->where("id", "=", "$usuarioId")->select('project_id')->update(
      ['project_id' => null]
    );

    $usuarioReferido = DB::table('users')->where('id', "=", "$usuarioId")->first();

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->value('nombre');

    // {{dd($usuarioReferido->nombre);}}

    Session::flash('usuarioActualizado', "\"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" abandonó el desarrollo \"" . $desarrolloAfectado . "\" satisfactoriamente.");

    return redirect()->action('UsuariosController@verLista');
    // {{dd($usuarioReferido);}}
  }

  public function eliminarInversor($usuarioId)
  {

    $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

    foreach($usuarioReferido as $clave => $valor) {

    if($valor == "cliente") {
      Session::flash('usuarioEliminado', "El inversor \"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" ha sido eliminado satisfactoriamente.");
    }

    if($valor == "administrador") {
      Session::flash('usuarioEliminado', "El administrador \"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" ha sido eliminado satisfactoriamente.");
    }

  }

    $usuarioEliminado = DB::table('users')->where("id", "=", "$usuarioId")->delete();

    return redirect()->action('UsuariosController@verLista');

  }

}
