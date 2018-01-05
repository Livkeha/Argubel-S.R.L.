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
@endrole

<h2 class="margen-50" style="padding-top: 10px; text-align:center;"><span class="label label-default" style="font-size: 1.5em">Fotos</span></h2>



@role('Administrador')

<form class="margen-100" action="{{ route('validarFotos') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

      @if($cantidadFotos < 30)<h3 class="margen-50" style="padding-top: 10px;"><span class="label label-primary">Subir fotos (Puede subir hasta 30 fotos):</span></h3>
      <h4 class="" style="padding-top: 10px;"><span class="label label-success">Cantidad de fotos subidas: {{$cantidadFotos}}.</h4>@endif
      @if($cantidadFotos == 30)
				<div class="alert alert-danger" role="alert" style="text-align:center;margin-top: 10px;">
					<h4>
						<span class="glyphicon glyphicon-exclamation-sign color-rojo" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						<strong>No se permite subir mas fotos!</strong>
					</h4>
				</div>
				{{-- <h3 class="margen-50" style="padding-top: 10px; text-align:center"><span class="label label-warning">No se permite subir mas fotos.</span></h3 --}}
					@endif

    <br />
    <br />
    @if($cantidadFotos != 30) <input class="btn btn-primary" type="file" name="photos[]" multiple required/> @endif
    <br /><br />
    <input type="hidden" value="{{$proyectoReferido->id}}" name="idProyecto" />
    <input type="hidden" value="{{$proyectoReferido->nombre}}" name="nombreProyecto" />
    <input type="hidden" value="{{$cantidadFotos}}" name="cantidadFotos" />
    @if($cantidadFotos != 30) <button class="btn btn-success" type="submit" name="" value"Enviar">Subir fotos</button> @endif
    <!-- <input type="submit" value="Upload" /> -->

</form>

@endrole

<div class="col col-md-6 margen-100" style="text-align: center">
	@if(file_exists($existePresentacion)) <h1 style="color:#cccccc;">Presentación:</h1>

		<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenPresentacion}}" alt="{{$proyectoReferido->imagenPresentacion}}" class="profileImage" style='height:300px'>

		{{-- @role('Administrador') <a class="btn btn-xs btn-danger" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/fotos' . '/eliminarFoto/' . $proyectoReferido->imagenPresentacion }}">Eliminar Foto</a>
		@endrole --}}
	@endif
</div>

<div class="col col-md-6 margen-100" style="text-align: center">
	@if(file_exists($existeUbicacion)) <h1 style="color:#cccccc;">Ubicación:</h1>

		<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenUbicacion}}" alt="{{$proyectoReferido->imagenUbicacion}}" class="profileImage" style='height:300px'>

		{{-- @role('Administrador') <a class="btn btn-xs btn-danger" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/fotos' . '/eliminarFoto/' . $proyectoReferido->imagenUbicacion }}">Eliminar Foto</a>
		@endrole --}}
	@endif
</div>

{{-- <h1 style="color:red;">Fotos:</h1> --}}

	<div class="responsive-foto" style="margin-top:530px;">
		@foreach($fotosProyecto as $foto)
			<div class="galeria">
    		<a target="_blank" href="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/Fotos/{{$foto}}">
				<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/Fotos/{{$foto}}" alt="{{$foto}}" {{--class="profileImage"--}} style='height:300px'>
      	{{-- <img src="img_fjords.jpg" alt="Trolltunga Norway" width="300" height="200"> --}}
    		</a>
				@role('Administrador') <a class="btn btn-xs btn-danger btn-in" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/fotos' . '/eliminarFoto/' . $foto }}">Eliminar Foto</a> @endrole
			</div>
	@endforeach
</div>


@endsection
