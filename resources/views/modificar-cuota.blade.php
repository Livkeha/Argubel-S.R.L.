@extends('layout.headerAndFooter')
@section('contenido')

<script src="{{ asset('js/formModifyFee.js') }}"></script>

<h2 class="form-titulo" style="padding-top: 50px; text-align:center;"><span class="label label-warning">Modificar el valor de cuota de "{{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}" para el desarrollo "{{$desarrolloReferido->nombre}}".</span></h2>

@if($usuarioReferido->monto_establecido != null) <h3 class="form-titulo" style="text-align:center;"><span class="label label-danger">Valor de cuota actual: $ {{$usuarioReferido->monto_establecido}}.</h3> @endif

@if($usuarioReferido->monto_establecido == null) <h3 class="form-titulo" style="text-align:center;"><span class="label label-danger"><i>Aun sin valor de cuota asignado.</i></h3> @endif

  <form id="formModifyFee" class="form margen-100" action="/cuotaModificada/{{$usuarioReferido->id}}" method="POST">
		<div class="form-group">
			{{ csrf_field() }}

			{{-- <label> Nuevo valor de cuota: </label> --}}
			<h3><span class="label label-warning">Nuevo valor de cuota:</span></h3>
			<input id="cuota" type="number" name="cuota" class="form-control" placeholder="@if($usuarioReferido->monto_establecido == null) Inserte nuevo valor de cuota @else Valor actual: $ {{$usuarioReferido->monto_establecido}} @endif">
			<div class="erroresNewUserJS" id="errorCuota" role="alert" style="text-align:center; margin-top: 10px; background-color: #f2dede;">
				<span id="spanCuota" class="color-rojo"></span>
			</div>
			{{-- <div class="erroresNewUserJS" id="errorCuota"> <span id="spanCuota"></span></div> --}}

			<button class="btn btn-success" type="submit" name="monto-establecido-cambiado" value"Enviar">Actualizar Monto</button>

		</div>

</form>

@endsection
