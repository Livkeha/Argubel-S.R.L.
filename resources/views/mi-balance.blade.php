@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        {{-- {{dd($perPage}} --}}

        {{-- @if ($balance->first() != null) --}}

        {{--  {{dd($inversores->all())}} --}}

        @if (Session::has('proyectoActualizado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('proyectoActualizado') }}</h2>
        @endif

        @if (Session::has('montoEstablecidoModificado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('montoEstablecidoModificado') }}</h2>
        @endif

        @if (Session::has('desarrolloEliminado'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('desarrolloEliminado') }}</h1>
        @endif

        {{-- {{dd($proyectoReferido)}} --}}

        <h2 class="form-titulo" style="color: blue; text-align:center;">Lista de desarrollos</h2>

      {{--  @if($balance->all() == null) <h4 style="color: red; text-align:center;"><b>No hay inversores disponibles sin desarrollo asignado.</b></h4> @endif --}}

        <div class="container" style="height:502px; width:100%;">
          <div class="responsive-table">

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>
                    <th>Año</th>
                    <th>Monto Estipulado</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Monto Pagado</th>
                    <th>Fecha Pagado</th>
                    <th>Balance</th>
                    @role('Administrador') @if (Auth::check()) <th>Acciones</th> @endif @endrole
                  <tr>
                </thead>

                <tbody>
                  <?php $color = 0; ?>
                  @foreach($periodoTotal as $cuota => $mes)

                    @if ($color % 2 == 0) <tr style="background-color:rgba(176,106,92,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                    @if ($color % 2 != 0) <tr style="background-color:rgba(124,88,145,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif

                      <td>{{$mes}}</td>
                      <td>$ {{-- $cuota->monto_establecido --}}</td>
                      <td class="contenidoPost">Fecha de Vencimiento</td>
                      {{-- @if($cuota->monto_pagado != null) <td>$ Monto Pagado</td> @endif --}}
                    {{--   @if($cuota->monto_pagado == null) <td><input class="form-control" type='number' name="altura" required> </td> @endif --}}
                      <td>Fecha pagado</td>
                      <td>Balance</td>
                      @role('Administrador') @if (Auth::check()) <td><a class="btn btn-xs btn-success" href="">Ingresar Pago</a></td> @endif @endrole
                    <tr>
                      <?php $color = $color + 1; ?>
                      @endforeach
                </tbody>
            </table>
            {{  $periodoTotal->links() }}
            {{--  $months->render() --}}
            {{-- $proyectos->links() --}}
            {{-- {{ $proyectos->render() }} --}}
          </div>
        </div>

    {{--  @endif --}}
      @endif
      </section>

@endsection
