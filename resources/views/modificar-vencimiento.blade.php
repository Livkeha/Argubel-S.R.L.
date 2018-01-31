@extends('layout.headerAndFooter')
@section('contenido')

<h2 class="form-titulo" style="padding-top: 20px; text-align:center;"><span class="label label-warning">Modificar la fecha de vencimiento de "{{$usuarioReferido->nombre}} {{$usuarioReferido->apellido}}" para el desarrollo "{{$desarrolloReferido->nombre}}".</span></h2>

<h3 class="form-titulo" style="padding-top: 10px; text-align:center;"><span class="label label-success">Valor de cuota: $ {{$usuarioReferido->monto_establecido}}</h3>

@if($usuarioReferido->dia_vencimiento != null) <h3 class="form-titulo" style="text-align:center;"><span class="label label-danger">Fecha de vencimiento actual: {{$usuarioReferido->dia_vencimiento}} de {{ucfirst($usuarioReferido->mes_vencimiento)}} de {{$usuarioReferido->anio_vencimiento}}.</h3> @endif

@if($usuarioReferido->dia_vencimiento == null) <h3 class="form-titulo" style="text-align:center;"><span class="label label-danger"><i>Aun sin fecha de vencimiento asignada.</i></h3> @endif

  <form id="formModifyExpiration" class="form margen-100" action="/vencimientoModificado/{{$usuarioReferido->id}}" method="POST">
		<div class="form-group">

			{{ csrf_field() }}

			<h3><span class="label label-warning">Nueva fecha de vencimiento:</span></h3>

      {!! Form::open(array('route' => array('vencimientoModificado', $usuarioReferido->id))) !!}

      <?php echo Form::token(); ?>


      <label> Dia: </label>
      <select name="dia_vencimiento" required>
        <option disabled selected value> -- Seleccione un Dia -- </option>
        @foreach($diasDelMes as $dia)
        <option value="{{$dia}}">{{$dia}}</option>
        @endforeach
      </select>

      <label> Mes: </label>
      <select name="mes_vencimiento" required>
        <option disabled selected value> -- Seleccione un Mes -- </option>
        <option value="enero">Enero</option>
        <option value="febrero">Febrero</option>
        <option value="marzo">Marzo</option>
        <option value="abril">Abril</option>
        <option value="mayo">Mayo</option>
        <option value="junio">Junio</option>
        <option value="julio">Julio</option>
        <option value="agosto">Agosto</option>
        <option value="septiembre">Septiembre</option>
        <option value="octubre">Octubre</option>
        <option value="noviembre">Noviembre</option>
        <option value="diciembre">Diciembre</option>
      </select>

      <label> Año: </label>
      <select name="anio_vencimiento" required>
        <option disabled selected value> -- Seleccione un Año -- </option>
        @foreach($periodoTotal as $anio)
        <option value="{{$anio}}">{{$anio}}</option>
        @endforeach
      </select>

        {{ Form::close() }}

			<button class="btn btn-success" type="submit" name="vencimiento-cambiado" value"Enviar">Actualizar Fecha de Vencimiento</button>

		</div>

</form>

@endsection
