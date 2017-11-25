@extends('layout.headerAndFooter')
@section('contenido')

<!--CONTENT-->
<!-- @if($errors->any())
<h1 style=color:red; text-align:center>{{$errors->first()}}</h1>
@endif -->

@if (Session::has('permisoDenegado'))
   <h1 class="alert alert-info" style="color:red; text-align: center;">{{ Session::get('permisoDenegado') }}</h1>
@endif

<section id="content">

  <div class="interior">

    <div class="slider">

    	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images">
    <ul>
		    <li><img src="{{ url('data1/images/slider01.jpg') }}" alt="slider-01" title="slider-01" id="wows1_0"/></li>
		    <li><img src="{{ url('data1/images/slider02.jpg') }}" alt="slider-02" title="slider-02" id="wows1_1"/></li>
		    <li><img src="{{ url('data1/images/slider03.jpg') }}" alt="slider-03" title="slider-03" id="wows1_2"/></li>
		    <li><img src="{{ url('data1/images/slider04.jpg') }}" alt="slider-04" title="slider-04" id="wows1_3"/></li>
        <li><img src="{{ url('data1/images/slider05.jpg') }}" alt="slider-05" title="slider-05" id="wows1_4"/></li>
        <li><img src="{{ url('data1/images/slider06.jpg') }}" alt="slider-06" title="slider-06" id="wows1_5"/></li>
        <li><img src="{{ url('data1/images/slider07.jpg') }}" alt="slider-07" title="slider-07" id="wows1_6"/></li>
        <li><img src="{{ url('data1/images/slider08.jpg') }}" alt="slider-08" title="slider-08" id="wows1_7"/></li>
        <li><img src="{{ url('data1/images/slider09.jpg') }}" alt="slider-09" title="slider-09" id="wows1_8"/></li>
        <li><img src="{{ url('data1/images/slider10.jpg') }}" alt="slider-10" title="slider-10" id="wows1_9"/></li>
	</ul>
	</div>
	</div>
	<script type="text/javascript" src="{{ url('engine1/wowslider.js') }}"></script>
	<script type="text/javascript" src="{{ url('engine1/script.js') }}"></script>
	<!-- End WOWSlider.com BODY section -->

    </div>
    <!--/SLIDER-->

    <div class="obras">

      <div class="obra-2">
         <div class="cabezal-obra">
          <h2><a href="{{ url('/obra-publica') }}">Obra Pública</a></h2>
          <div class="numero"> <img src="images/numero-1.png" alt=""/> </div>
        </div>
        <div class="content-obra">
        <a href="{{ url('/obra-publica') }}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('obra publica','','images/obra-publica-hover.png',1)"><img id="obra publica" src="images/obra-publica.png" alt=""></a></div>
      </div>

      <div class="obra-1">
        <div class="cabezal-obra">
          <h2><a href="{{ url('/obra-comercial') }}">Obra Comercial</a></h2>
          <div class="numero"> <img src="images/numero-2.png" alt=""/> </div>
        </div>
        <div class="content-obra"><a href="{{ url('/obra-comercial') }}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('obra comercial','','images/obra-comercial-hover.png',1)"><img id="obra comercial" src="images/obra-comercial.png" alt=""></a> </div>
      </div>


      <div class="obra-3 last">
         <div class="cabezal-obra">
          <h2><a href="{{ url('/obra-residencial') }}">Obra Residencial</a></h2>
          <div class="numero"> <img src="images/numero-3.png" alt=""/> </div>
        </div>
        <div class="content-obra"><a href="{{ url('/obra-residencial') }}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('obra Residencial','','images/obra-residencial-hover.png',1)"><img id="obra Residencial" src="images/obra-residencial.png" alt=""></a></div>
      </div>

     <div class="clear"></div>
    </div>
    <!--/OBRAS-->

<div class="info-interior">
    	<div class="col-1"><h2>Nuestras Obras<br>nos representan</h2></div>
        <div class="col-2">
        <p><strong>Argubel</strong> es una empresa Argentina de la Industria de la Construcción, creada con el objetivo de ofrecer a nuestros clientes un completo abanico de servicios, dedicada a proyectos de gran envergadura y particulares.<br>

Desde sus orígenes y hasta la actualidad, hemos ejecutado obras públicas y privadas de diferentes especialidades, lo que nos ha permitido convertirnos en una de las empresas de referencia dentro del sector capaz de lograr la mejor solución adaptada a la necesidad real del cliente, empleando para ello las últimas tecnologías en materia de construcción.<br>

Nos caracterizamos por nuestra amplia experiencia, por la responsabilidad con la que abordamos cada proyecto, el profesionalismo y conocimiento de las nuevas técnicas constructivas actuales y asumiendo un total compromiso en todos los aspectos y etapas del desarrollo, ofreciendo así mayor calidad en nuestros proyectos.<br>

También cuidamos la salud e integridad del personal. Hemos implementado políticas y normativas de seguridad e higiene laboral y proveemos todos los elementos de seguridad. Nuestras acciones proporcionan un ambiente de trabajo seguro con especial cuidado del medio ambiente.</p>
        </div>
    </div>
    <!--/info-INTERIOR-->

  </div>
  <!--/INTERIOR-->

</section>
<!--/CONTENT-->

@endsection
