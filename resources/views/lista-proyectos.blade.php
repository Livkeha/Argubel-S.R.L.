@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        @if ($proyectos->first() != null)

        {{--  {{dd($proyectos->first())}} --}}

        {{--  {{dd($inversores->all())}} --}}

        @if (Session::has('proyectoActualizado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('proyectoActualizado') }}</h2>
        @endif

        @if (Session::has('desarrolloEliminado'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('desarrolloEliminado') }}</h1>
        @endif

        <h2 class="form-titulo" style="color: blue; text-align:center;">Lista de desarrollos</h2>

        @if($inversores->all() == null) <h4 style="color: red; text-align:center;"><b>No hay inversores disponibles sin desarrollo asignado.</b></h4> @endif

        <div class="container" style="height:502px; width:100%;">
          <div class="responsive-table">

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>
                    <th>Proyecto</th>
                    <th>Dirección</th>
                    <th>Inicio de Desarrollo</th>
                    <th>Acciones</th>
                  <tr>
                </thead>

                <tbody>
                  <?php $color = 0; ?>
                  @foreach($proyectos as $proyecto)
                    {{-- {{dd($users)}} --}}
                    @if ($color % 2 == 0) <tr style="background-color:rgba(176,106,92,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                    @if ($color % 2 != 0) <tr style="background-color:rgba(124,88,145,0.3); border: 1px solid rgba(0,0,0,0.3);"> @endif
                      {{-- {{dd($proyecto->id)}} --}}
                      <td><b>{{ $proyecto->nombre }}</b></td>
                      <td class="contenidoPost">{{ $proyecto->calle }} {{$proyecto->altura}}</td>
                      <td>{{ $proyecto->created_at}}</td>
                      <td>
                        @if($inversores->all() != null) <a class="btn btn-xs btn-success" href="{{ URL::to('agregarInversor/' . $proyecto->id) }}">Añadir Inversor</a> @endif
                        @if($inversores->all() == null) <a class="btn btn-xs btn-success disabled">Añadir Inversor</a> @endif
                        <a class="btn btn-xs btn-primary" href="{{ URL::to('miDesarrollo/' . strtolower($proyecto->nombre)) . '/fotos' }}">Añadir Fotos</a>
                        <a class="btn btn-xs btn-primary" href="{{ URL::to('miDesarrollo/' . strtolower($proyecto->nombre)) . '/planos' }}">Añadir Planos</a>
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

      @endif

      {{-- @if ($proyectos->first() == null)
        <php
        header('refresh:0; url=/index');
        ?>
         @endif --}}


      </section>

@endsection
      @else
      <php
      header('refresh:0; url=/index');
      ?>
      @endif
