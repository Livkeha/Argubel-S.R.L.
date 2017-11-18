<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Argubel Srl - Empresa Constructora</title>
<link rel="icon" href="{{ url('images/icono-Argubel.png') }}">
<meta name="description" content="Argubel es una empresa Argentina de la Industria de la Construcción, creada con el objetivo de ofrecer a nuestros clientes un completo abanico de servicios, dedicada a proyectos de gran envergadura y particulares...">
<meta name="keywords" content="Obra Publica, Obra Residencial, Obra Comercial, Construcción, Remodelación">
<link id="stylesheet1" href="{{asset('../css/estilos.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('../engine1/style.css')}}" />
<meta name="viewport" content="width=device-width">
<script type="text/javascript" src="{{ url('engine1/jquery.js') }}"></script>
<script type="text/javascript" src="{{ url('engine1/rollhover.js') }}"></script>

@yield('obras')

</head>
<body onLoad="MM_preloadImages('images/obra-publica-hover.png','images/obra-comercial-hover.png','images/obra-residencial-hover.png')">
<!--HEADER-->
<header id="header" class="interior">


        @if (Auth::check())
        <h3 class="login"> {{ Auth::user()->name }}</h3>
        <a href="{{ url('/logout') }}"><h4 class="login"> Logout </h4>
        @endif

        @if (auth()->check())
                        @if (auth()->user()->isAdministrator())
                            <h1 style=color:green>Soy Administrador!!</h1>
                        @else
                            <h1 style=color:red>Soy Cliente</h1>
                        @endif
         @endif

        @if (!Auth::check())
        <a href="{{ url('/login') }}"><h3 class="login">LOGIN</h3></a>
        @endif

  <h1><a href="{{ url('/index') }}"><img src="{{ url('images/logo-Argubel.png') }}" alt="Argubel Empresa Constructora"/></a></h1>

</header>


<!--/HEADER-->

<!--NAV-->
<nav id="nav">
  <div class="interior">
    <ul>
      <li><a href="{{ url('/index') }}" class="current">HOME</a></li>
      <li><a href="{{ url('/contacto') }}">CONTACTO</a></li>
      <!--<li><a href="proveedores.html">PROVEEDORES</a></li>-->
      <li><a href="{{ url('/obra-residencial') }}">OBRA RESIDENCIAL</a></li>
      <li><a href="{{ url('/obra-comercial') }}">OBRA COMERCIAL</a></li>
	  <li><a href="{{ url('/obra-publica') }}">OBRA PÚBLICA</a></li>
	  <li><a href="{{ url('/servicios') }}">SERVICIOS</a></li>
      <li><a href="{{ url('/empresa') }}">EMPRESA</a></li>
	</ul>
  </div>
</nav>
<!--/NAV-->

@yield('contenido')

<!--FOOTER-->
<footer>
	<div class="footer">
      <div class="interior-footer"><p><strong>Argubel S.R.L.</strong><br>
		Tel.: 4443-6740 / 4443-7165 <a href="mailto:info@argubel.com.ar">info@argubel.com.ar</a><br>
        Todos los derechos reservados - 2014
        </p>
      <div class="logo-footer">
        <img src="images/logo-Argubel-footer.png" alt=""/> </div>
      </div>

    </div>
</footer>
<!--/FOOTER-->

</body>
</html>
