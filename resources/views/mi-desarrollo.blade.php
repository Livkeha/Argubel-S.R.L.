@extends('layout.headerAndFooter')
@section('contenido')


        @if (Session::has('sinPagos'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('sinPagos') }}</h1>
        @endif


        @if (Session::has('primerPasswordModificada'))
           <h1 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('primerPasswordModificada') }}</h1>
        @endif

<!-- TODO: ACA INICIA LO MODIFICABLE -->

@foreach($proyectoReferido as $datos)
<ul>
  <li>{{$datos}}</li>
</ul>
@endforeach

<!-- TODO: ACA TERMINA LO MODIFICABLE -->

@endsection
