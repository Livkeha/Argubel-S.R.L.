@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        @if ($usuarios->first() != null)

        {{--  {{dd($usuarios->first())}} --}}

        <div class="container" style="height:541px; width:100%;">
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
                    <tr style="border: 1px solid rgba(0,0,0,0.3);">
                      {{-- {{dd($usuario->id)}} --}}

                      @if($usuario->rol == "administrador")<td style="background-color:rgba(124,88,145,0.3);"><b>{{ $usuario->apellido }}, {{ $usuario->nombre }}</b></td> @endif
                      @if($usuario->rol == "cliente")<td style="background-color:rgba(176,106,92,0.4);"><b>{{ $usuario->apellido }}, {{ $usuario->nombre }}</b></td> @endif

                      @if($usuario->rol == "administrador")<td style="background-color:rgba(124,88,145,0.3);">{{ $usuario->documento }}</td> @endif
                      @if($usuario->rol == "cliente")<td style="background-color:rgba(176,106,92,0.4);">{{ $usuario->documento }}</td> @endif

                      @if($usuario->rol == "administrador")<td style="background-color:rgba(124,88,145,0.3);">{{ $usuario->telefono }}</td> @endif
                      @if($usuario->rol == "cliente")<td style="background-color:rgba(176,106,92,0.4);">{{ $usuario->telefono }}</td> @endif

                      @if($usuario->rol == "administrador")<td style="background-color:rgba(124,88,145,0.3);">@if($usuario->project_id == null && $usuario->rol == "administrador") <span class="btn btn-xs btn-warning disabled" style="color:black;">Administrador</span> @elseif($usuario->project_id != null && $usuario->rol == "cliente") <b>{{ $listaProyectos[$usuario->project_id] }}</b> @else @if($usuario->project_id == null && $usuario->rol == "cliente") <i>El inversor aun no participa de un proyecto.</i> @endif @endif @endif</td>

                      @if($usuario->rol == "cliente")<td style="background-color:rgba(176,106,92,0.4);">@if($usuario->project_id == null && $usuario->rol == "administrador") <span class="btn btn-xs btn-warning disabled" style="color:black;">Administrador</span> @elseif($usuario->project_id != null && $usuario->rol == "cliente") <b>{{ $listaProyectos[$usuario->project_id] }}</b> @else @if($usuario->project_id == null && $usuario->rol == "cliente") <i>El inversor aun no participa de un proyecto.</i> @endif @endif @endif</td>

                      @if($usuario->rol == "administrador")<td style="background-color:rgba(124,88,145,0.3);">
                        <button class="btn btn-xs btn-danger">Eliminar Usuario</button>
                        @if($usuario->project_id != null) <a class="btn btn-xs btn-primary" href="{{ route('index') }}">Eliminar Proyecto</a> @endif
                        @if($usuario->project_id == null && $usuario->rol == "cliente") <button class="btn btn-xs btn-success" href={{ route('index') }}>Añadir Proyecto</button> @endif
                      </td> @endif

                      @if($usuario->rol == "cliente")<td style="background-color:rgba(176,106,92,0.4);">
                        <button class="btn btn-xs btn-danger">Eliminar Usuario</button>
                        @if($usuario->project_id != null) <a class="btn btn-xs btn-primary" href="{{ route('index') }}">Eliminar Proyecto</a> @endif
                        @if($usuario->project_id == null && $usuario->rol == "cliente") <button class="btn btn-xs btn-success" href={{ route('index') }}>Añadir Proyecto</button> @endif
                      </td> @endif

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
