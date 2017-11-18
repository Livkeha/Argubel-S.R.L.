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
    
<li><img src="{{ url('data2/images/obra-comercial-01.jpg') }}" alt="conercial02" title="conercial02" id="wows2_0"/></li>
<li><img src="{{ url('data2/images/obra-comercial-02.jpg') }}" alt="conercial03" title="conercial03" id="wows2_1"/></li>
<li><img src="{{ url('data2/images/obra-comercial-03.jpg') }}" alt="conercial08" title="conercial08" id="wows2_2"/></li>
<li><img src="{{ url('data2/images/obra-comercial-04.jpg') }}" alt="conercial04" title="conercial04" id="wows2_3"/></li>
<li><img src="{{ url('data2/images/obra-comercial-05.jpg') }}" alt="conercial05" title="conercial05" id="wows2_4"/></li>
<li><img src="{{ url('data2/images/obra-comercial-06.jpg') }}" alt="conercial06" title="conercial06" id="wows2_5"/></li>
<li><img src="{{ url('data2/images/obra-comercial-07.jpg') }}" alt="conercial07" title="conercial07" id="wows2_6"/></li>
<li><img src="{{ url('data2/images/obra-comercial-08.jpg') }}" alt="conercial01" title="conercial01" id="wows2_7"/></li>
<li><img src="{{ url('data2/images/obra-comercial-09.jpg') }}" alt="conercial09" title="conercial09" id="wows2_8"/></li>
<li><img src="{{ url('data2/images/obra-comercial-10.jpg') }}" alt="conercial10" title="conercial10" id="wows2_9"/></li>
<li><img src="{{ url('data2/images/obra-comercial-11.jpg') }}" alt="conercial11" title="conercial11" id="wows2_10"/></li>
<li><img src="{{ url('data2/images/obra-comercial-12.jpg') }}" alt="conercial12" title="conercial12" id="wows2_11"/></li>
</ul></div>
<div class="ws_thumbs">
<div>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-01.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-02.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-03.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-04.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-05.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-06.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-07.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-08.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-09.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-10.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-11.jpg') }}" alt="" /></a>
<a href="#" title="conercial02"><img src="{{ url('data2/tooltips/obra-comercial-12.jpg') }}" alt="" /></a>

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
    	  <h2 class="tit-submenu">Obra Comercial</h2></div>
        <div class="col-2">
        <p>Nuestro grupo de profesionales se encuentra capacitado para lograr la más alta calidad.</p>
        <p>Estamos especializados tanto en el acondicionamiento e implantación de oficinas, locales comerciales y remodelación de las mismas como también en la construcción de obra nueva.</p>
        <p>La supervisión constante permite en nuestros trabajos mantener una alta eficiencia con un sello particular que nuestros clientes agradecen, trabajando estrechamente y garantizando la calidad y la rapidez de la ejecución en los proyectos.<br>
      </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </div>
    </div>
    <!--/info-INTERIOR-->

  </div>
  <!--/INTERIOR-->

</section>
<!--/CONTENT-->

@endsection
