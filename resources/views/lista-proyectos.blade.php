@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

        @if ($proyectos->first() != null)

        {{--  {{dd($proyectos->first())}} --}}

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
                  @foreach($proyectos as $proyecto)
                    {{-- {{dd($users)}} --}}
                    <tr>
                      {{-- {{dd($proyecto->id)}} --}}
                      <td>{{ $proyecto->nombre }}</td>
                      <td class="contenidoPost">{{ $proyecto->calle }}</td>
                      <td>{{ $proyecto->altura }}</td>
                      <td>{{ $proyecto->created_at}}</td>
                      <td>
                        <button class="btn btn-xs btn-success">Añadir Inversor</button>
                        <a class="btn btn-xs btn-primary" href="{{ route('index') }}">Cuotas</a>
                        <button class="btn btn-xs btn-primary" href={{ route('index') }}>Fotos</button>
                        <button class="btn btn-xs btn-primary" href={{ route('index') }}>Planos</button>
                        <button class="btn btn-xs btn-danger" href={{ route('index') }}>Eliminar Proyecto</button>
                      </td>
                    <tr>
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
