@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')

        <script src="{{ asset('js/formNewUser.js') }}"></script>

        <form id="formNewUser" class="form-registro" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">

          {{ csrf_field() }}

            <h3 class="form-titulo" style=<?php if($errors->all() != null) {?> "padding-top: 0px;" <?php } ?>>Nuevo Usuario</h3>

            <div class="container-inputs">

                <label> Nombre: </label>
                <input id="nombre" type="text" name="nombre" placeholder="" class="input-48" value=""> <div class="erroresNewUserJS" id="errorNombre"><span id="spanNombre"></span></div>

                <label> Apellido: </label>
                <input id="apellido" type="text" name="apellido" placeholder="" class="input-48" value=""> <div class="erroresNewUserJS" id="errorApellido"><span id="spanApellido"></span></div>

                <label> Documento de Identidad: </label>
                <input id="documento" type="text" name="documento" placeholder="" class="input-100" value=""> <div class="erroresNewUserJS" id="errorDocumento"><span id="spanDocumento"></span></div>

                <label> Teléfono: </label>
                <input id="telefono" type="text" name="telefono" placeholder="" class="input-48" value=""><div class="erroresNewUserJS" id="errorTelefono"> <span id="spanTelefono"></span></div>

                <label> Correo electrónico: </label>
                <input id="correo" type="email" name="email" placeholder="" class="input-100" value=""><div class="erroresNewUserJS" id="errorCorreo"> <span id="spanCorreo"></span></div>

                <label> Contraseña: </label>
                <input id="password" type="password" name="password" placeholder="" class="input-48"> <div class="erroresNewUserJS" id="errorPassword"> <span id="spanPassword"></span></div>

                <label> Confirmar contraseña: </label>
                <input id="cpassword" type="password" name="" placeholder="" class="input-48"> <div class="erroresNewUserJS" id="errorCPassword"> <span id="spanCPassword"></span></div>

                <input type="text" name="errors" value="<?$errors?>" hidden="">


                <button class="boton-enviar" type="submit" name="usuario-registrado" value"Enviar">Registrar Usuario</button>
                  <div class="cleaner"></div>
                </div>
            </div>
        </form>

@endsection

@else
<php
header('refresh:0; url=/index');
?>
@endif
