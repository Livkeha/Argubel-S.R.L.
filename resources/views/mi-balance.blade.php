@extends('layout.headerAndFooter')
@section('contenido')





        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
          $("#agregar-pago").click(function(){
            $(".ocultar").toggle();
          });
        });
      </script>

        <section class="postsPaginados">

        @if (Session::has('proyectoActualizado'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('proyectoActualizado') }}!</strong>
						</h4>
					</div>
           {{-- <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('proyectoActualizado') }}</h2> --}}
        @endif

        @if (Session::has('montoEstablecidoModificado'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('montoEstablecidoModificado') }}!</strong>
						</h4>
					</div>
           {{-- <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('montoEstablecidoModificado') }}</h2> --}}
        @endif

        @if (Session::has('fechaCuotaActualizada'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('fechaCuotaActualizada') }}!</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fechaCuotaActualizada') }}</h1> --}}
        @endif

        @if (Session::has('fechaVencimientoActualizada'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('fechaVencimientoActualizada') }}!</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fechaVencimientoActualizada') }}</h1> --}}
        @endif

        @if (Session::has('montoPagadoActualizado'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('montoPagadoActualizado') }}!</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('montoPagadoActualizado') }}</h1> --}}
        @endif

        @if (Session::has('fechaPagadoActualizada'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('fechaPagadoActualizada') }}!</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fechaPagadoActualizada') }}</h1> --}}
        @endif

        @if (Session::has('cuotaCreada'))
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('cuotaCreada') }}!</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('cuotaCreada') }}</h1> --}}
        @endif

				<h2 class="margen-50" style="padding-top: 10px; text-align:center;"><span class="label label-primary">Balance - Desarrollo: {{ $proyectoReferido->nombre }}</span></h2>
        {{-- <h2 class="form-titulo" style="color: blue; text-align:center;">Balance - Desarrollo: {{ $proyectoReferido->nombre }}</h2> --}}

				<div class="col col-md-4 margen-50" style="margin-bottom: 20px;">
					<h4 style="padding-top: 10px;"><span class="label label-default">Inversor: {{ $usuarioReferido->nombre }} {{ $usuarioReferido->apellido }} - {{ $usuarioReferido->documento }}</span></h4>
					{{-- <h2 class="form-titulo" style="color: green; text-align:center;">Inversor: {{ $usuarioReferido->nombre }} {{ $usuarioReferido->apellido }} - {{ $usuarioReferido->documento }}</h2> --}}
				</div>
				<div class="col col-md-4 margen-50" style="margin-bottom: 20px;">
					<h4 style="padding-top: 10px; text-align: right;"><span class="label label-danger">Valor de la proxima cuota: ${{ $proyectoReferido->monto_establecido }}</span></h4>
					{{-- <h4 style="color: red; text-align:center;"><b>Valor de la cuota establecido al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: ${{ $proyectoReferido->monto_establecido }}.</b></h4> --}}
				</div>


      @foreach($cuotasReferidas as $cuota)
      @if(count($cuotasReferidas) >= 1 && $cuota->anio_pagado != null)

      @role('Administrador')

      @if($usuarioReferido->balance > 0)
				<div class="col col-md-4 margen-50" style="margin-bottom: 20px;">
					<h4 style="padding-top: 10px; text-align: center;"><span class="label label-success">Balance actual del inversor: {{abs($usuarioReferido->balance)}}</span></h4>
      	{{-- <h5 style="color: blue; text-align:center;"><b>Balance actual del inversor: <b style="color: green; text-align:center;">${{abs($usuarioReferido->balance)}}.</b></b></h5> --}}
			</div>
      <?php break; ?>
      @endif

      @if($usuarioReferido->balance == 0)
				<div class="col col-md-4 margen-50">
					<h4 style="padding-top: 10px; text-align: center;"><span class="label label-primary">Balance actual del inversor: {{abs($usuarioReferido->balance)}}</span></h4>
      	{{-- <h5 style="color: blue; text-align:center;"><b>Balance actual del inversor: <b style="color: blue; text-align:center;">${{abs($usuarioReferido->balance)}}.</b></b></h5> --}}
			</div>
      <?php break; ?>
      @endif

      @if($usuarioReferido->balance < 0)
				<div class="col col-md-4 margen-50">
					<h4 style="padding-top: 10px; text-align: center;"><span class="label label-warning">Balance actual del inversor: {{abs($usuarioReferido->balance)}}</span></h4>
      	{{-- <h5 style="color: blue; text-align:center;"><b>Balance actual del inversor: <b style="color: red; text-align:center;">- ${{abs($usuarioReferido->balance)}}.</b></b></h5> --}}
			</div>
      <?php break; ?>
      @endif

      @endrole

      @role('Cliente')

      @if($usuarioReferido->balance > 0)
				<div class="col col-md-4 margen-50">
					<h4 style="padding-top: 10px; text-align: center;"><span class="label label-success">Su balance actual al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: ${{abs($usuarioReferido->balance)}}</span></h4>
      {{-- <h5 style="color: blue; text-align:center;"><b>Su balance actual al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: <b style="color: green; text-align:center;">${{abs($usuarioReferido->balance)}}.</b></b></h5> --}}
				</div>
      <?php break; ?>
      @endif

      @if($usuarioReferido->balance == 0)
				<div class="col col-md-4 margen-50">
					<h4 style="padding-top: 10px; text-align: center;"><span class="label label-primary">Su balance actual al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: ${{abs($usuarioReferido->balance)}}</span></h4>
      {{-- <h5 style="color: blue; text-align:center;"><b>Su balance actual al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: <b style="color: blue; text-align:center;">${{abs($usuarioReferido->balance)}}.</b></b></h5> --}}
				</div>
      <?php break; ?>
      @endif

      @if($usuarioReferido->balance < 0)<div class="col col-md-4 margen-50">
				<h4 style="padding-top: 10px; text-align: center;"><span class="label label-warning">Su balance actual al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: ${{abs($usuarioReferido->balance)}}</span></h4>
      {{-- <h5 style="color: blue; text-align:center;"><b>Su balance actual al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: <b style="color: red; text-align:center;">- ${{abs($usuarioReferido->balance)}}.</b></b></h5> --}}
			</div>
      <?php break; ?>
      @endif

      @endrole

      @endif
      @endforeach

      @if (auth()->user()->isAdministrator())

      @foreach($cuotasReferidas as $cuota)
      @if(count($cuotasReferidas) >= 1 && $cuota->anio_pagado != null)
      <button type="button" name="button" class="btn btn-md btn-primary margen-50" id="agregar-pago">Nueva Cuota</button>
      <?php break; ?>
      @endif
      @endforeach

      @endif


        <div class="container margen-50" style="height:502px; width:100%;">
          <div class="responsive-table">


            @role('Cliente')
            @if($cuotasReferidas->first()->anio_pagado == null)
							<div class="alert alert-info margen-100" role="alert">
								<h4>
									<span class="glyphicon glyphicon-ban-circle color-rojo" aria-hidden="true"></span>
									<strong>No se registran pagos realizados</strong>
								</h4>
							</div>
            {{-- <h1>No se registran pagos realizados.</h1> --}}
            @endif
            @endrole

            @if($cuotasReferidas->all() != null && auth()->user()->isAdministrator() || auth()->user()->isClient() && $cuotasReferidas->first()->anio_pagado != null)



            {{  $cuotasReferidas->links('paginador-balance') }}

            <table class="table table-dark" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>

                    <th style="text-align: center;">Fecha</th>
                    <!-- <th style="text-align: center;">Id</th> -->
                    <th style="text-align: center;">Valor de Cuota</th>
                    <th style="text-align: center;">Fecha de Vencimiento</th>
                    <th style="text-align: center;">Monto Pagado</th>
                    <th style="text-align: center;">Fecha Pagado</th>
                    <th style="text-align: center;">Balance</th>
                    <!-- @role('Administrador') @if (Auth::check()) <th style="text-align: center;">Acciones</th> @endif @endrole -->
                  <tr>
                </thead>

                <tbody>
                  <?php $color = 0; ?>
                  <?php $balanceAnterior = null; ?>
                  <?php $idAnterior = null; ?>

                  @foreach($cuotasReferidas as $cuotaReferida) <!-- ESTO ES CADA BALANCE QUE HAY EN LA BASE DE DATOS -->

                  <?php $cuota = $cuotaReferida; ?>

                  <?php

                  $stringDelBalance = Carbon\Carbon::parse($cuota->created_at)->format('m-Y');

                  $fechaDelBalance = Carbon\Carbon::createFromFormat('m-Y', $stringDelBalance, 'America/Argentina/Buenos_Aires');


                   ?>

                  @if ($color % 2 == 0) <tr style="color: black; background-color:rgba(250,250,250,0.5); border: 1px solid rgba(0,0,0,0.3);"> @endif
                  @if ($color % 2 != 0) <tr style="border: 1px solid rgba(0,0,0,0.3);"> @endif



                    <td style="text-align: center; vertical-align: middle;">

                      @role('Administrador')

                      @if($cuotaReferida->mes == null || $cuotaReferida->anio == null)

                      {!! Form::open(array('route' => array('modificarFechaCuota', $proyectoReferido->id, $usuarioReferido->id, $cuotaReferida->id))) !!}
                      <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                      <?php echo Form::token(); ?>

                      <label> Mes: </label>
                      <select name="mes" required>
                        <option disabled selected value> -- Seleccione un Mes -- </option>
                        <option value="enero">Enero</option>
                        <option value="febrero">Febrero</option>
                        <option value="marzo">Marzo</option>
                        <option value="abril">Abril</option>
                        <option value="mayo">Mayo</option>
                        <option value="junio">Junio</option>
                        <option value="julio">Julio</option>
                        <option value="agosto">Agosto</option>
                        <option value="septiembre">Septiembre</option>
                        <option value="octubre">Octubre</option>
                        <option value="noviembre">Noviembre</option>
                        <option value="diciembre">Diciembre</option>
                      </select>

                      <label> Año: </label>
                      <select name="anio" required>
                        <option disabled selected value> -- Seleccione un Año -- </option>
                        @foreach($periodoTotal as $anio)
                        <option value="{{$anio}}">{{$anio}}</option>
                        @endforeach
                      </select>

                      @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->mes == null && $cuota->mes_vencimiento == null && $cuota->anio_vencimiento == null && $cuota->monto_pagado == null) <button class="btn btn-xs btn-primary" type="submit" name="fecha-cuota-agregada">Ingresar Fecha de Cuota</button> @endif @endrole

                        {{ Form::close() }}
                      @endif

                      @if($cuotaReferida->mes != null && $cuotaReferida->anio != null)
                      <b>{{ ucfirst($cuota->mes) }} {{ $cuota->anio }}</b>
                      @endif

                    </td>

                    <td style="text-align: center; vertical-align: middle;">  <!-- MONTO ESTABLECIDO -->

                      @if($cuotasReferidas->first())
                       ${{ $cuota->monto_establecido }}
                      @endif

                    </td>

                    <td style="text-align: center; vertical-align: middle;">  <!-- FECHA DE VENCIMIENTO -->


                      @role('Administrador') @if (Auth::check() && $cuota->mes == null || $cuota->anio == null) <i class="btn btn-xs btn-warning disabled" style="color:black;"> Ingrese una fecha de cuota </i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->monto_pagado == null && $cuota->mes != null && $cuota->anio != null  && $cuota->mes_vencimiento == null && $cuota->anio_vencimiento == null )

                      {!! Form::open(array('route' => array('modificarFechaVencimiento', $proyectoReferido->id, $usuarioReferido->id, $cuotaReferida->id))) !!}
                      <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                      <?php echo Form::token(); ?>


                      <label> Dia: </label>
                      <select name="dia_vencimiento" required>
                        <option disabled selected value> -- Seleccione un Dia -- </option>
                        @foreach($diasDelMes as $dia)
                        <option value="{{$dia}}">{{$dia}}</option>
                        @endforeach
                      </select>

                      <label> Mes: </label>
                      <select name="mes_vencimiento" required>
                        <option disabled selected value> -- Seleccione un Mes -- </option>
                        <option value="enero">Enero</option>
                        <option value="febrero">Febrero</option>
                        <option value="marzo">Marzo</option>
                        <option value="abril">Abril</option>
                        <option value="mayo">Mayo</option>
                        <option value="junio">Junio</option>
                        <option value="julio">Julio</option>
                        <option value="agosto">Agosto</option>
                        <option value="septiembre">Septiembre</option>
                        <option value="octubre">Octubre</option>
                        <option value="noviembre">Noviembre</option>
                        <option value="diciembre">Diciembre</option>
                      </select>

                      <label> Año: </label>
                      <select name="anio_vencimiento" required>
                        <option disabled selected value> -- Seleccione un Año -- </option>
                        @foreach($periodoTotal as $anio)
                        <option value="{{$anio}}">{{$anio}}</option>
                        @endforeach
                      </select>

                      @role('Administrador') @if (Auth::check() && $cuota->mes_vencimiento == null && $cuota->anio_vencimiento == null) <button class="btn btn-xs btn-primary" type="submit" name="fecha-cuota-agregada">Ingresar Fecha de Vencimiento</button> @endif @endrole

                        {{ Form::close() }}

                      @endif @endrole

                      @if (Auth::check() && $cuota->mes_vencimiento != null && $cuota->anio_vencimiento != null) <b>{{$cuota->dia_vencimiento}}  {{ucfirst($cuota->mes_vencimiento)}} {{$cuota->anio_vencimiento}} </b> @endif

                    </td>





                    <td style="text-align: center; vertical-align: middle;">  <!-- MONTO PAGADO -->

                      @role('Administrador') @if (Auth::check() && $cuota->mes_vencimiento == null && $cuota->anio_vencimiento == null && $cuota->monto_pagado == null) <i class="btn btn-xs btn-warning disabled" style="color:black;"> Ingrese una fecha de vencimiento </i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->mes_vencimiento != null && $cuota->anio_vencimiento != null && $cuota->monto_pagado == null)

                      {!! Form::open(array('route' => array('modificarMontoPagado', $proyectoReferido->id, $usuarioReferido->id, $cuotaReferida->id))) !!}
                      <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                      <?php echo Form::token(); ?>

                      @role('Administrador') @if (Auth::check() && $cuota->mes_vencimiento != null && $cuota->anio_vencimiento != null && $cuota->monto_pagado == null && $cuota->balance_mensual == null) <input class="form-control" type='number' name="monto_pagado" required> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->mes_vencimiento != null && $cuota->anio_vencimiento != null && $cuota->monto_pagado == null && $cuota->balance_mensual == null) <button class="btn btn-xs btn-success" type="submit" name="pago-agregado">Ingresar Pago</button> @endif @endrole

                      {{ Form::close() }}

                      @endif @endrole

                      @if (Auth::check() && $cuota->mes_vencimiento != null && $cuota->anio_vencimiento != null && $cuota->balance_mensual !== null)${{ $cuota->monto_pagado }} @endif

                    </td>






                    <td style="text-align: center; vertical-align: middle;">  <!-- FECHA PAGADO -->

                      @role('Administrador') @if (Auth::check() && $cuota->monto_pagado == null && $cuota->balance_mensual == null)<i class="btn btn-xs btn-warning disabled" style="color:black;"> Pago aún no ingresado </i> @endif @endrole

                      @role('Administrador') @if (Auth::check() && $cuota->monto_pagado != null && $cuota->dia_pagado == null)

                      {!! Form::open(array('route' => array('modificarFechaPagado', $proyectoReferido->id, $usuarioReferido->id, $cuotaReferida->id))) !!}
                      <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                      <?php echo Form::token(); ?>


                      <label> Dia: </label>
                      <select name="dia_pagado" required>
                        <option disabled selected value> -- Seleccione un Dia -- </option>
                        @foreach($diasDelMes as $dia)
                        <option value="{{$dia}}">{{$dia}}</option>
                        @endforeach
                      </select>

                      <label> Mes: </label>
                      <select name="mes_pagado" required>
                        <option disabled selected value> -- Seleccione un Mes -- </option>
                        <option value="enero">Enero</option>
                        <option value="febrero">Febrero</option>
                        <option value="marzo">Marzo</option>
                        <option value="abril">Abril</option>
                        <option value="mayo">Mayo</option>
                        <option value="junio">Junio</option>
                        <option value="julio">Julio</option>
                        <option value="agosto">Agosto</option>
                        <option value="septiembre">Septiembre</option>
                        <option value="octubre">Octubre</option>
                        <option value="noviembre">Noviembre</option>
                        <option value="diciembre">Diciembre</option>
                      </select>

                      <label> Año: </label>
                      <select name="anio_pagado" required>
                        <option disabled selected value> -- Seleccione un Año -- </option>
                        @foreach($periodoTotal as $anio)
                        <option value="{{$anio}}">{{$anio}}</option>
                        @endforeach
                      </select>

                      @role('Administrador') @if (Auth::check() && $cuota->monto_pagado != null && $cuota->dia_pagado == null) <button class="btn btn-xs btn-primary" type="submit" name="fecha-pago-agregado">Ingresar Fecha de Pago</button> @endif @endrole

                        {{ Form::close() }}

                      @endif @endrole

                      @if (Auth::check() && $cuota->mes_pagado != null && $cuota->anio_pagado != null) <b>{{$cuota->dia_pagado}}  {{ucfirst($cuota->mes_pagado)}} {{$cuota->anio_pagado}} </b> @endif

                    </td>







                    <td style="text-align: center; vertical-align: middle;"> <!-- BALANCE -->

                      @role('Administrador') @if (Auth::check() && $cuota->mes_vencimiento == null && $cuota->anio_vencimiento == null && $cuota->monto_pagado === "0")<i class="btn btn-xs btn-warning disabled" style="color:black;"> Ingrese una fecha de vencimiento </i> @endif @endrole

                      @if($cuota->balance_mensual > 0)
                      <span style="color:green"><b>+ ${{$cuota->balance_mensual}}</b></span>
                      @endif

                      @if($cuota->balance_mensual == 0)
                      <span style="color:blue"><b>$ 0</b></span>
                      @endif

                      @if($cuota->balance_mensual < 0)
                      <span style="color:red"><b>- ${{abs($cuota->balance_mensual)}}</b></span>
                      @endif

                    </td>

                    <?php $color = $color + 1; ?>


                      @endforeach


                    </tbody>


                  @role('Administrador')

                  <tbody class="ocultar">

                      {!! Form::open(array('route' => array('agregarCuota', $proyectoReferido->id, $usuarioReferido->id, $cuotaReferida->id))) !!}
                      <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                      <?php echo Form::token(); ?>
                      <td style="text-align: center; vertical-align: middle;">  <!--  FECHA -->

                        <label> Mes: </label>
                        <select name="mes" required>
                          <option disabled selected value> -- Seleccione un Mes -- </option>
                          <option value="enero">Enero</option>
                          <option value="febrero">Febrero</option>
                          <option value="marzo">Marzo</option>
                          <option value="abril">Abril</option>
                          <option value="mayo">Mayo</option>
                          <option value="junio">Junio</option>
                          <option value="julio">Julio</option>
                          <option value="agosto">Agosto</option>
                          <option value="septiembre">Septiembre</option>
                          <option value="octubre">Octubre</option>
                          <option value="noviembre">Noviembre</option>
                          <option value="diciembre">Diciembre</option>
                        </select>

                        <label> Año: </label>
                        <select name="anio" required>
                          <option disabled selected value> -- Seleccione un Año -- </option>
                          @foreach($periodoTotal as $anio)
                          <option value="{{$anio}}">{{$anio}}</option>
                          @endforeach
                        </select>

                      </td>

                      <td style="text-align: center; vertical-align: middle;">  <!--  MONTO ESTABLECIDO -->

                        <label> Monto establecido: </label>
                        <input class="form-control" type="number" name="monto_establecido" value="{{$proyectoReferido->monto_establecido}}" required>

                      </td>

                      <td style="text-align: center; vertical-align: middle;">  <!-- FECHA DE VENCIMIENTO -->

                        <label> Dia: </label>
                        <select name="dia_vencimiento" required>
                          <option disabled selected value> -- Seleccione un Dia -- </option>
                          @foreach($diasDelMes as $dia)
                          <option value="{{$dia}}">{{$dia}}</option>
                          @endforeach
                        </select>

                        <label> Mes: </label>
                        <select name="mes_vencimiento" required>
                          <option disabled selected value> -- Seleccione un Mes -- </option>
                          <option value="enero">Enero</option>
                          <option value="febrero">Febrero</option>
                          <option value="marzo">Marzo</option>
                          <option value="abril">Abril</option>
                          <option value="mayo">Mayo</option>
                          <option value="junio">Junio</option>
                          <option value="julio">Julio</option>
                          <option value="agosto">Agosto</option>
                          <option value="septiembre">Septiembre</option>
                          <option value="octubre">Octubre</option>
                          <option value="noviembre">Noviembre</option>
                          <option value="diciembre">Diciembre</option>
                        </select>

                        <label> Año: </label>
                        <select name="anio_vencimiento" required>
                          <option disabled selected value> -- Seleccione un Año -- </option>
                          @foreach($periodoTotal as $anio)
                          <option value="{{$anio}}">{{$anio}}</option>
                          @endforeach
                        </select>

                      </td>




                      <td style="text-align: center; vertical-align: middle;">  <!-- MONTO PAGADO -->

                        <label> Monto pagado: </label>
                        <input class="form-control" type='number' name="monto_pagado" required>

                      </td>

                      <td style="text-align: center; vertical-align: middle;">  <!-- FECHA PAGADO -->

                        <label> Dia: </label>
                        <select name="dia_pagado" required>
                          <option disabled selected value> -- Seleccione un Dia -- </option>
                          @foreach($diasDelMes as $dia)
                          <option value="{{$dia}}">{{$dia}}</option>
                          @endforeach
                        </select>

                        <label> Mes: </label>
                        <select name="mes_pagado" required>
                          <option disabled selected value> -- Seleccione un Mes -- </option>
                          <option value="enero">Enero</option>
                          <option value="febrero">Febrero</option>
                          <option value="marzo">Marzo</option>
                          <option value="abril">Abril</option>
                          <option value="mayo">Mayo</option>
                          <option value="junio">Junio</option>
                          <option value="julio">Julio</option>
                          <option value="agosto">Agosto</option>
                          <option value="septiembre">Septiembre</option>
                          <option value="octubre">Octubre</option>
                          <option value="noviembre">Noviembre</option>
                          <option value="diciembre">Diciembre</option>
                        </select>

                        <label> Año: </label>
                        <select name="anio_pagado" required>
                          <option disabled selected value> -- Seleccione un Año -- </option>
                          @foreach($periodoTotal as $anio)
                          <option value="{{$anio}}">{{$anio}}</option>
                          @endforeach
                        </select>

                      </td>



                          <td style="text-align: center; vertical-align: middle;"> <!-- ACCIONES -->

                            <button class="btn btn-xs btn-primary" type="submit" name="cuota-agregada">Ingresar Cuota</button>

                              </td>


                        {{ Form::close() }}


                </tbody>
                @endrole
            </table>

            {{  $cuotasReferidas->links('paginador-balance') }}
            @endif

          </div>
        </div>

      </section>

@endsection
