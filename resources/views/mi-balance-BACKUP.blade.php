@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

          {{-- dd($cuotasReferidas) --}}

        {{-- @if ($balance->first() != null) --}}

        {{--  dd($cuotas->all()) --}}

        @if (Session::has('proyectoActualizado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('proyectoActualizado') }}</h2>
        @endif

        @if (Session::has('montoEstablecidoModificado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('montoEstablecidoModificado') }}</h2>
        @endif

        @if (Session::has('fechaVencimientoActualizada'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fechaVencimientoActualizada') }}</h1>
        @endif

        {{-- {{dd($proyectoReferido)}} --}}

        <h2 class="form-titulo" style="color: blue; text-align:center;">Balance - Desarrollo: {{ $proyectoReferido->nombre }}</h2>

      <h4 style="color: red; text-align:center;"><b>Valor de la cuota establecido al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: ${{ $proyectoReferido->monto_establecido }}.</b></h4>

        <div class="container" style="height:502px; width:100%;">
          <div class="responsive-table">

            {{  $periodoTotal->links('paginador-balance') }}

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>

                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Valor de Cuota</th>
                    <th style="text-align: center;">Fecha de Vencimiento</th>
                    <th style="text-align: center;">Monto Pagado</th>
                    <th style="text-align: center;">Fecha Pagado</th>
                    <th style="text-align: center;">Balance</th>
                    @role('Administrador') @if (Auth::check()) <th style="text-align: center;">Acciones</th> @endif @endrole
                  <tr>
                </thead>

                <tbody>
                  <?php $color = 0; ?>
                  <?php $balanceAnterior = null; ?>

                  @foreach($periodoTotal as $periodoMensual => $mes)  <!-- ESTO ES CADA FECHA QUE APARECE EN LA PRIMERA COLUMNA -->

                  @foreach($cuotasReferidas as $cuotaReferida) <!-- ESTO ES CADA BALANCE QUE HAY EN LA BASE DE DATOS -->
                  <?php $cuota = $cuotaReferida; ?>

                  <?php

                  $stringDelMes = Carbon\Carbon::parse($mes)->format('m-Y');
                  $stringDelBalance = Carbon\Carbon::parse($cuota->created_at)->format('m-Y');

                  $fechaDelMes = Carbon\Carbon::createFromFormat('m-Y', $stringDelMes, 'America/Argentina/Buenos_Aires');
                  $fechaDelBalance = Carbon\Carbon::createFromFormat('m-Y', $stringDelBalance, 'America/Argentina/Buenos_Aires');


                  // {{dd($fechaDelBalance->gt($fechaDelMes));}}

                   ?>

                  @if ($color % 2 == 0) <tr style="background-color:rgba(176,106,92,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                  @if ($color % 2 != 0) <tr style="background-color:rgba(124,88,145,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif


                    @if($fechaDelMes->lt($fechaDelBalance)) <!-- SI LA FECHA DEL MES ES ANTERIOR A LA FECHA DE BALANCE -->

                    <td style="text-align: center; vertical-align: middle;"><b>{{$mes}}</b></td>
                    <td style="text-align: center; vertical-align: middle;"><b>{{$cuota->id}}</b></td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>

                    @endif


                  @if($fechaDelMes->eq($fechaDelBalance)) <!-- SI LA FECHA DEL MES ES IGUAL A LA FECHA DEL BALANCE -->


                  <td style="text-align: center;"><b>{{$mes}}</b></td>
                  <td style="text-align: center; vertical-align: middle;"><b>{{$cuota->id}}</b></td>
                  <td style="text-align: center;">$ {{ $cuota->monto_establecido  }}</td>
                  <td style="text-align: center;">Fecha de vencimiento.</td>
                  <td style="text-align: center;">Monto pagado.</td>
                  <td style="text-align: center;">Fecha de pagado.</td>
                  <td style="text-align: center;">Balance.</td>
                  <td style="text-align: center;"><button class="btn btn-xs btn-warning disabled" style="color:black;">No hay acciones disponibles</button> </td>


                  @endif


                  @if($fechaDelMes->gt($fechaDelBalance)) <!-- SI LA FECHA DEL MES ES POSTERIOR A LA FECHA DE BALANCE -->


                  <td style="text-align: center; vertical-align: middle;"><b>{{$mes}}</b></td>
                  <td style="text-align: center; vertical-align: middle;"><b>{{$cuota->id}}</b></td>
                  <td style="text-align: center; vertical-align: middle;">@if(isset($cuota->fecha_vencimiento)) {{ $cuota->monto_establecido }} @endif</td>
                  <td style="text-align: center; vertical-align: middle;">

                    {!! Form::open(array('route' => array('modificarFechaVencimiento', $proyectoReferido->id, $usuarioReferido->id))) !!}
                    <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                    <?php echo Form::token(); ?>




                    @if ($balanceAnterior == '')

                    @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null) <?php echo Form::date('fecha_vencimiento', ""); ?> @endif @endrole
                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null) <button class="btn btn-xs btn-primary" type="submit" name="fecha-vencimiento-agregada">Ingresar Fecha de Vencimiento</button> @endif @endrole

                    @else

                    @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null) {{ $cuota->fecha_vencimiento }} @endif @endrole
                    @role('Administrador') @if (Auth::check() && $balanceAnterior == '') <button class="btn btn-xs btn-warning disabled" style="color:black;">Ingrese vencimientos anteriores.</button> @endif @endrole



                    @endif




                    {{ Form::close() }}



                  </td>
                  <td style="text-align: center; vertical-align: middle;">

                    {!! Form::open(array('route' => array('ingresarEnDesarrollo', $usuarioReferido->id))) !!}
                    <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                    <?php echo Form::token(); ?>


                    @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null) <input class="form-control" type='number' name="monto-pagado" required> @endif @endrole

                    @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null) <input class="form-control" type='number' name="monto-pagado" disabled> @endif @endrole

                    @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null)<button class="btn btn-xs btn-success" type="submit" name="pago-agregado">Ingresar Pago</button> @endif @endrole

                    @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null)<button class="btn btn-xs btn-success disabled" type="submit" name="pago-agregado">Ingresar Pago</button><br><span style="font-size: 0.8em; color:red">Debe ingresar una fecha de vencimiento.</span> @endif @endrole

                    {{ Form::close() }}


                   </td>

                  <td style="text-align: center; vertical-align: middle;">Fecha de Pagado.</td>
                  <td style="text-align: center; vertical-align: middle;">Balance.</td>
                  <td style="text-align: center; vertical-align: middle;">



                    <!-- @role('Administrador') @if (Auth::check())<a class="btn btn-xs btn-success" href="">Ingresar Pago</a> @endif @endrole -->
                    <!-- @role('Administrador') @if (Auth::check())<a class="btn btn-xs btn-primary" href="">Ingresar Fecha de Vencimiento</a> @endif @endrole -->

                    @if ($balanceAnterior == '' && $cuota->fecha_vencimiento == null)


                    @role('Administrador') @if (Auth::check())<button class="btn btn-xs btn-danger disabled" type="submit" name="">Declarar Cuota no Pagada</button><br><span style="font-size: 0.8em; color:red">Debe ingresar una fecha de vencimiento.</span> @endif @endrole

                    @elseif($balanceAnterior == '' && $cuota->fecha_vencimiento != null)

                    @role('Administrador') @if (Auth::check())<a class="btn btn-xs btn-danger" href="">Declarar Cuota no Pagada</a> @endif @endrole

                    @endif

                    <?php var_dump($cuota->id); ?>

                    <?php    $balanceAnterior = "1"; ?>

                  </td>
                  @endif


                  {{-- dd (Carbon\Carbon::parse($mes)->format('m-Y') ) --}} <!-- ESTE ES EL MES DE CADA FILA DE LA TABLA -->

                  {{-- dd (Carbon\Carbon::parse($cuota->created_at)->format('m-Y') ) --}}  <!-- ESTE ES EL MES DE CADA CUOTA -->




                    <tr>
                      <?php $color = $color + 1; ?>
                      @endforeach
                      @endforeach
                </tbody>
            </table>
            {{  $periodoTotal->links('paginador-balance') }}
            {{--  $months->render() --}}
            {{-- $proyectos->links() --}}
            {{-- {{ $proyectos->render() }} --}}
          </div>
        </div>

    {{--  @endif --}}
      @endif
      </section>

@endsection
