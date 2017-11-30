@extends('layout.headerAndFooter')
@section('contenido')

@foreach($proyectoReferido as $datos)
<ul>
  <li>{{$datos}}</li>
</ul>
@endforeach

@endsection
