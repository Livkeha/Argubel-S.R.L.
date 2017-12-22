@extends('layout.headerAndFooter')
@section('contenido')


        @if (Session::has('sinPagos'))
					<div class="alert alert-info margen-100" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ban-circle color-rojo" aria-hidden="true"></span>
							<strong>{{ Session::get('sinPagos') }}</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('sinPagos') }}</h1> --}}
        @endif


        @if (Session::has('primerPasswordModificada'))
					<div class="alert alert-success margen-100" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>{{ Session::get('primerPasswordModificada') }}</strong>
						</h4>
					</div>
           {{-- <h1 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('primerPasswordModificada') }}</h1> --}}
        @endif

<!-- TODO: ACA INICIA LO MODIFICABLE -->

{{-- <h4><span class="label label-danger">Cuota actual: {{$proyectoReferido->monto_establecido}}</span></h4> --}}
{{-- {{dd($proyectoReferido)}} --}}
<h2 class="margen-50" style="margin-bottom: 50px; padding-top: 10px; text-align:center;"><span class="label label-primary" style="font-size: 1.5em; color: #cccccc;">{{$proyectoReferido->nombre}}</span></h2>
{{-- <h1>El proyecto es {{$proyectoReferido->nombre}}</h1> --}}
<div class="col col-lg-6 margen-100" style="text-align: center">
	<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenPresentacion}}">
</div>
<div class="col col-lg-6 margen-100" style="text-align: center">
	<h3>{{$proyectoReferido->descripcion}}</h3>
</div>
<div class="col col-lg-6 margen-50" style="text-align: left;">
	<a target="_blank" href="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenUbicacion}}">
	<img width="640" height="480" src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/{{$proyectoReferido->imagenUbicacion}}">
	</a>
</div>
<div class="col col-lg-6" style="text-align: center;">
	<h3>Ubicacion: {{$proyectoReferido->calle}} {{$proyectoReferido->altura}}</h2>
</div>

{{-- @foreach($proyectoReferido as $datos)
<ul>
  <li>{{$datos}}</li>
</ul>
@endforeach --}}

<!-- TODO: ACA TERMINA LO MODIFICABLE -->

@endsection
