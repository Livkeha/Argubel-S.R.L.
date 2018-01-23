@if (auth()->user()->isAdministrator())

  @extends('layout.headerAndFooter')
  @section('contenido')



  @if ($errors->all() != null)
  {{-- {{dd($errors->all())}} --}}
          <section class="erroresPostUser">
            @foreach ($errors->all() as $error)
                  <ul>
                      <li>
												<div class="alert alert-danger" role="alert" style="text-align:center;margin-top: 10px;">
													<h5>
														<span class="glyphicon glyphicon-exclamation-sign color-rojo" aria-hidden="true"></span>
														<span class="sr-only">Error:</span>
														<strong>{{ $error }}!</strong>
													</h5>
												</div>
											</li>
                      {{-- {{dd(<li>{{ $error }}</li>);}} --}}
                  </ul>
                @endforeach
          </section>
  @endif

  @if (isset($_POST['proyectoCreado']))

          <section class="postSatisfactorio">
						<div class="alert alert-success" role="alert">
							<h4>
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								<strong>El nuevo desarrollo se ha creado correctamente!</strong>
							</h4>
						</div>
            {{-- <ul>
              <li>El nuevo proyecto se ha subido correctamente.</li>
            </ul> --}}
            {{-- <span class="postSatisfactorio">El nuevo desarrollo se ha subido correctamente.</span> --}}
          </section>

  @endif
			<h2 class="margen-50" style="padding-top: 10px; text-align:center;"><span class="label label-default">Nuevo Desarrollo</span></h2>
      {{-- <h2 class="form-titulo" class="text-info" style="padding-top: 10px; text-align:center;">Nuevo Desarrollo</h2> --}}

@if($inversoresNuevos->all() == null)
	<div class="alert alert-danger" role="alert" style="text-align:center;margin-top: 10px;">
		<h4>
			<span class="glyphicon glyphicon-exclamation-sign color-rojo" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<strong>Debe crear un inversor nuevo antes de crear un desarrollo!</strong>
		</h4>
	</div>
	{{-- <h3 class="text-danger" style="text-align:center;padding-top: 5px;padding-bottom: 20px;"><b>Debe crear un inversor nuevo antes de crear un desarrollo.</b></h3>  --}}
@endif


<section class="container margen-100">
  <!-- <h3 class="contactenos" style=<php if($errors->all() != null || isset($_POST['proyectoCreado'])) {?> "padding-top: 0px;" <php } ?>> Nuevo Post </h3> -->
  <form class="form" action="{{ route('validarDesarrollo') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
			<h3><span class="label label-info">Nombre de Desarrollo:</span></h3>
      {{-- <label class="control-label col-md-2 bg-secondary text-white"> Nombre de Desarrollo: </label> --}}
      <input class="form-control" type="text" name="nombre" required @if ($inversoresNuevos->all() == null) disabled @endif>
      <span class="erroresPost"><?php isset($error) ?></span>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Calle:</span></h3>
      {{-- <label class="control-label col-sm-2 bg-secondary text-info"> Calle: </label> --}}
      <input class="form-control" type="text" name="calle" required @if ($inversoresNuevos->all() == null) disabled @endif>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Altura:</span></h3>
      {{-- <label class="control-label col-sm-2 bg-secondary text-info"> Altura: </label> --}}
      <input class="form-control" type='number' name="altura" required  @if ($inversoresNuevos->all() == null) disabled @endif>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Localidad:</span></h3>
      {{-- <label class="control-label col-sm-2 bg-secondary text-info"> Localidad: </label> --}}
      <input class="form-control" type='text' name="localidad" required  @if ($inversoresNuevos->all() == null) disabled @endif>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Monto inicial de cuota establecido:</span></h3>
      {{-- <label class="control-label col-sm-4 bg-secondary text-info"> Monto inicial de cuota establecido: </label> --}}
      <input class="form-control" type='number' name="monto_establecido" required  @if ($inversoresNuevos->all() == null) disabled @endif>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Imagen de presentación:</span></h3>
      {{-- <label class="control-label col-md-3 bg-secondary text-info" for="">Imagen de presentación:</label> --}}
      <input type="file" name="imagenPresentacion" class="file" value="" @if ($inversoresNuevos->all() == null) disabled @endif>
      <span class="error-imgPresentacion"></span>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Imagen de ubicación:</span></h3>
      {{-- <label class="control-label col-md-2 bg-secondary text-info" for="">Imagen de ubicación:</label> --}}
      <input type="file" name="imagenUbicacion" class="file" value="" @if ($inversoresNuevos->all() == null) disabled @endif>
      <span class="error-imgUbicacion"></span>
    </div>

    <div class="form-group">
			<h3><span class="label label-info">Descripción:</span></h3>
      {{-- <label class="control-label col-md-2 bg-secondary text-info"> Descripción: </label> --}}
      <textarea type='textarea' name="descripcion" rows="10" style="min-width: 100%;" required @if ($inversoresNuevos->all() == null) disabled @endif></textarea>
    </div>

		<h3><span class="label label-info">Inversor:</span></h3>
    {{-- <label class="control-label col-sm-2 bg-secondary text-info"> Inversor: </label> --}}

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

    @if ($inversoresNuevos->all() != null)<button style="margin-top: 50px" class="btn btn-lg btn-success" type="submit" name="proyectoCreado">Crear Desarrollo</button> @endif
    @if ($inversoresNuevos->all() == null)<button class="btn btn-lg btn-success" type="" name="proyectoCreado" disabled>Crear Desarrollo</button> @endif

  </form>
</section>


@endsection


@else
<php
header('refresh:0; url=/index');
?>
@endif
