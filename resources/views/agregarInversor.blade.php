@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')

<div class="margen-50">
	<h1 style="padding-top: 10px; text-align:center;"><span class="label label-primary">Agregar Inversor</span></h1>

</div>
<div class="margen-100">
	<h3 style="padding-top: 10px;"><span class="label label-default">Seleccione los inversores deseados para el proyecto "{{$proyectoReferido->nombre}}"</span></h3>
@if ($errors->all() != null)

        <section class="erroresPostUser">
          @foreach ($errors->all() as $clave => $valor)
                <ul>
                    <li>·   {{ $valor }}</li>
                </ul>
              @endforeach
        </section>
        <br>
@endif

@if (Session::has('proyectoActualizado'))
<br>
   <h2 class="alert alert-info" style="color:green; text-align: center;">{{ Session::get('proyectoActualizado') }}</h3>
@endif

@if (isset($proyectoActualizado))

        <section class="postSatisfactorio">
					<div class="alert alert-success" role="alert">
						<h4>
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<strong>El desarrollo "{{$proyectoReferido->nombre}}" se ha actualizado correctamente!</strong>
						</h4>
					</div>
          {{-- <ul>
            <li>El proyecto "{{$proyectoReferido->nombre}}" se ha actualizado correctamente.</li>
          </ul> --}}
          {{-- <span class="postSatisfactorio">El proyecto se ha actualizado correctamente.</span> --}}
        </section>

@endif

<form class="contacto-form" action="{{ route('validarInversorAgregado') }}" method="post">

  {{ csrf_field() }}

<?php $numeroInversor = 0; ?>

<div class="container-inversores" style="margin: 20px 0 20px 0;">

@foreach ($inversoresNuevos as $inversor)

    <input type="checkbox" value=<?php echo($inversor->id) ?> name=<?php echo("inversor-".$numeroInversor) ?> /> <?php echo($inversor->apellido . ", " . $inversor->nombre . " - " . $inversor->documento); ?> <br />

<?php $numeroInversor = $numeroInversor + 1; ?>
@endforeach

</div>

<input type="hidden" value="{{$proyectoReferido->id}}" name="idProyecto" />

<button class="btn btn-success" type="submit" name="validarInversorAgregado">Añadir Inversor</button>
</form>

</div>
@endsection

@else
<php
header('refresh:0; url=/index');
?>
@endif
