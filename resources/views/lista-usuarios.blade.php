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
                    <th>Proyecto</th>
                    <th>Calle</th>
                    <th>Altura</th>
                    <th>Iniciado</th>
                    <th>Acciones</th>
                  <tr>
                </thead>

                <tbody>
                  @foreach($usuarios as $usuario)
                    {{-- {{dd($users)}} --}}
                    <tr>
                      {{-- {{dd($usuario->id)}} --}}
                      <td>{{ $usuario->nombre }}</td>
                      <td class="contenidoPost">{{ $usuario->apellido }}</td>
                      <td>{{ $usuario->documento }}</td>
                      <td>{{ $usuario->created_at}}</td>
                      <td>
                        <button class="btn btn-xs btn-danger">Eliminar Usuario</button>
                        <a class="btn btn-xs btn-primary" href="{{ route('index') }}">Eliminar Proyecto</a>
                        <button class="btn btn-xs btn-success" href={{ route('index') }}>Añadir Proyecto</button>
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
