@extends('layout.headerAndFooter')
@section('contenido')
<script src="{{ asset('js/formModifyPass.js') }}"></script>


@role('Cliente')
@if($usuarioReferido->rol == "cliente" && $usuarioReferido->primer_logueo == false)

<h1 style="color:blue; text-align:center">{{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}, ¡Bienvenido al sistema de Argubel S.R.L.!</h1>
<h2 style="color:blue; text-align:center">Por motivos de seguridad, le recomendamos cambiar la contraseña que previamente le fue asignada.</h2>
<br><br><br><br>




@endif
@endrole

@role('Administrador')
<h2 style="padding-top: 10px; text-align:center;"><span class="label label-danger">Cambiar Contraseña</span></h2>
{{-- <h2 style="color:red; text-align:center">Cambiar Contraseña</h2> --}}
<div class="bg-primary text-white" style="width: 20%; border-radius: 5px;">
	<div style="margin: 10px; padding: 10px;">

			@if($usuarioReferido->rol == "administrador")<h4 style="">Administrador: {{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}</h4> @endif
			@if($usuarioReferido->rol == "cliente")<h4 style="">Inversor: {{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}</h4> @endif

			<h5 style="">DNI: {{$usuarioReferido->documento}} </h5>

	</div>
</div>


@endrole

<section class="container" style="margin-top: 70px;">

  <form id="formModifyPass" class="form" action="/passwordModificada/{{$usuarioReferido->id}}" method="POST">

    {{ csrf_field() }}

		<div class="form-group">
			<h3><span class="label label-primary">Nueva contraseña:</span></h3>
			<input id="password" type="password" name="password"class="form-control"> <div class="erroresNewUserJS" id="errorPassword"> <span id="spanPassword"></span></div>
		</div>

		<div class="form-group">
			<h3><span class="label label-primary">Confirmar nueva contraseña:</span></h3>
			<input id="cpassword" type="password" name="" class="form-control"> <div class="erroresNewUserJS" id="errorCPassword"> <span id="spanCPassword"></span></div>
		</div>

  	<button class="btn btn-lg btn-success" type="submit" name="password-cambiada" value"Enviar">Cambiar Contraseña</button>

	</form>
</section>

@endsection
