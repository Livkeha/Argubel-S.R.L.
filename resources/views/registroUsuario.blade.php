@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')
				
        <script src="{{ asset('js/formNewUser.js') }}"></script>

        @if (isset($usuarioCreado))

                <section class="postSatisfactorio" style=<?php if(isset($usuarioCreado)) {?> "background-color: rgba(47, 175, 36, 0.4);" <?php } ?>>
									<div class="alert alert-success" role="alert">
										<h4>
											<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
											<strong>El nuevo usuario se ha creado correctamente!</strong>
										</h4>
									</div>
                  {{-- <ul>
                    <li>El nuevo usuario se ha creado correctamente.</li>
                  </ul> --}}
                  {{-- <span class="postSatisfactorio">El nuevo usuario se ha creado correctamente.</span> --}}
                </section>

        @endif
						<h2 style="padding-top: 10px; text-align:center;"><span class="label label-primary">Nuevo Usuario</span></h2>
            {{-- <h2 class="form-titulo" style="color: blue; padding-top: 10px; text-align:center;">Nuevo Usuario</h2> --}}
				<section class="container">
        	<form id="formNewUser" class="form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">

          {{ csrf_field() }}

            <div class="form-group">
							<h3><span class="label label-info">Nombre:</span></h3>
              <input id="nombre" type="text" name="nombre" placeholder="" class="form-control" value=""> <div class="erroresNewUserJS" id="errorNombre"><span id="spanNombre"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Apellido:</span></h3>
							<input id="apellido" type="text" name="apellido" placeholder="" class="form-control" value=""> <div class="erroresNewUserJS" id="errorApellido"><span id="spanApellido"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Documento de Identidad:</span></h3>
							<input id="documento" type="text" name="documento" placeholder="" class="form-control" value=""> <div class="erroresNewUserJS" id="errorDocumento"><span id="spanDocumento"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Teléfono:</span></h3>
							<input id="telefono" type="text" name="telefono" placeholder="" class="form-control" value=""><div class="erroresNewUserJS" id="errorTelefono"> <span id="spanTelefono"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Correo electrónico:</span></h3>
							<input id="correo" type="email" name="email" placeholder="" class="form-control" value=""><div class="erroresNewUserJS" id="errorCorreo"> <span id="spanCorreo"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Contraseña:</span></h3>
							<input id="password" type="password" name="password" placeholder="" class="form-control"> <div class="erroresNewUserJS" id="errorPassword"> <span id="spanPassword"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Confirmar contraseña:</span></h3>
							<input id="cpassword" type="password" name="" placeholder="" class="form-control"> <div class="erroresNewUserJS" id="errorCPassword"> <span id="spanCPassword"></span></div>
						</div>

						<div class="form-group">
							<h3><span class="label label-info">Rol:</span></h3>
							<select name="rol" required class="form-control">
								<option disabled selected value> -- Seleccione un Rol -- </option>
								<option value="administrador">Administrador</option>
								<option value="cliente">Cliente</option>
							</select>
						</div>

                <input type="text" name="errors" value="<?$errors?>" hidden="">

                <button class="btn btn-lg btn-success" type="submit" name="usuario-registrado" value"Enviar">Registrar Usuario</button>
                <div class="cleaner"></div>

        	</form>
				</section>


@endsection
@if ($errors->all() != null)
  {{-- {{dd($errors->all())}} --}}
        <section class="erroresPostUser">
          @foreach ($errors->all() as $error)
                <ul>
                    <li style='font-size:40px; color:red'>{{ $error }}</li>
                    {{-- {{dd(<li>{{ $error }}</li>);}} --}}
                </ul>
              @endforeach
        </section>
@endif

@else
<php
header('refresh:0; url=/index');
?>
@endif
