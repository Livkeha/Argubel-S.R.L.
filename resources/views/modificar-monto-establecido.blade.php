@extends('layout.headerAndFooter')
@section('contenido')

<script src="{{ asset('js/formModifyFee.js') }}"></script>

<h2 class="form-titulo" style="padding-top: 50px; text-align:center;"><span class="label label-warning">Modificar el monto de cuota establecido para el desarrollo "{{$proyectoReferido->nombre}}".</span></h2>
{{-- <h2 style="color:blue; text-align:center">Modificar el monto de cuota establecido para el desarrollo "{{$proyectoReferido->nombre}}".</h2> --}}

  <form id="formModifyFee" class="form margen-100" action="/montoEstablecidoModificado/{{$proyectoReferido->id}}" method="POST">
		<div class="form-group">
			{{ csrf_field() }}

			{{-- <label> Nuevo valor de cuota: </label> --}}
			<h3><span class="label label-warning">Nuevo valor de cuota:</span></h3>
			<input id="cuota" type="number" name="cuota" class="form-control">
			<div class="erroresNewUserJS" id="errorCuota" role="alert" style="text-align:center; margin-top: 10px; background-color: #f2dede;">
				<span id="spanCuota" class="color-rojo"></span>
			</div>
			{{-- <div class="erroresNewUserJS" id="errorCuota"> <span id="spanCuota"></span></div> --}}

			<button class="btn btn-success" type="submit" name="monto-establecido-cambiado" value"Enviar">Actualizar Monto</button>

		</div>

</form>

@endsection
