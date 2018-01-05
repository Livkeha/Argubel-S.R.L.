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


@if (Session::has('planosSubidos'))
   <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('planosSubidos') }}</h1>
@endif

@if (Session::has('maximoPlanosExcedido'))
   <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('maximoPlanosExcedido') }}</h1>
@endif

@if (Session::has('planoEliminado'))
   <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('planoEliminado') }}</h1>
@endif
@endrole


<h2 class="margen-50" style="padding-top: 10px; text-align:center;"><span class="label label-default" style="font-size: 1.5em">Planos</span></h2>

@role('Administrador')

<form action="{{ route('validarPlanos') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

      @if($cantidadPlanos < 30)<h3 class="margen-100" style="padding-top: 10px;"><span class="label label-primary">Subir planos (Puede subir hasta 30 planos):</span></h3>
      <h4 class="" style="padding-top: 10px;"><span class="label label-success">Cantidad de planos subidas: {{$cantidadPlanos}}.</h4>@endif
      @if($cantidadPlanos == 30)
				<div class="alert alert-danger" role="alert" style="text-align:center;margin-top: 10px;">
					<h4>
						<span class="glyphicon glyphicon-exclamation-sign color-rojo" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						<strong>No se permite subir mas planos!</strong>
					</h4>
				</div>
				{{-- <h3 style="color:green">No se permite subir mas planos.</h3>--}}
			@endif

    <br />
    <br />
    @if($cantidadPlanos != 30) <input class="btn btn-primary" type="file" name="blueprints[]" multiple required/> @endif
    <br /><br />
    <input type="hidden" value="{{$proyectoReferido->id}}" name="idProyecto" />
    <input type="hidden" value="{{$proyectoReferido->nombre}}" name="nombreProyecto" />
    <input type="hidden" value="{{$cantidadPlanos}}" name="cantidadPlanos" />
    @if($cantidadPlanos != 30) <button class="btn btn-success" type="submit" name="" value"Enviar">Subir planos</button> @endif
    <!-- <input type="submit" value="Upload" /> -->

</form>

@endrole


<div class="responsive-foto" style="margin-top:130px;">
@foreach($planosProyecto as $plano)
	<div class="galeria">
		<a target="_blank" href="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/Planos/{{$plano}}">
		<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/Planos/{{$plano}}" alt="{{$plano}}" style='height:300px'>
		</a>
		@role('Administrador') <a class="btn btn-xs btn-danger btn-in" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->id)) . '/planos' . '/eliminarPlano/' . $plano }}">Eliminar Plano</a> @endrole
	</div>
@endforeach
</div>
@endsection
