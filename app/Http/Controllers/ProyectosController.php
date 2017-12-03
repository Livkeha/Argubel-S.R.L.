<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Redirect;
use Session;
use DB;
use File;
use Auth;

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

        Session::flash('sinDesarrollo', "No se encuentran desarrollos guardados.");

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

      // var_dump($inversor, $hayInversor);

      if($hayInversor == 0)
      {
        $inversores = DB::table('users')->where("id", "=", "$idInversor")->select("project_id")->update( ['project_id' => $idProyecto] );
      }
  }

  $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();
  $proyectoReferido = DB::table('projects')->where('id', "=", "$idProyecto")->first();

  $proyectoActualizado = ("El desarrollo \"" . $proyectoReferido->nombre .  "\" se ha actualizado correctamente.");

  Session::flash('proyectoActualizado', "El desarrollo \"" . $proyectoReferido->nombre .  "\" se ha actualizado correctamente.");

  // return back()->with('inversoresNuevos', 'proyectoReferido', 'proyectoActualizado');

  return redirect()->action('ProyectosController@verLista');


  }

  public function miDesarrollo($idProyecto)
  {

    $nombreProyecto = DB::table('projects')->where('id', "=", "$idProyecto")->first();

    $proyectoReferido = DB::table('projects')->where('nombre', "=", "$nombreProyecto->nombre")->first();

    if(Auth::user()->rol != "administrador" && $proyectoReferido == null || Auth::user()->rol == "cliente" && $proyectoReferido->id != Auth::user()->project_id)
    {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

      return view('mi-desarrollo', compact('proyectoReferido'));

  }

  public function fotosMiDesarrollo($idProyecto)
  {

    // {{dd($idProyecto);}}

    $nombreProyecto = DB::table('projects')->where('id', "=", "$idProyecto")->first();

    // {{dd($nombreProyecto);}}

    $proyectoReferido = DB::table('projects')->where('nombre', "=", "$nombreProyecto->nombre")->first();

    // {{dd($proyectoReferido);}}

    $existePresentacion = public_path('imagenesDesarrollos/' . $proyectoReferido->nombre . "/" . 'Presentacion.jpeg');
    $existeUbicacion = public_path('imagenesDesarrollos/' . $proyectoReferido->nombre . "/" . 'Ubicacion.jpeg');

    if(Auth::user()->rol != "administrador" && $proyectoReferido == null || Auth::user()->rol == "cliente" && $proyectoReferido->id != Auth::user()->project_id)
    {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

    $buscarFotos = scandir('imagenesDesarrollos/' . $proyectoReferido->nombre . '/Fotos');

    $fotosProyecto = [];

    $cantidadFotos = 0;

    foreach($buscarFotos as $foto)
    {

      if ($foto == "." || $foto == ".." || $foto == "Presentacion.jpeg" || $foto == "Ubicacion.jpeg") {
        continue;
      } else {
        $cantidadFotos = $cantidadFotos + 1;
        array_push($fotosProyecto, $foto);
      }

    }

      return view('fotos-mi-desarrollo', compact('proyectoReferido', 'fotosProyecto', 'cantidadFotos', 'existePresentacion', 'existeUbicacion'));

  }

  public function eliminarFoto($idProyecto, $foto)
  {

    $limpiarFoto = explode(".", $foto);

    $nombreFoto = $limpiarFoto['0'];

    // {{dd($nombreFoto);}}

    $fotoReferida = DB::table('project_pictures')->where('nombre', "=", "$nombreFoto")->where('project_id', '=', "$idProyecto")->first();

    $nombreProyecto = DB::table('projects')->where('id', "=", "$idProyecto")->first();

    // {{dd($nombreProyecto);}}

    if(Auth::user()->rol != "administrador" && $fotoReferida == null || Auth::user()->rol == "cliente" && $fotoReferida->id != Auth::user()->project_id)
    {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

    $fotoReferida = DB::table('project_pictures')->where('nombre', "=", "$nombreFoto")->where('project_id', '=', "$idProyecto")->delete();

    $eliminarArchivos = File::delete(public_path('imagenesDesarrollos/' . $nombreProyecto->nombre . "/" . 'Fotos/' . $foto));

    Session::flash('fotoEliminada', "La foto seleccionada ha sido eliminada correctamente.");

    return redirect()->action(
    'ProyectosController@fotosMiDesarrollo', ['idProyecto' => $nombreProyecto->id]
    );

  }



  public function planosMiDesarrollo($idProyecto)
  {

    $nombreProyecto = DB::table('projects')->where('id', "=", "$idProyecto")->first();

    $proyectoReferido = DB::table('projects')->where('nombre', "=", "$nombreProyecto->nombre")->first();

    if(Auth::user()->rol != "administrador" && $proyectoReferido == null || Auth::user()->rol == "cliente" && $proyectoReferido->id != Auth::user()->project_id)
    {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

    $buscarPlanos = scandir('imagenesDesarrollos/' . $proyectoReferido->nombre . '/Planos');

    $planosProyecto = [];

    $cantidadPlanos = 0;

    foreach($buscarPlanos as $plano)
    {

      if ($plano == "." || $plano == "..") {
        continue;
      } else {
        $cantidadPlanos = $cantidadPlanos + 1;
        array_push($planosProyecto, $plano);
      }

    }

      return view('planos-mi-desarrollo', compact('proyectoReferido', 'planosProyecto', 'cantidadPlanos'));

  }


    public function eliminarPlano($idProyecto, $plano)
    {

      $limpiarPlano = explode(".", $plano);

      $nombrePlano = $limpiarPlano['0'];

      $planoReferido = DB::table('project_blueprints')->where('nombre', "=", "$nombrePlano")->where('project_id', '=', "$idProyecto")->first();

      $nombreProyecto = DB::table('projects')->where('id', "=", "$idProyecto")->first();

      if(Auth::user()->rol != "administrador" && $planoReferido == null || Auth::user()->rol == "cliente" && $planoReferido->id != Auth::user()->project_id)
      {
        Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
        return Redirect::route('index');
      }

      $planoReferido = DB::table('project_blueprints')->where('nombre', "=", "$nombrePlano")->where('project_id', '=', "$idProyecto")->delete();

      $eliminarArchivos = File::delete(public_path('imagenesDesarrollos/' . $nombreProyecto->nombre . "/" . 'Planos/' . $plano));

      Session::flash('planoEliminado', "El plano seleccionado ha sido eliminado correctamente.");

      return redirect()->action(
      'ProyectosController@planosMiDesarrollo', ['idProyecto' => $nombreProyecto->id]
      );

    }

  public function eliminarDesarrollo($proyectoId)
  {

    $proyectoReferido = DB::table('projects')->where('id', "=", "$proyectoId")->first();

    $inversoresComprometidos = DB::table('users')->where('project_id', '=', "$proyectoReferido->id")->get();

    if($inversoresComprometidos != null) {

      $inversoresComprometidos = DB::table('users')->where('project_id', '=', "$proyectoReferido->id")->select('project_id')->update(
        ['project_id' => null]
      );

    }

    $fotosComprometidas = DB::table('project_pictures')->where('project_id', '=', "$proyectoReferido->id")->get();

    if($fotosComprometidas != null) {

      $fotosComprometidas = DB::table('project_pictures')->where('project_id', '=', "$proyectoReferido->id")->delete();

    }

    $planosComprometidos = DB::table('project_blueprints')->where('project_id', '=', "$proyectoReferido->id")->get();

    if($planosComprometidos != null) {

      $planosComprometidos = DB::table('project_blueprints')->where('project_id', '=', "$proyectoReferido->id")->delete();

    }

    $eliminarArchivos = File::deleteDirectory(public_path('imagenesDesarrollos/' . $proyectoReferido->nombre));

    Session::flash('desarrolloEliminado', "El desarrollo \"". $proyectoReferido->nombre . "\" ha sido eliminado correctamente.");

    $eliminarDesarrollo = DB::table('projects')->where('id', "=", "$proyectoId")->delete();

    return redirect()->action('ProyectosController@verLista');

  }

}
