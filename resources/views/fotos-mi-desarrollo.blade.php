@extends('layout.headerAndFooter')
@section('contenido')

<!-- @foreach($proyectoReferido as $datos)
<ul>
  <li>{{$datos}}</li>
</ul>
@endforeach -->

@role('Administrador')

@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


@if (Session::has('fotosSubidas'))
   <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fotosSubidas') }}</h1>
@endif

@if (Session::has('maximoFotosExcedido'))
   <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('maximoFotosExcedido') }}</h1>
@endif

@if (Session::has('fotoEliminada'))
   <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fotoEliminada') }}</h1>
@endif

<h2 style="color:blue;">Cantidad de fotos subidas: {{$cantidadFotos}}. 10 fotos permitidas.</h2>

@endrole


@role('Administrador')

<form action="{{ route('validarFotos') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

      @if($cantidadFotos < 10)<h3 style="color:green">Subir fotos (Puede subir hasta 10 fotos):</h3>@endif
      @if($cantidadFotos == 10)<h3 style="color:green">No se permite subir mas fotos.</h3>@endif

    <br />
    <br />
    <input type="file" name="photos[]" multiple required/>
    <br /><br />
    <input type="hidden" value="{{$proyectoReferido->id}}" name="idProyecto" />
    <input type="hidden" value="{{$proyectoReferido->nombre}}" name="nombreProyecto" />
    <input type="hidden" value="{{$cantidadFotos}}" name="cantidadFotos" />
    <button class="boton-enviar" type="submit" name="" value"Enviar">Subir fotos</button>
    <!-- <input type="submit" value="Upload" /> -->

</form>

@endrole

@if(file_exists($existePresentacion)) <h1 style="color:red;">Presentación:</h1>

<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenPresentacion}}" alt="{{$proyectoReferido->imagenPresentacion}}" class="profileImage" style='height:300px'>

<!-- @role('Administrador') <a class="btn btn-xs btn-danger" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/fotos' . '/eliminarFoto/' . $proyectoReferido->imagenPresentacion }}">Eliminar Foto</a> @endif @endrole -->

@if(file_exists($existeUbicacion)) <h1 style="color:red;">Ubicación:</h1>

<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenUbicacion}}" alt="{{$proyectoReferido->imagenUbicacion}}" class="profileImage" style='height:300px'>

<!-- @role('Administrador') <a class="btn btn-xs btn-danger" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/fotos' . '/eliminarFoto/' . $proyectoReferido->imagenUbicacion }}">Eliminar Foto</a> @endif @endrole -->

<h1 style="color:red;">Fotos:</h1>

@foreach($fotosProyecto as $foto)
<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/Fotos/{{$foto}}" alt="{{$foto}}" class="profileImage" style='height:300px'>
@role('Administrador') <a class="btn btn-xs btn-danger" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/fotos' . '/eliminarFoto/' . $foto }}">Eliminar Foto</a> @endrole
@endforeach

@endsection
