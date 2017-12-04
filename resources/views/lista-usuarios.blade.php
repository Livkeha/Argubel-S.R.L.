@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        @if ($usuarios->first() != null)

        {{--  {{dd($usuarios->first())}} --}}

        @if (Session::has('usuarioActualizado'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('usuarioActualizado') }}</h1>
        @endif

        @if (Session::has('desarrolloIngresado'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('desarrolloIngresado') }}</h1>
        @endif

        @if (Session::has('passwordModificada'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('passwordModificada') }}</h1>
        @endif

        @if (Session::has('usuarioEliminado'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('usuarioEliminado') }}</h1>
        @endif

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
                    <th>Desarrollo</th>
                    <th>Acciones</th>
                  <tr>
                </thead>

                <tbody>
                  @foreach($usuarios as $usuario)

                    @if($usuario->rol == "administrador") <tr style="border: 1px solid rgba(0,0,0,0.3); background-color: rgba(124,88,145,0.3);"> @endif
                    @if($usuario->rol == "cliente") <tr style="border: 1px solid rgba(0,0,0,0.3); background-color: rgba(176,106,92,0.3);"> @endif

                      <td ><b>{{ $usuario->apellido }}, {{ $usuario->nombre }}</b> @if($usuario->documento != "71139326") <a class="btn btn-xs btn-primary" href="{{ URL::to('cambiarPassword/' . $usuario->id) }}">Cambiar Contraseña</a> @endif</td>

                      <td >{{ $usuario->documento }}</td>

                      <td >{{ $usuario->telefono }}</td>

                      <td >{{ $usuario->email }}</td>

                      <td >@if($usuario->project_id == null && $usuario->rol == "administrador") <span class="btn btn-xs btn-warning disabled" style="color:black;">Administrador</span> @elseif($usuario->project_id != null && $usuario->rol == "cliente") <b>{{ $listaProyectos[$usuario->project_id] }}</b> <a class="btn btn-xs btn-primary" href="{{ URL::to('abandonarDesarrollo/' . $usuario->project_id . "/" . $usuario->id) }}">Abandonar Desarrollo</a>@else @if($usuario->project_id == null && $usuario->rol == "cliente") <i>El inversor aun no participa de un desarrollo.</i> @endif @endif </td>

                      <td >

                        @if($usuario->rol == "administrador" && $usuario->documento != "71139326") <a class="btn btn-xs btn-danger" href="{{ URL::to('eliminarInversor/' . $usuario->id) }}">Eliminar Administrador</a> @endif
                        @if($usuario->project_id != null && $usuario->rol == "cliente") <a class="btn btn-xs btn-success" href="{{ route('index') }}">Editar Cuotas</a> @endif
                        @if($usuario->rol == "cliente") <a class="btn btn-xs btn-danger" href="{{ URL::to('eliminarInversor/' . $usuario->id) }}">Eliminar Inversor</a> @endif
                        @if($usuario->rol == "administrador" && $usuario->documento == "71139326") <button class="btn btn-xs btn-warning disabled" style="color:black;">No se puede eliminar este usuario</button> @endif

                        @if($usuario->project_id == null && $usuario->rol == "cliente" && $totalProyectos->first() != null)

                        {!! Form::open(array('route' => array('ingresarEnDesarrollo', $usuario->id))) !!}
                        <!-- {{ Form::open(array('url' => 'www.google.com.ar')) }} -->

                          <?php echo Form::token(); ?>

                          <select name="desarrollo" required>

                          <option disabled selected value> -- Desarrollos -- </option>

                          @foreach($totalProyectos as $proyecto)

                          <option value="<?php echo($proyecto->id);?>"> {{$proyecto->nombre}} </option>

                          @endforeach

                        </select>

                         <button class="btn btn-xs btn-success" type="submit" name="desarrollo-agregado">Añadir Desarrollo</button>

                         {{ Form::close() }}

                         @endif

                         <!-- @if($usuario->project_id == null && $usuario->rol == "cliente") <button class="btn btn-xs btn-success" href={{ route('index') }}>Añadir Desarrollo</button> @endif -->
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
