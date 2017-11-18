@extends('layout.headerAndFooter')
@section('contenido')

@section('obras')
<link rel="stylesheet" type="text/css" href="{{ asset('../engine2/style.css') }}" />
<script type="text/javascript" src="{{ url('engine2/jquery.js') }}"></script>
@endsection


<!--CONTENT-->
<section id="content">

  <div class="interior">

    <div class="slider">

    	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>

<li><img src="{{ url('data2/images/obra-publica-08.jpg') }}" alt="publicas01" title="publicas" id="wows1_7"/></li>
<li><img src="{{ url('data2/images/obra-publica-09.jpg') }}" alt="publicas01" title="publicas" id="wows1_8"/></li>
<li><img src="{{ url('data2/images/obra-publica-10.jpg') }}" alt="publicas01" title="publicas" id="wows1_9"/></li>
<li><img src="{{ url('data2/images/obra-publica-11.jpg') }}" alt="publicas01" title="publicas" id="wows1_10"/></li>
<li><img src="{{ url('data2/images/obra-publica-12.jpg') }}" alt="publicas01" title="publicas" id="wows1_11"/></li>
<li><img src="{{ url('data2/images/obra-publica-13.jpg') }}" alt="publicas01" title="publicas" id="wows1_12"/></li>
<li><img src="{{ url('data2/images/obra-publica-14.jpg') }}" alt="publicas01" title="publicas" id="wows1_13"/></li>
<li><img src="{{ url('data2/images/obra-publica-15.jpg') }}" alt="publicas01" title="publicas" id="wows1_14"/></li>
<li><img src="{{ url('data2/images/obra-publica-16.jpg') }}" alt="publicas01" title="publicas" id="wows1_15"/></li>
<li><img src="{{ url('data2/images/obra-publica-17.jpg') }}" alt="publicas01" title="publicas" id="wows1_16"/></li>
<li><img src="{{ url('data2/images/obra-publica-18.jpg') }}" alt="publicas01" title="publicas" id="wows1_17"/></li>
<li><img src="{{ url('data2/images/obra-publica-19.jpg') }}" alt="publicas01" title="publicas" id="wows1_18"/></li>
<li><img src="{{ url('data2/images/obra-publica-20.jpg') }}" alt="publicas01" title="publicas" id="wows1_19"/></li>
<li><img src="{{ url('data2/images/obra-publica-01.jpg') }}" alt="publicas01" title="publicas" id="wows1_0"/></li>
<li><img src="{{ url('data2/images/obra-publica-02.jpg') }}" alt="publicas01" title="publicas" id="wows1_1"/></li>
<li><img src="{{ url('data2/images/obra-publica-03.jpg') }}" alt="publicas01" title="publicas" id="wows1_2"/></li>
<li><img src="{{ url('data2/images/obra-publica-04.jpg') }}" alt="publicas01" title="publicas" id="wows1_3"/></li>
<li><img src="{{ url('data2/images/obra-publica-05.jpg') }}" alt="publicas01" title="publicas" id="wows1_4"/></li>
<li><img src="{{ url('data2/images/obra-publica-06.jpg') }}" alt="publicas01" title="publicas" id="wows1_5"/></li>
<li><img src="{{ url('data2/images/obra-publica-07.jpg') }}" alt="publicas01" title="publicas" id="wows1_6"/></li>

</ul></div>
<div class="ws_thumbs">
<div>

<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-08.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-09.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-10.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-11.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-12.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-13.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-14.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-15.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-16.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-17.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-18.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-19.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-20.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-01.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-02.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-03.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-04.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-05.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-06.jpg') }}" alt="" /></a>
<a href="#" title="publicas"><img src="{{ url('data2/tooltips/obra-publica-07.jpg') }}" alt="" /></a>


</div>
</div>
	</div>
	<script type="text/javascript" src="{{ url('engine2/wowslider.js') }}"></script>
	<script type="text/javascript" src="{{ url('engine2/script.js') }}"></script>
	<!-- End WOWSlider.com BODY section -->

     </div>
	<!--/SLIDER-->

<div class="info-interior">
    	<div class="col-1">
    	  <h2 class="tit-submenu">Obra Pública</h2></div>
        <div class="col-2">
        <p>Estamos capacitados para poder resolver las más variadas resoluciones tecnológicas y de ingeniería, junto con nuestros profesionales, asesores internos-externos y proveedores.<br>
          La profesionalidad como conducta junto con la innovación permanente permite obtener los mejores resultados. La apuesta por la satisfacción del cliente y el espíritu continuo de mejora se concreta en el proyecto, bajo estos fundamentos nuestro grupo de profesionales llevan adelante la obra para poder brindarle las mejores soluciones técnicas y operativas.</p>
        <p>Podemos intervenir en la construcción, ampliación y remodelación de obras industriales como: Puentes, Mobiliario Urbano, Señalización, Vados, Veredas, Parquización, etc.</p>
        </div>
    </div>
    <!--/info-INTERIOR-->

  </div>
  <!--/INTERIOR-->

</section>
<!--/CONTENT-->

@endsection
