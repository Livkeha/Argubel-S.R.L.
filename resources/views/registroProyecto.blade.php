@extends('layout.headerAndFooter')

  @section('contenido')

@if($errors->all() == null)
<h1 style=color:green>No hay errores nene!!</h1>
@endif

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
      <!-- {{dd($errors->all())}} -->
          <section class="postSatisfactorio" style=<?php if(isset($_POST['proyectoCreado'])) {?> "background-color: rgba(47, 175, 36, 0.4);" <?php } ?>>
            <ul>
              <li>Tu nuevo post se ha subido correctamente.</li>
            </ul>
            {{-- <span class="postSatisfactorio">Tu nuevo post se ha subido correctamente.</span> --}}
          </section>
  @endif

  <!-- {{-- <section class="mapa-instructivo" style=<php if($errors->all() != null) {?> "padding-top: 0px;" <php } ?>> --}} -->


<section class="contactar">
  <!-- <h3 class="contactenos" style=<php if($errors->all() != null || isset($_POST['proyectoCreado'])) {?> "padding-top: 0px;" <php } ?>> Nuevo Post </h3> -->
  <form class="contacto-form" action="{{ route('validarProyecto') }}" method="post">
    {{ csrf_field() }}
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
        @foreach ($inversores as $inversor)

            <input type="checkbox" value=<?php echo($inversor->id) ?> name=<?php echo("inversor-".$numeroInversor) ?> /> <?php echo($inversor->apellido . ", " . $inversor->nombre . " - " . $inversor->documento); ?> <br />

        <?php $numeroInversor = $numeroInversor + 1; ?>
        @endforeach

      <!-- <select name="inversor">
        @foreach ($inversores as $inversor)
        <option value=""><php echo ($inversor->nombre . ' ' . $inversor->apellido . " - " . $inversor->documento); ?></option>
        @endforeach
      </select>  -->

      </div>

    <div class="cleaner"></div>

    <button class="borrar" type="reset">Borrar</button>
    <button class="enviar" type="submit" name="proyectoCreado">Enviar</button>
  </form>
</section>


@endsection
