@if (auth()->user()->isAdministrator())

  @extends('layout.headerAndFooter')
  @section('contenido')


  @if ($errors->all() != null)
  {{-- {{dd($errors->all())}} --}}
          <section class="erroresPostUser">
            @foreach ($errors->all() as $error)
                  <ul>
                      <li>{{ $error }}</li>
                      {{-- {{dd(<li>{{ $error }}</li>);}} --}}
                  </ul>
                @endforeach
          </section>
  @endif

  @if (isset($_POST['proyectoCreado']))

          <section class="postSatisfactorio" style=<?php if(isset($_POST['proyectoCreado'])) {?> "background-color: rgba(47, 175, 36, 0.4);" <?php } ?>>
            <ul>
              <li>El nuevo proyecto se ha subido correctamente.</li>
            </ul>
            {{-- <span class="postSatisfactorio">El nuevo desarrollo se ha subido correctamente.</span> --}}
          </section>

  @endif

      <h2 class="form-titulo" style="color: blue; padding-top: 10px; text-align:center;">Nuevo Desarrollo</h2>

@if($inversoresNuevos->all() == null) <h3 style="color: red; text-align:center;padding-top: 5px;padding-bottom: 20px;"><b>Debe crear un inversor nuevo antes de crear un desarrollo.</b></h3> @endif

<section class="contactar">
  <!-- <h3 class="contactenos" style=<php if($errors->all() != null || isset($_POST['proyectoCreado'])) {?> "padding-top: 0px;" <php } ?>> Nuevo Post </h3> -->
  <form class="contacto-form" action="{{ route('validarProyecto') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <label> Nombre de Desarrollo </label>
    <input type="text" name="nombre" required>
    <span class="erroresPost"><?php isset($error) ?></span>

    <label> Calle </label>
    <input type="text" name="calle" required>

    <label> Altura </label>
    <input type='number' name="altura" required>

    <label for="">Imagen de presentación:</label>
    <input type="file" name="imagenPresentacion" class="subir-imagen-presentacion" value="">
    <span class="error-imgPresentacion"></span>

    <label for="">Imagen de ubicación:</label>
    <input type="file" name="imagenUbicacion" class="subir-imagen-ubicacion" value="">
    <span class="error-imgUbicacion"></span>

    <label> Inversor </label>

    <?php $numeroInversor = 0; ?>

        <div class="container">
        @foreach ($inversoresNuevos as $inversor)

            <input type="checkbox" value=<?php echo($inversor->id) ?> name=<?php echo("inversor-".$numeroInversor) ?> /> <?php echo($inversor->apellido . ", " . $inversor->nombre . " - " . $inversor->documento); ?> <br />

        <?php $numeroInversor = $numeroInversor + 1; ?>
        @endforeach

        @foreach ($inversoresOcupados as $inversor)

            <input type="checkbox" value=<?php echo($inversor->id) ?> name=<?php echo("inversor-".$numeroInversor) ?> disabled/> <?php echo($inversor->apellido . ", " . $inversor->nombre . " - " . $inversor->documento . " (" . $listaProyectos[$inversor->project_id] . ")"); ?> <br />

        <?php $numeroInversor = $numeroInversor + 1; ?>
        @endforeach

    <?php $numeroInversor = 0; ?>

      </div>

    <div class="cleaner"></div>

    @if ($inversoresNuevos->all() != null)<button class="enviar" type="submit" name="proyectoCreado">Crear Desarrollo</button> @endif
    @if ($inversoresNuevos->all() == null)<button class="enviar" type="" name="proyectoCreado" disabled>Crear Desarrollo</button> @endif

  </form>
</section>


@endsection


@else
<php
header('refresh:0; url=/index');
?>
@endif
