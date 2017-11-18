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

<li><img src="{{ url('data2/images/obra-residencial-07.jpg') }}" alt="residenciales07" title="residenciales07" id="wows1_6"/></li>
<li><img src="{{ url('data2/images/obra-residencial-08.jpg') }}" alt="residenciales08" title="residenciales08" id="wows1_7"/></li>
<li><img src="{{ url('data2/images/obra-residencial-09.jpg') }}" alt="residenciales09" title="residenciales09" id="wows1_8"/></li>
<li><img src="{{ url('data2/images/obra-residencial-10.jpg') }}" alt="residenciales10" title="residenciales10" id="wows1_9"/></li>
<li><img src="{{ url('data2/images/obra-residencial-11.jpg') }}" alt="residenciales11" title="residenciales11" id="wows1_10"/></li>
<li><img src="{{ url('data2/images/obra-residencial-13.jpg') }}" alt="residenciales12" title="residenciales12" id="wows1_12"/></li>
<li><img src="{{ url('data2/images/obra-residencial-14.jpg') }}" alt="residenciales12" title="residenciales12" id="wows1_13"/></li>
<li><img src="{{ url('data2/images/obra-residencial-12.jpg') }}" alt="residenciales12" title="residenciales12" id="wows1_11"/></li>
<li><img src="{{ url('data2/images/obra-residencial-01.jpg') }}" alt="residenciales01" title="residenciales01" id="wows1_0"/></li>
<li><img src="{{ url('data2/images/obra-residencial-02.jpg') }}" alt="residenciales02" title="residenciales02" id="wows1_1"/></li>
<li><img src="{{ url('data2/images/obra-residencial-03.jpg') }}" alt="residenciales03" title="residenciales03" id="wows1_2"/></li>
<li><img src="{{ url('data2/images/obra-residencial-04.jpg') }}" alt="residenciales04" title="residenciales04" id="wows1_3"/></li>
<li><img src="{{ url('data2/images/obra-residencial-05.jpg') }}" alt="residenciales05" title="residenciales05" id="wows1_4"/></li>
<li><img src="{{ url('data2/images/obra-residencial-06.jpg') }}" alt="residenciales06" title="residenciales06" id="wows1_5"/></li>

</ul></div>

<div class="ws_thumbs">
<div>

<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-07.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-08.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-09.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-10.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-11.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-13.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-14.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-12.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-01.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-02.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-03.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-04.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-05.jpg') }}" alt="" /></a>
<a href="#" title="residenciales01"><img src="{{ url('data2/tooltips/obra-residencial-06.jpg') }}" alt="" /></a>

</div>
</div>
	</div>
	<script type="text/javascript" src="{{ url('engine2/wowslider.js') }}"></script>
	<script type="text/javascript" src="{{ url('engine2/script.js') }}"></script>
	<!-- End WOWSlider.com BODY section -->

     </div>
	<!--/SLIDER-->

<div class="info-interior">
    	<div class="col-1"><h2 class="tit-submenu">Obra Residencial</h2></div>
        <div class="col-2">
        <p>Como constructora de obras Residenciales y de Arquitectura poseemos una sólida estructura de medios y tecnología que junto a nuestros proveedores y asesores da lugar a una producción integrada por lo que podemos resolver todo tipo de obras e instalaciones. La tranquilidad de comprobar que el proyecto se ha realizado tal y como estaba previsto.</p>
        <p>&nbsp;</p>
        <p>Contamos con los mejores profesionales para llevarlo a cabo, abordando cada obra con seriedad, eficacia y compromiso.</p>
        <p>&nbsp;</p>
        </div>
    </div>
    <!--/info-INTERIOR-->

  </div>
  <!--/INTERIOR-->

</section>
<!--/CONTENT-->

@endsection
