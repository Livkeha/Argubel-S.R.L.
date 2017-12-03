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

<h2 style="color:blue;">Cantidad de planos subidos: {{$cantidadPlanos}}. 10 planos permitidos.</h2>

@endrole


@role('Administrador')

<form action="{{ route('validarPlanos') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

      @if($cantidadPlanos < 10)<h3 style="color:green">Subir planos (Puede subir hasta 10 planos):</h3>@endif
      @if($cantidadPlanos == 10)<h3 style="color:green">No se permite subir mas planos.</h3>@endif

    <br />
    <br />
    <input type="file" name="blueprints[]" multiple required/>
    <br /><br />
    <input type="hidden" value="{{$proyectoReferido->id}}" name="idProyecto" />
    <input type="hidden" value="{{$proyectoReferido->nombre}}" name="nombreProyecto" />
    <input type="hidden" value="{{$cantidadPlanos}}" name="cantidadPlanos" />
    <button class="boton-enviar" type="submit" name="" value"Enviar">Subir planos</button>
    <!-- <input type="submit" value="Upload" /> -->

</form>

@endrole


<h1 style="color:red;">Planos:</h1>

@foreach($planosProyecto as $plano)
<img src="{{ URL::to('/') }}/imagenesDesarrollos/{{$proyectoReferido->nombre}}/Planos/{{$plano}}" alt="{{$plano}}" class="profileImage" style='height:300px'>
@role('Administrador') <a class="btn btn-xs btn-danger" href="{{ URL::to('miDesarrollo/' . strtolower($proyectoReferido->nombre)) . '/planos' . '/eliminarPlano/' . $plano }}">Eliminar Plano</a> @endrole
@endforeach

@endsection
