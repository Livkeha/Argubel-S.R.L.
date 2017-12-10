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
use View;



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

    if (Auth::check() && Auth::user()->rol == "administrador")
    {
      $usuarioReferido = DB::table('users')->where("id", "=", "$usuarioId")->first();

      return view('cambiar-password', compact('usuarioReferido'));
    }

    if(Auth::user()->rol == "cliente" && Auth::user()->primer_logueo != false)
    {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

    if(Auth::user()->rol == "cliente" && Auth::user()->primer_logueo == false)
    {
      {{dd("Está bien");}}
    }

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

    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->select('balance')->update(
      ['balance' => 0]
    );

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$idDelProyecto")->first();

    $balanceInicial = Balance::create([
      'monto_establecido' => $desarrolloAfectado->monto_establecido,
      'monto_pagado' => null,
      'user_id' => $usuarioId,
      'project_id' => $idDelProyecto,
      ]);

    Session::flash('desarrolloIngresado', "\"" . $usuarioReferido->nombre . " " . $usuarioReferido->apellido . "\" ingresó al desarrollo \"" . $desarrolloAfectado->nombre . "\" satisfactoriamente.");

    return redirect()->action('UsuariosController@verLista');

  }



  public function misCuotasBACKUP($proyectoId, $usuarioId)
  {

        if(Auth::user()->rol == "cliente" && $proyectoId != Auth::user()->project_id)
          {
            Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
            return Redirect::route('index');
          }

    $proyectoReferido = DB::table('projects')->where('id', '=', "$proyectoId")->first();

    $usuarioReferido = DB::table('users')->where('id', '=', "$usuarioId")->first();

    $cantidadCuotasReferidas = DB::table('balances')->where('project_id', '=', "$proyectoId")->where('user_id', '=', "$usuarioId")->orderBy('created_at', 'asc')->oldest()->first();  // ESTE ES EL PRIMER BALANCE DEL USUARIO (EL MAS VIEJO).

    $cuotasReferidas = DB::table('balances')->where('project_id', '=', "$proyectoId")->where('user_id', '=', "$usuarioId")->orderBy('id', 'asc')->get();

    // foreach ($cuotasReferidas as $cuota) {
    //
    //   $horaCuota = Carbon::createFromFormat('Y-m-d H:i:s', $cuota->created_at);
    //   $horaProyecto = Carbon::createFromFormat('Y-m-d H:i:s', $proyectoReferido->created_at);
    //
    //   echo "<pre>";
    //
    //   var_dump($horaProyecto, $horaCuota);
    //   var_dump($horaProyecto->diffInMinutes($horaCuota));
    //
    // }exit;


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

    View::share('proyectoId', $proyectoId);

    // return view('mi-balance')->with('periodoTotal', 'paginatedItems');
    return view('mi-balance')->with(['periodoTotal' => $paginatedItems])->with(['cuotasReferidas' => $cuotasReferidas])->with(['proyectoReferido' => $proyectoReferido])->with(['usuarioReferido' => $usuarioReferido]);



    // return $months;
    // return view('mi-balance', compact('balance', 'balances', 'proyectoReferido', 'usuarioId'));

  }








  public function crearBalance($proyectoId, $usuarioId)
  {

    if (Auth::check()) {

      if(Auth::user()->rol == "cliente" && $proyectoId != Auth::user()->project_id)
      {
        Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
        return Redirect::route('index');
      }

    }else {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

    $balanceCreado = Balance::create([
      'monto_establecido' => null,
      'monto_pagado' => null,
      'user_id' => $usuarioId,
      'project_id' => $proyectoId,
      ]);

      return redirect()->action(
        'UsuariosController@misCuotas', ['proyectoId' => $proyectoId, '$usuarioId' => $usuarioId]
      );
  }








  public function modificarFechaCuota($proyectoId, $usuarioId, $cuotaId)
  {

    $mesCuota = $_POST["mes"];

    $anioCuota = $_POST["anio"];

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->first();

    $balanceAfectado = DB::table('balances')->where("id", "=", "$cuotaId")->first();

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('mes')->update(
      ['mes' => $mesCuota]
    );

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('anio')->update(
      ['anio' => $anioCuota]
    );

      Session::flash('fechaCuotaActualizada', "La fecha de cuota ha sido actualizada correctamente.");

      return redirect()->action(
        'UsuariosController@misCuotas', ['proyectoId' => $proyectoId, '$usuarioId' => $usuarioId]
      );
  }






  public function modificarFechaVencimiento($proyectoId, $usuarioId, $cuotaId)
  {

    $diaVencimiento = $_POST["dia_vencimiento"];

    $mesVencimiento = $_POST["mes_vencimiento"];

    $anioVencimiento = $_POST["anio_vencimiento"];

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->first();

    $balanceAfectado = DB::table('balances')->where("id", "=", "$cuotaId")->first();

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('dia_vencimiento')->update(
      ['dia_vencimiento' => $diaVencimiento]
    );

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('mes_vencimiento')->update(
      ['mes_vencimiento' => $mesVencimiento]
    );

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('anio_vencimiento')->update(
      ['anio_vencimiento' => $anioVencimiento]
    );

      Session::flash('fechaVencimientoActualizada', "La fecha de vencimiento ha sido actualizada correctamente.");

      return redirect()->action(
        'UsuariosController@misCuotas', ['proyectoId' => $proyectoId, '$usuarioId' => $usuarioId]
      );
  }






  public function modificarMontoPagado($proyectoId, $usuarioId, $cuotaId)
  {

    $montoPagado = $_POST["monto_pagado"];

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->first();

    $balanceAfectado = DB::table('balances')->where("id", "=", "$cuotaId")->first();

    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->first();

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('monto_pagado')->update(
      ['monto_pagado' => $montoPagado]
    );

    $balanceAfectado = DB::table('balances')->where("id", "=", "$cuotaId")->first();

    $nuevoBalance = ($montoPagado - $balanceAfectado->monto_establecido) + ($usuarioAfectado->balance);

    $balanceUsuarioAfectado = DB::table('users')->where("project_id", "=", "$proyectoId")->where("id", "=", "$usuarioId")->select('balance')->update(
      ['balance' => $nuevoBalance]
    );

    $balanceMensualAfectado = DB::table('balances')->where("id", "=", "$cuotaId")->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->select('balance_mensual')->update(
      ['balance_mensual' => $nuevoBalance]
    );

      Session::flash('montoPagadoActualizado', "El monto pagado ha sido actualizado correctamente.");

      return redirect()->action(
        'UsuariosController@misCuotas', ['proyectoId' => $proyectoId, '$usuarioId' => $usuarioId]
      );
  }


  public function modificarFechaPagado($proyectoId, $usuarioId, $cuotaId)
  {

    $diaPagado = $_POST["dia_pagado"];

    $mesPagado = $_POST["mes_pagado"];

    $anioPagado = $_POST["anio_pagado"];

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->first();

    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->first();


    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('dia_pagado')->update(
      ['dia_pagado' => $diaPagado]
    );

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('mes_pagado')->update(
      ['mes_pagado' => $mesPagado]
    );

    $balanceAfectado = DB::table('balances')->where("project_id", "=", "$proyectoId")->where("user_id", "=", "$usuarioId")->where("id", "=", "$cuotaId")->select('anio_pagado')->update(
      ['anio_pagado' => $anioPagado]
    );

      Session::flash('fechaPagadoActualizada', "La fecha de pago ha sido actualizado correctamente.");

      return redirect()->action(
        'UsuariosController@misCuotas', ['proyectoId' => $proyectoId, '$usuarioId' => $usuarioId]
      );
  }










  public function misCuotas($proyectoId, $usuarioId)
  {

    if (Auth::check()) {

      if(Auth::user()->rol == "cliente" && $proyectoId != Auth::user()->project_id)
      {
        Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
        return Redirect::route('index');
      }

    }else {
        Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
        return Redirect::route('index');
    }

    $cuotas = DB::table('balances')->where('project_id', '=', "$proyectoId")->where('user_id', '=', "$usuarioId")->orderBy('created_at', 'asc')->first();

    if($cuotas == null && Auth::user()->rol == "cliente")
    {
      Session::flash('sinPagos', "Usted aun no registra pagos realizados.");
      return redirect()->route('miDesarrollo', ['idProyecto' => $proyectoId]);
    }

    $proyectoReferido = DB::table('projects')->where('id', '=', "$proyectoId")->first();


    $creacionDelProyecto = $proyectoReferido->created_at;

    $anioProyecto = Carbon::createFromFormat('Y-m-d H:i:s', $creacionDelProyecto)->year;

    $anioFinProyecto = $anioProyecto + 11;

    $fechaProyecto  = '01/01/' . $anioProyecto;
    $fechaFinProyecto  = '01/01/' . $anioFinProyecto;
    $format = 'd/m/Y';

    $start    = DateTime::createFromFormat($format, $fechaProyecto); // Today date   // EL START ES LA FECHA DE CREACIÓN DEL PROYECTO.

    $end      = DateTime::createFromFormat($format, $fechaFinProyecto); // Create a datetime object from your Carbon object   // EL FINAL ES UN AÑO DESPUÉS (¿O 10?).

    $interval = DateInterval::createFromDateString('1 year'); // 1 month interval  // ESTE ES EL INTERVALO, ESTÁ PERFECTO.

    $period   = new DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period // HAY QUE PAGINAR CADA 12 ELEMENTOS.

    $periodoTotal = array();

    foreach ($period as $dt) {
        $periodoTotal[] = $dt->format("Y");
    }

    for($i = 1; $i <  32; $i++)
    {
      $diasDelMes[] = $i;
    }


    $usuarioReferido = DB::table('users')->where('id', '=', "$usuarioId")->first();


    $cuotasReferidas = DB::table('balances')->where('project_id', '=', "$proyectoId")->where('user_id', '=', "$usuarioId")->orderBy('created_at', 'asc')->paginate(12);

        View::share('proyectoId', $proyectoId);

    return view('mi-balance', compact('diasDelMes', 'periodoTotal', 'cuotasReferidas', 'proyectoReferido', 'usuarioReferido', 'proyectoId', 'usuarioId'));

  }






  public function agregarCuota($proyectoId, $usuarioId, $cuotaId)
  {

    $mesCuota = $_POST["mes"];

    $anioCuota = $_POST["anio"];

    $montoEstablecido = $_POST["monto_establecido"];

    $diaVencimiento = $_POST["dia_vencimiento"];

    $mesVencimiento = $_POST["mes_vencimiento"];

    $anioVencimiento = $_POST["anio_vencimiento"];

    $montoPagado = $_POST["monto_pagado"];

    $diaPagado = $_POST["dia_pagado"];

    $mesPagado = $_POST["mes_pagado"];

    $anioPagado = $_POST["anio_pagado"];



    $usuarioAfectado = DB::table('users')->where("id", "=", "$usuarioId")->first();

    $nuevoBalance = ($montoPagado - $montoEstablecido) + ($usuarioAfectado->balance);

    $balanceAnterior = DB::table('users')->where("project_id", "=", "$proyectoId")->where("id", "=", "$usuarioId")->select('balance')->update(
      ['balance' => $nuevoBalance]
    );

    $desarrolloAfectado = DB::table('projects')->where("id", "=", "$proyectoId")->first();

    $montoEstablecidoAnterior = DB::table('projects')->where("id", "=", "$proyectoId")->select('monto_establecido')->update(
      ['monto_establecido' => $montoEstablecido]
    );

    $nuevaCuota = Balance::create([
      'mes' => $mesCuota,
      'anio' => $anioCuota,
      'monto_establecido' => $montoEstablecido,
      'dia_vencimiento' => $diaVencimiento,
      'mes_vencimiento' => $mesVencimiento,
      'anio_vencimiento' => $anioVencimiento,
      'monto_pagado' => $montoPagado,
      'dia_pagado' => $diaPagado,
      'mes_pagado' => $mesPagado,
      'anio_pagado' => $anioPagado,
      'balance_mensual' => $nuevoBalance,
      'user_id' => $usuarioId,
      'project_id' => $proyectoId,
    ]);

      Session::flash('cuotaCreada', "La cuota ha sido creada correctamente.");

      return redirect()->action(
        'UsuariosController@misCuotas', ['proyectoId' => $proyectoId, '$usuarioId' => $usuarioId]
      );
  }







  public function abandonarDesarrollo($proyectoId, $usuarioId)
  {

    // {{dd($proyectoId, $usuarioId);}}

    $usuarioAfectado = DB::table('users')->where("project_id", "=", "$proyectoId")->where("id", "=", "$usuarioId")->select('balance')->update(
      ['balance' => null]
    );

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
