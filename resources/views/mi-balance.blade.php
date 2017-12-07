@if (auth()->user()->isAdministrator())

@extends('layout.headerAndFooter')
@section('contenido')


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <section class="postsPaginados">

          {{-- dd($cuotasReferidas) --}}

        {{-- @if ($balance->first() != null) --}}

        {{--  dd($cuotas->all()) --}}

        @if (Session::has('proyectoActualizado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('proyectoActualizado') }}</h2>
        @endif

        @if (Session::has('montoEstablecidoModificado'))
           <h2 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('montoEstablecidoModificado') }}</h2>
        @endif

        @if (Session::has('fechaVencimientoActualizada'))
           <h1 class="alert alert-info" style="color:black; text-align: center;">{{ Session::get('fechaVencimientoActualizada') }}</h1>
        @endif

        {{-- {{dd($proyectoReferido)}} --}}

        <h2 class="form-titulo" style="color: blue; text-align:center;">Balance - Desarrollo: {{ $proyectoReferido->nombre }}</h2>

      <h4 style="color: red; text-align:center;"><b>Valor de la cuota establecido al día {{ \Carbon\Carbon::now()->format('d/m/Y') }}: ${{ $proyectoReferido->monto_establecido }}.</b></h4>

        <div class="container" style="height:502px; width:100%;">
          <div class="responsive-table">

            {{  $periodoTotal->links('paginador-balance') }}

            <table class="table table-hover" style="table-layout: fixed; width: 100%; height:100px;">
                <thead>
                  <tr>

                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Valor de Cuota</th>
                    <th style="text-align: center;">Fecha de Vencimiento</th>
                    <th style="text-align: center;">Monto Pagado</th>
                    <th style="text-align: center;">Fecha Pagado</th>
                    <th style="text-align: center;">Balance</th>
                    @role('Administrador') @if (Auth::check()) <th style="text-align: center;">Acciones</th> @endif @endrole
                  <tr>
                </thead>

                <tbody>
                  <?php $color = 0; ?>


                      <?php $color = $color + 1; ?>

                </tbody>
            </table>
            {{  $periodoTotal->links('paginador-balance') }}
            {{--  $months->render() --}}
            {{-- $proyectos->links() --}}
            {{-- {{ $proyectos->render() }} --}}
          </div>
        </div>

    {{--  @endif --}}
      @endif
      </section>

@endsection
