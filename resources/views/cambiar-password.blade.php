@extends('layout.headerAndFooter')
@section('contenido')

<script src="{{ asset('js/formModifyPass.js') }}"></script>

<h2>Cambiar Contraseña</h2>
@if($usuarioReferido->rol == "administrador")<h3>Administrador: {{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}</h3> @endif
@if($usuarioReferido->rol == "cliente")<h3>Inversor: {{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}</h3> @endif

DNI: {{$usuarioReferido->documento}}

  <form id="formModifyPass" class="form-registro" action="/passwordModificada/{{$usuarioReferido->id}}" method="POST">

    {{ csrf_field() }}

  <label> Nueva contraseña: </label>
  <input id="password" type="password" name="password"class="input-48"> <div class="erroresNewUserJS" id="errorPassword"> <span id="spanPassword"></span></div>

  <label> Confirmar nueva contraseña: </label>
  <input id="cpassword" type="password" name="" class="input-48"> <div class="erroresNewUserJS" id="errorCPassword"> <span id="spanCPassword"></span></div>

  <button class="boton-enviar" type="submit" name="password-cambiada" value"Enviar">Cambiar Contraseña</button>

</form>

@endsection
