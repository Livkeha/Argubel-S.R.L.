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

<!-- <body onLoad="MM_preloadImages('images/obra-publica-hover.png','images/obra-comercial-hover.png','images/obra-residencial-hover.png')"> -->

<!--HEADER-->

       @if (Auth::check()) <?php $proyectos = DB::table('projects')->orderBy('nombre', 'asc')->first(); ?> @endif
       
       @if (Auth::check()) <?php $nombreProyecto = strtoupper(DB::table('projects')->where("id", "=", Auth::user()->project_id)->value('nombre')); ?> @endif

<header id="header" class="interior">


        @if (Auth::check())
        <h3 class="login"> {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h3>
        <a href="{{ url('/logout') }}"><h4 class="login"> Logout </h4></a>
        @endif

                        <!-- @role('Administrador')
                            <h1 style=color:green>Administrador</h1>
                        @else
                            @if (Auth::check())<h1 style=color:red>Cliente</h1> @endif
                        @endrole -->

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
      @role('Administrador')<li><a href="{{ url('/registrarUsuario') }}">REGISTRAR INVERSOR</a></li>@endrole
      @role('Administrador')<li><a href="{{ url('/listaUsuarios') }}">LISTA DE INVERSORES</a></li>@endrole
      @role('Administrador')<li><a href="{{ url('/registrarProyecto') }}">REGISTRAR DESARROLLO</a></li>@endrole
      @role('Administrador') @if (isset($proyectos))<li><a href="{{ url('/listaDesarrollos') }}">LISTA DE DESARROLLOS</a></li> @endif @endrole
      @if (!Auth::check()) <li><a href="{{ url('/contacto') }}">CONTACTO</a></li> @endif
      <!--@if (!Auth::check()) <li><a href="proveedores.html">PROVEEDORES</a></li> @endif-->
      @if (!Auth::check()) <li><a href="{{ url('/obra-residencial') }}">OBRA RESIDENCIAL</a></li> @endif
      @if (!Auth::check()) <li><a href="{{ url('/obra-comercial') }}">OBRA COMERCIAL</a></li> @endif
	    @if (!Auth::check()) <li><a href="{{ url('/obra-publica') }}">OBRA PÚBLICA</a></li> @endif
	    @if (!Auth::check()) <li><a href="{{ url('/servicios') }}">SERVICIOS</a></li> @endif
      @if (!Auth::check()) <li><a href="{{ url('/empresa') }}">EMPRESA</a></li> @endif
      @role('Cliente') @if (isset($nombreProyecto)) <li><a href="{{ url('/') }}">CUOTAS</a></li> @endif @endrole
      @role('Cliente') @if (isset($nombreProyecto)) <li><a href="{{ url('/') }}">FOTOS</a></li> @endif @endrole
      @role('Cliente') @if (isset($nombreProyecto)) <li><a href="{{ url('/') }}">PLANOS</a></li> @endif @endrole
      @role('Cliente') @if (isset($nombreProyecto)) <li style="text-decoration: underline"><a href="{{ URL::to('miDesarrollo/' . strtolower($nombreProyecto)) }}"><b>{{ $nombreProyecto }}</b></a></li> @endif @endrole
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
        <img src="{{ url('images/logo-Argubel-footer.png') }}" alt=""/> </div>
      </div>

    </div>
</footer>
<!--/FOOTER-->

</body>
</html>
