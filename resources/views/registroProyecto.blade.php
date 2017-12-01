@if (auth()->user()->isAdministrator())

  @extends('layout.headerAndFooter')
  @section('contenido')

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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

<section class="container">
  <!-- <h3 class="contactenos" style=<php if($errors->all() != null || isset($_POST['proyectoCreado'])) {?> "padding-top: 0px;" <php } ?>> Nuevo Post </h3> -->
  <form class="form" action="{{ route('validarDesarrollo') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group"> 
      <label class="control-label col-md-2 bg-info"> Nombre de Desarrollo </label> 
      <input class="form-control" type="text" name="nombre" required> 
      <span class="erroresPost"><?php isset($error) ?></span> 
    </div> 
     
    <div class="form-group"> 
      <label class="control-label col-sm-2"> Calle </label> 
      <input class="form-control" type="text" name="calle" required> 
    </div> 
     
    <div class="form-group"> 
      <label class="control-label col-sm-2"> Altura </label> 
      <input class="form-control" type='number' name="altura" required> 
    </div> 
     
    <div class="form-group"> 
      <label class="control-label col-md-2" for="">Imagen de presentación:</label> 
      <input type="file" name="imagenPresentacion" class="file" value=""> 
      <span class="error-imgPresentacion"></span> 
    </div> 

    <div class="form-group"> 
      <label class="control-label col-md-2" for="">Imagen de ubicación:</label> 
      <input type="file" name="imagenUbicacion" class="file" value=""> 
      <span class="error-imgUbicacion"></span> 
    </div> 
     
    <div class="form-group"> 
      <label class="control-label col-md-2"> Descripción </label> 
      <textarea type='textarea' name="descripcion" required></textarea> 
    </div> 
     
 
    <label class="control-label col-sm-2"> Inversor </label> 

    <?php $numeroInversor = 0; ?>

        <div class="container-inversores">
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
