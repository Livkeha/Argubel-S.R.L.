<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Balance;
use DB;
use Session;
use Auth;
use Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use DateTime;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;



class UsuariosController extends Controller
{

  public function verLista()
  {

      $usuarios = DB::table('users')->orderBy('apellido', 'asc')->get();
      $totalProyectos = DB::table('projects')->orderBy('nombre', 'asc')->get();

      $listaProyectos = [];

      foreach ($usuarios as $usuario) {
        $nombreProyecto = DB::table('projects')->where("id", "=", "$usuario->project_id")->value('nombre');
        $listaProyectos[$usuario->project_id] = ($nombreProyecto);
      }

        return view('lista-usuarios', compact('usuarios', 'listaProyectos', 'totalProyectos'));

  }

  public function cambiarPassword($usuarioId)
  {

    $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

    return view('cambiar-password', compact('usuarioReferido'));
  }

  public function passwordModificada($usuarioId)
  {

    $nuevoPassword = $_POST["password"];

    $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->select('password')->update(
      ['password' => bcrypt($nuevoPassword)]
    );

    Session::flash('passwordModificada', "La contraseña de \"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" ha sido modificada satisfactoriamente.");

    return redirect()->action('UsuariosController@verLista');
  }

  public function ingresarEnDesarrollo($usuarioId)
  {

    $idDelProyecto = $_POST["desarrollo"];

    $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->select('project_id')->update(
      ['project_id' => $idDelProyecto]
    );

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$idDelProyecto")->first();

    $balanceInicial = Balance::create([
      'monto_establecido' => $desarrolloAfectado->monto_establecido,
      'monto_pagado' => null,
      'fecha_pagado' => null,
      'balance' => 0,
      'user_id' => $usuarioId,
      'project_id' => $idDelProyecto,
      ]);

    Session::flash('desarrolloIngresado', "\"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" ingresó al desarrollo \"" . $desarrolloAfectado->nombre . "\" satisfactoriamente.");

    return redirect()->action('UsuariosController@verLista');

  }



  public function misCuotas($proyectoId, $usuarioId)
  {

    $proyectoReferido = DB::table('projects')->where('id', '=', "$proyectoId")->first();

    $creacionDelProyecto = $proyectoReferido->created_at;

    $anioProyecto = Carbon::createFromFormat('Y-m-d H:i:s', $creacionDelProyecto)->year;

    $anioFinProyecto = $anioProyecto + 11;

    $fechaProyecto  = '01/01/' . $anioProyecto;
    $fechaFinProyecto  = '01/01/' . $anioFinProyecto;
    $format = 'd/m/Y';

    $date = DateTime::createFromFormat($format, $fechaProyecto);   // LO DE ARRIBA PUEDE LLEGAR A SERVIR PARA PASAR COMO VARIABLE EL AÑO CORRESPONDIENTE.



    $firstDayOfYear = Carbon::now()->startOfYear()->format('d/m/Y');  // ES EL PRIMER DÍA DEL AÑO, RECUPERAR EL MES Y USARLO COMO PRIMER ELEMENTO DELPAGINADOR.

    $example = Carbon::createFromDate($anioProyecto, 1, 1); // ¡¡ESTE ES EL START DEL PROYECTO!! HAY QUE EXTRAERLO DEL CREATED_AT Y PASARLO COMO PARAMETRO ACÁ Y DESPUÉS PASARLO A $START.



    $start    = DateTime::createFromFormat($format, $fechaProyecto); // Today date   // EL START ES LA FECHA DE CREACIÓN DEL PROYECTO.

    $end      = DateTime::createFromFormat($format, $fechaFinProyecto); // Create a datetime object from your Carbon object   // EL FINAL ES UN AÑO DESPUÉS (¿O 10?).

    $interval = DateInterval::createFromDateString('1 month'); // 1 month interval  // ESTE ES EL INTERVALO, ESTÁ PERFECTO.

    $period   = new DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period // HAY QUE PAGINAR CADA 12 ELEMENTOS.

    $periodoTotal = array();

    foreach ($period as $dt) {
        $periodoTotal[] = $dt->format("F Y");
    }

    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    $itemCollection = collect($periodoTotal);

    $perPage = 12;

    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

    $paginatedItems = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

    $paginatedItems->setPath('/misCuotas/' . $proyectoId . '/' . $usuarioId);

    return view('mi-balance', ['periodoTotal' => $paginatedItems]);

    // return $months;

    // return $months;
    // return view('mi-balance', compact('balance', 'balances', 'proyectoReferido', 'usuarioId'));

  }


  public function misCuotasBACKUP($proyectoId, $usuarioId)
  {

    if(Auth::user()->rol == "cliente" && $proyectoId != Auth::user()->project_id)
      {
        Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
        return Redirect::route('index');
      }

    $cuotas = DB::table('balances')->where('project_id', '=', "$proyectoId")->where('user_id', '=', "$usuarioId")->orderBy('fecha_pagado', 'asc')->first();

    if($cuotas == null && Auth::user()->rol == "cliente")
    {
      Session::flash('sinPagos', "Usted aun no registra pagos realizados.");
      return redirect()->route('miDesarrollo', ['idProyecto' => $proyectoId]);
    }

    $proyectoReferido = DB::table('projects')->where('id', '=', "$proyectoId")->first();

    $balance = DB::table('balances')->where('project_id', '=', "$proyectoId")->where('user_id', '=', "$usuarioId")->orderBy('fecha_pagado', 'asc')->paginate(1);

    return view('mi-balance', compact('balance', 'proyectoReferido', 'usuarioId'));

  }

  public function abandonarDesarrollo($proyectoId, $usuarioId)
  {

    // {{dd($proyectoId, $usuarioId);}}

    $usuarioAfectado = DB::table('users')->where("project_id", "=", "$proyectoId")->where("id", "=", "$usuarioId")->select('project_id')->update(
      ['project_id' => null]
    );

    $usuarioReferido = DB::table('users')->where('id', "=", "$usuarioId")->first();

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->value('nombre');

    $balancesComprometidos = DB::table('balances')->where('user_id', '=', "$usuarioId")->get();

    if($balancesComprometidos != null) {

      $balancesComprometidos = DB::table('balances')->where('user_id', '=', "$usuarioId")->delete();

    }

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

      $balancesComprometidos = DB::table('balances')->where('user_id', '=', "$usuarioId")->get();

      if($balancesComprometidos != null) {

        $balancesComprometidos = DB::table('balances')->where('user_id', '=', "$usuarioId")->delete();

      }

    $usuarioEliminado = DB::table('users')->where("id", "=", "$usuarioId")->delete();

    return redirect()->action('UsuariosController@verLista');

  }

}
