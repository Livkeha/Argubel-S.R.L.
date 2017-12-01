@extends('layout.headerAndFooter')
@section('contenido')

<!-- @foreach($proyectoReferido as $datos)
<ul>
  <li>{{$datos}}</li>
</ul>
@endforeach -->

<h1 style="color:red;">Presentación:</h1>

<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenPresentacion}}" alt="{{$proyectoReferido->nombre}}" class="profileImage" style='height:300px'>

<h1 style="color:red;">Ubicación:</h1>

<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenUbicacion}}" alt="{{$proyectoReferido->nombre}}" class="profileImage" style='height:300px'>

<h1 style="color:red;">Fotos:</h1>

<?php // TODO: @foreach($fotosMiDesarrollo as $foto) ?>
<img src="" alt="" class="profileImage" style='height:300px'>
<?php // TODO: @endforeach ?>

@endsection
