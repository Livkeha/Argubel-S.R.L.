@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        

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
                    <!-- <th style="text-align: center;">Id</th> -->
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
                  <?php $idAnterior = null; ?>
                  <?php $mesAnterior = null; ?>

                  @foreach($periodoTotal as $periodoMensual => $mes)  <!-- ESTO ES CADA FECHA QUE APARECE EN LA PRIMERA COLUMNA -->
                  @foreach($cuotasReferidas as $cuotaReferida) <!-- ESTO ES CADA BALANCE QUE HAY EN LA BASE DE DATOS -->

                  <?php $cuota = $cuotaReferida; ?>

                  <?php

                  $stringDelMes = Carbon\Carbon::parse($mes)->format('m-Y');
                  $stringDelBalance = Carbon\Carbon::parse($cuota->created_at)->format('m-Y');

                  $fechaDelMes = Carbon\Carbon::createFromFormat('m-Y', $stringDelMes, 'America/Argentina/Buenos_Aires');
                  $fechaDelBalance = Carbon\Carbon::createFromFormat('m-Y', $stringDelBalance, 'America/Argentina/Buenos_Aires');


                   ?>

                  @if ($color % 2 == 0) <tr style="background-color:rgba(176,106,92,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                  @if ($color % 2 != 0) <tr style="background-color:rgba(124,88,145,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif




                    @if($fechaDelMes->lt($fechaDelBalance))  <!--  SI LA FECHA DEL MES ES ANTERIOR A LA FECHA DE BALANCE -->

                    <td style="text-align: center; vertical-align: middle;"><b>{{$mes}}</b></td>
                    <!-- <td style="text-align: center; vertical-align: middle;"><b>{{$cuota->id}}</b></td> -->
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>


                    @endif

                    @if($fechaDelMes->eq($fechaDelBalance) && $cuota->es_visible == true) <!-- SI LA FECHA DEL MES ES IGUAL A LA FECHA DE BALANCE -->

                    <td style="text-align: center; vertical-align: middle;"><b>{{$mes}}</b></td>
                    <!-- <td style="text-align: center; vertical-align: middle;"><b>{{$cuota->id}}</b></td> -->
                    <td style="text-align: center; vertical-align: middle;">  <!-- MONTO ESTABLECIDO -->

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null && $cuota->monto_pagado == null) <i class="btn btn-xs btn-warning disabled" style="color:black;">Ingrese una fecha de vencimiento</i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null && $cuota->monto_pagado == null) <i class="btn btn-xs btn-warning disabled" style="color:black;">Ingrese un pago</i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null && $cuota->monto_pagado != null) $ {{ $cuota->monto_establecido }} @endif @endrole

                    </td>

                    <td style="text-align: center; vertical-align: middle;">  <!-- FECHA DE VENCIMIENTO -->

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null && $cuota->monto_pagado == null)

                      {!! Form::open(array('route' => array('modificarFechaVencimiento', $proyectoReferido->id, $usuarioReferido->id))) !!}
                      <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                      <?php echo Form::token(); ?>

                        <?php echo Form::date('fecha_vencimiento', ""); ?>

                        @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null && $cuota->monto_pagado == null) <button class="btn btn-xs btn-primary" type="submit" name="fecha-vencimiento-agregada">Ingresar Fecha de Vencimiento</button> @endif @endrole

                        {{ Form::close() }}

                      @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null) <b> {{Carbon\Carbon::parse($cuota->fecha_vencimiento)->format('d-m-Y')}} </b> @endif @endrole

                    </td>

                    <td style="text-align: center; vertical-align: middle;">  <!-- MONTO PAGADO -->

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null || $cuota->monto_pagado == null) <i class="btn btn-xs btn-warning disabled" style="color:black;"> Ingrese una fecha de vencimiento </i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null && $cuota->monto_pagado != null)$ {{ $cuota->monto_pagado }} @endif @endrole

                    </td>

                    <td style="text-align: center; vertical-align: middle;">  <!-- FECHA PAGADO -->

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null && $cuota->monto_pagado == null)<i class="btn btn-xs btn-warning disabled" style="color:black;"> Pago aún no ingresado </i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null && $cuota->monto_pagado == null)<b> {{Carbon\Carbon::parse($cuota->fecha_pagado)->format('d-m-Y')}}</b> @endif @endrole

                    </td>


                    <td style="text-align: center; vertical-align: middle;"> <!-- BALANCE -->

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null && $cuota->monto_pagado === "0")<i class="btn btn-xs btn-warning disabled" style="color:black;"> Ingrese una fecha de vencimiento </i> @endif @endrole

                      @if($cuota->balance >= 0)
                      <span style="color:green"><b>{{$cuota->balance}}</b></span>
                      @endif

                      @if($cuota->balance < 0)
                      <span style="color:red"><b>{{$cuota->balance}}</b></span>
                      @endif


                    </td>


                    <td style="text-align: center; vertical-align: middle;"> <!-- ACCIONES -->

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento == null && $cuota->monto_pagado == null)<button class="btn btn-xs btn-warning disabled" style="color:black;">No hay acciones disponibles</button>@endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null && $cuota->monto_pagado == null)<button class="btn btn-xs btn-danger" type="submit" name="">Declarar Cuota no Pagada</button>@endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->fecha_vencimiento != null && $cuota->monto_pagado != null)<button class="btn btn-xs btn-warning disabled" style="color:black;">No hay acciones disponibles</button> @endif @endrole

                   </td>

                    <?php $color = $color + 1; ?>

                    @endif


                    @if($fechaDelMes->gt($fechaDelBalance)) <!-- SI LA FECHA DEL MES ES POSTERIOR A LA FECHA DE BALANCE -->

                    <td style="text-align: center; vertical-align: middle;"><b>{{$mes}}</b></td>
                    <!-- <td style="text-align: center; vertical-align: middle;"><b>{{$cuota->id}}</b></td> -->

                    <td style="text-align: center; vertical-align: middle;">   <!-- MONTO ESTABLECIDO -->

                      @role('Administrador') @if (Auth::check()) <i class="btn btn-xs btn-warning disabled" style="color:black;">Ingrese un pago para aplicar el valor de la cuota</i> @endif @endrole

                    </td>

                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>
                    <td style="text-align: center; vertical-align: middle;">--------------------</td>

                    @endif


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
