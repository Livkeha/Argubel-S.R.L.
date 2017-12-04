@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        {{--    {{dd($balance->first())}} --}}

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



        <h2 class="form-titulo" style="color: blue; text-align:center;">Lista de desarrollos</h2>

        @if($balance->all() == null) <h4 style="color: red; text-align:center;"><b>No hay inversores disponibles sin desarrollo asignado.</b></h4> @endif

        <div class="container" style="height:502px; width:100%;">
          <div class="responsive-table">

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>
                    <th>Proyecto</th>
                    <th>Dirección</th>
                    <th>Inicio de Desarrollo</th>
                    <th>Monto de cuota establecido</th>
                    <th>Acciones</th>
                  <tr>
                </thead>

                <tbody>
                  <?php $color = 0; ?>
                  @foreach($balance as $cuota)
                    {{-- {{dd($users)}} --}}
                    @if ($color % 2 == 0) <tr style="background-color:rgba(176,106,92,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                    @if ($color % 2 != 0) <tr style="background-color:rgba(124,88,145,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                      {{-- {{dd($proyecto->id)}} --}}
                      <td><b>{{ $proyecto->nombre }}</b></td>
                      <td class="contenidoPost">{{ $proyecto->calle }} {{$proyecto->altura}}</td>
                      <td>{{ Carbon\Carbon::parse($proyecto->created_at)->format('d-m-Y') }}</td>
                      <td>$ {{ $proyecto->monto_establecido }}
                      <a class="btn btn-xs btn-primary" href="{{ URL::to('modificarMontoEstablecido/' . $proyecto->id) }}">Modificar Monto</a>
                      </td>
                      <td>
                        @if($balance->all() != null) <a class="btn btn-xs btn-success" href="{{ URL::to('agregarInversor/' . $proyecto->id) }}">Añadir Inversor</a> @endif
                        @if($balance->all() == null) <a class="btn btn-xs btn-success disabled">Añadir Inversor</a> @endif
                        <a class="btn btn-xs btn-primary" href="{{ URL::to('miDesarrollo/' . strtolower($proyecto->id)) . '/fotos' }}">Añadir Fotos</a>
                        <a class="btn btn-xs btn-primary" href="{{ URL::to('miDesarrollo/' . strtolower($proyecto->id)) . '/planos' }}">Añadir Planos</a>
                        <a class="btn btn-xs btn-danger" href="{{ URL::to('eliminarDesarrollo/' . $proyecto->id) }}">Eliminar Desarrollo</a>
                      </td>
                    <tr>
                      <?php $color = $color + 1; ?>
                  @endforeach
                </tbody>
            </table>
            {{-- $proyectos->links() --}}
            {{-- {{ $proyectos->render() }} --}}
          </div>
        </div>

    {{--  @endif --}}
      @endif
      </section>

@endsection
