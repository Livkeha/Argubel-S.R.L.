@if (auth()->user()->isAdministrator())

  @extends('layout.headerAndFooter')
  @section('contenido')


@if ($errors->all() != null)

        <section class="erroresPostUser">
          @foreach ($errors->all() as $clave => $valor)

                <ul>
                    <li>·   {{ $valor }}</li>
                </ul>
              @endforeach
        </section>
@endif

  @if (isset($_POST['proyectoCreado']))

          <section class="postSatisfactorio" style=<?php if(isset($_POST['proyectoCreado'])) {?> "background-color: rgba(47, 175, 36, 0.4);" <?php } ?>>
            <ul>
              <li>El nuevo proyecto se ha subido correctamente.</li>
            </ul>
            {{-- <span class="postSatisfactorio">El nuevo proyecto se ha subido correctamente.</span> --}}
          </section>

  @endif

@if($inversoresNuevos->all() == null) <h3 style="color: blue; text-align:center;"><b>Debe crear un inversor nuevo antes de crear un proyecto.</b></h3> @endif

<section class="contactar">
  <!-- <h3 class="contactenos" style=<php if($errors->all() != null || isset($_POST['proyectoCreado'])) {?> "padding-top: 0px;" <php } ?>> Nuevo Post </h3> -->
  <form class="contacto-form" action="{{ route('validarProyecto') }}" method="post">

    {{ csrf_field() }}

    <h3 class="form-titulo" style=<?php if($errors->all() != null) {?> "padding-top: 0px;" <?php } ?>>Nuevo Proyecto</h3>

    <label> Nombre de Proyecto </label>
    <input type="text" name="nombre" required>
    <span class="erroresPost"><?php isset($error) ?></span>

    <label> Calle </label>
    <input type="text" name="calle" required>

    <label> Altura </label>
    <input type='number' name="altura" required>

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

    @if ($inversoresNuevos->all() != null)<button class="enviar" type="submit" name="proyectoCreado">Crear Proyecto</button> @endif
    @if ($inversoresNuevos->all() == null)<button class="enviar" type="" name="proyectoCreado" disabled>Crear Proyecto</button> @endif
  </form>
</section>


@endsection


@else
<php
header('refresh:0; url=/index');
?>
@endif
