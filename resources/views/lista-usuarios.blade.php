@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        @if ($usuarios->first() != null)

        {{--  {{dd($usuarios->first())}} --}}

        <div class="container" style="height:500px; width:100%;">
          <div class="responsive-table">

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>
                    <th>Inversor</th>
                    <th>Documento</th>
                    <th>Teléfono</th>
                    <th>Proyecto</th>
                    <th>Acciones</th>
                  <tr>
                </thead>

                <tbody>
                  @foreach($usuarios as $usuario)
                    {{-- {{dd($users)}} --}}
                    <tr>
                      {{-- {{dd($usuario->id)}} --}}
                      <td><b>{{ $usuario->apellido }}, {{ $usuario->nombre }}</b></td>
                      <td class="contenidoPost">{{ $usuario->documento }}</td>
                      <td>{{ $usuario->telefono }}</td>
                      <td>@if($usuario->project_id == null && $usuario->rol == "administrador") <span class="btn btn-xs btn-warning disabled" style="color:black;">Administrador</span> @elseif($usuario->project_id != null && $usuario->rol == "cliente") {{ $listaProyectos[$usuario->project_id] }} @else @if($usuario->project_id == null && $usuario->rol == "cliente") El inversor aun no participa de un proyecto. @endif @endif</td>
                      <!-- <td>Acá va el proyecto de cada uno</td> -->
                      <td>
                        <button class="btn btn-xs btn-danger">Eliminar Usuario</button>
                        @if($usuario->project_id != null) <a class="btn btn-xs btn-primary" href="{{ route('index') }}">Eliminar Proyecto</a> @endif
                        @if($usuario->project_id == null && $usuario->rol == "cliente") <button class="btn btn-xs btn-success" href={{ route('index') }}>Añadir Proyecto</button> @endif
                      </td>
                    <tr>
                  @endforeach
                </tbody>
            </table>
            {{-- $usuarios->links() --}}
            {{-- {{ $usuarios->render() }} --}}
          </div>
        </div>

      @endif

      {{-- @if ($usuarios->first() == null)
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
