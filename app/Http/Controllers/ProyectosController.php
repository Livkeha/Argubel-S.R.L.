<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Redirect;
use Session;
use DB;

class ProyectosController extends Controller
{

  public function verLista()
  {

      $proyectos = DB::table('projects')->orderBy('nombre', 'asc')->get();
      $inversores = DB::table('users')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();

      // {{dd($inversores->all());}}

      if($proyectos->first() == null)
      {
        // {{dd("No hay nada, está bien");}}
        return redirect()->route('index');
      } else {
        return view('lista-proyectos', compact('proyectos', 'inversores'));
      }
    }

    public function agregarInversor($proyectoId)
    {
      $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();
      $proyectoReferido = DB::table('projects')->where('id', "=", "$proyectoId")->first();

      $proyectos = DB::table('projects')->orderBy('nombre', 'asc')->get();
      $inversores = DB::table('users')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();

      if ($inversoresNuevos->all() == null) {
        return view('lista-proyectos', compact('proyectos', 'inversores'));
      }

      // {{dd($inversoresNuevos->all());}}

      return view('agregarInversor', compact('inversoresNuevos', 'proyectoReferido'));
    }

    public function validarInversorAgregado(Request $request)
    {

      // {{dd($idProyecto);}}
      // {{dd($request->all());}}

      foreach ($request->all() as $key => $value) {

        $hayInversor = substr_compare("inversor", $key, 0, 8);

        if($hayInversor == 0)
        {
          break;
        }

      }

      if($hayInversor != 0) {

        $errors = [];

        $errors['sinInversor'] = ("Debe seleccionar al menos un inversor.");

        return back()->withErrors($errors);
        // return Redirect::route('agregarInversor/' . $idProyecto)->withErrors($errors);

    }

    $inversorAgregado = $request->all();

    return $this->inversorAgregado($inversorAgregado);

  }

  public function inversorAgregado($inversorAgregado)
  {



      $idProyecto = $inversorAgregado["idProyecto"];

      foreach ($inversorAgregado as $inversor => $idInversor) {  // ESTE VALUE ES EL ID DEL USUARIO QUE VA A TENER EL PROYECTO

      // var_dump($inversor, $idInversor);

      $hayInversor = substr_compare("inversor", $inversor, 0, 8);

      var_dump($inversor, $hayInversor);

      if($hayInversor == 0)
      {
        $inversores = DB::table('users')->where("id", "=", "$idInversor")->select("project_id")->update( ['project_id' => $idProyecto] );
      }
  }

  $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();
  $proyectoReferido = DB::table('projects')->where('id', "=", "$idProyecto")->first();

  $proyectoActualizado = ("El proyecto \"" . $proyectoReferido->nombre .  "\" se ha actualizado correctamente.");

  Session::flash('proyectoActualizado', "El proyecto \"" . $proyectoReferido->nombre .  "\" se ha actualizado correctamente.");

  return back()->with('inversoresNuevos', 'proyectoReferido', 'proyectoActualizado');
  // return view('agregarInversor', compact('inversoresNuevos', 'proyectoReferido'));

  }
}
