@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        @if ($usuarios->first() != null)

        {{--  {{dd($usuarios->first())}} --}}

        <h2 class="form-titulo" style="color: blue; text-align:center;">Lista de inversores</h2>


        <div class="container" style="height:541px; width:100%;">
          <div class="responsive-table">

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>
                    <th>Inversor</th>
                    <th>Documento</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Proyecto</th>
                    <th>Acciones</th>
                  <tr>
                </thead>

                <tbody>
                  @foreach($usuarios as $usuario)

                    @if($usuario->rol == "administrador") <tr style="border: 1px solid rgba(0,0,0,0.3); background-color: rgba(124,88,145,0.3);"> @endif
                    @if($usuario->rol == "cliente") <tr style="border: 1px solid rgba(0,0,0,0.3); background-color: rgba(176,106,92,0.3);"> @endif

                      <td><b>{{ $usuario->apellido }}, {{ $usuario->nombre }}</b></td>

                      <td>{{ $usuario->documento }}</td>

                      <td>{{ $usuario->telefono }}</td>

                      <td>{{ $usuario->email }}</td>

                      <td>@if($usuario->project_id == null && $usuario->rol == "administrador") <span class="btn btn-xs btn-warning disabled" style="color:black;">Administrador</span> @elseif($usuario->project_id != null && $usuario->rol == "cliente") <b>{{ $listaProyectos[$usuario->project_id] }}</b> <a class="btn btn-xs btn-primary" href="{{ route('index') }}">Abandonar Proyecto</a>@else @if($usuario->project_id == null && $usuario->rol == "cliente") <i>El inversor aun no participa de un proyecto.</i> @endif @endif </td>

                      <td>
                        @if($usuario->project_id != null && $usuario->rol == "cliente") <button class="btn btn-xs btn-danger">Eliminar Inversor</button> @endif
                        @if($usuario->rol == "administrador" && $usuario->documento != "71139326") <button class="btn btn-xs btn-danger">Eliminar Administrador</button> @endif
                        @if($usuario->project_id != null)  @endif
                        @if($usuario->project_id != null && $usuario->rol == "cliente") <a class="btn btn-xs btn-success" href="{{ route('index') }}">Editar Cuotas</a> @endif
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
