<?php

$proyectoReferido = DB::table('projects')->where('id', '=', "$proyectoId")->first();

$creacionDelProyecto = $proyectoReferido->created_at;

$anioProyecto = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $creacionDelProyecto)->year;

$anioFinProyecto = $anioProyecto + 11;

$fechaProyecto  = '01/01/' . $anioProyecto;
$fechaFinProyecto  = '01/01/' . $anioFinProyecto;
$format = 'd/m/Y';

$start    = DateTime::createFromFormat($format, $fechaProyecto); // Today date   // EL START ES LA FECHA DE CREACIÓN DEL PROYECTO.

$end      = DateTime::createFromFormat($format, $fechaFinProyecto); // Create a datetime object from your Carbon object   // EL FINAL ES UN AÑO DESPUÉS (¿O 10?).

$interval = DateInterval::createFromDateString('1 year'); // 1 month interval  // ESTE ES EL INTERVALO, ESTÁ PERFECTO.

$period   = new DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period // HAY QUE PAGINAR CADA 12 ELEMENTOS.

$periodoTotal = array();

foreach ($period as $dt) {
    $periodoTotal[] = $dt->format("Y");
}

$anioActual = $anioProyecto - 1;

 ?>


@if ($paginator->hasPages())
    <ul class="pager">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>Inicio</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Atras</a></li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                  @foreach($periodoTotal as $mes => $value)
                    <?php $anioActual = $anioActual + 1;   ?>
                    <?php break;  ?>
                  @endforeach
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a></li>
        @else
            <li class="disabled"><span>Fin</span></li>
        @endif
    </ul>
@endif
