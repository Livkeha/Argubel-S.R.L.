@extends('layout.headerAndFooter')
@section('contenido')

<script src="{{ asset('js/formModifyFee.js') }}"></script>

<h2 style="color:blue; text-align:center">Modificar el monto de cuota establecido para el desarrollo "{{$proyectoReferido->nombre}}".</h2>

  <form id="formModifyFee" class="form-registro" action="/montoEstablecidoModificado/{{$proyectoReferido->id}}" method="POST">

    {{ csrf_field() }}

  <label> Nuevo valor de cuota: </label>
    <input id="cuota" type="number" name="cuota" class="input-48"> <div class="erroresNewUserJS" id="errorCuota"> <span id="spanCuota"></span></div>

  <button class="boton-enviar" type="submit" name="monto-establecido-cambiado" value"Enviar">Actualizar Monto</button>

</form>

@endsection
