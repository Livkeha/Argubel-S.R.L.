@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')

<h1 style="color:red; text-align:center;">Agregar Inversor</h1>
<h3 style="color:red; text-align:center;">Seleccione los inversores deseados para el proyecto "{{$proyectoReferido->nombre}}"</h3>

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

        <section class="postSatisfactorio" style=<?php if(isset($proyectoActualizado)) {?> "background-color: rgba(47, 175, 36, 0.4);" <?php } ?>>
          <ul>
            <li>El proyecto "{{$proyectoReferido->nombre}}" se ha actualizado correctamente.</li>
          </ul>
          {{-- <span class="postSatisfactorio">El proyecto se ha actualizado correctamente.</span> --}}
        </section>

@endif

<form class="contacto-form" action="{{ route('validarInversorAgregado') }}" method="post">

  {{ csrf_field() }}

<?php $numeroInversor = 0; ?>

<div class="container">

@foreach ($inversoresNuevos as $inversor)

    <input type="checkbox" value=<?php echo($inversor->id) ?> name=<?php echo("inversor-".$numeroInversor) ?> /> <?php echo($inversor->apellido . ", " . $inversor->nombre . " - " . $inversor->documento); ?> <br />

<?php $numeroInversor = $numeroInversor + 1; ?>
@endforeach

</div>

<input type="hidden" value="{{$proyectoReferido->id}}" name="idProyecto" />

<button class="enviar" type="submit" name="validarInversorAgregado">Añadir Inversor</button>
</form>

@endsection

@else
<php
header('refresh:0; url=/index');
?>
@endif
