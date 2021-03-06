<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Argubel Srl - Empresa Constructora</title>
<link rel="icon" href="{{ url('images/icono-Argubel.png') }}">
<meta name="description" content="Argubel es una empresa Argentina de la Industria de la Construcción, creada con el objetivo de ofrecer a nuestros clientes un completo abanico de servicios, dedicada a proyectos de gran envergadura y particulares...">
<meta name="keywords" content="Obra Publica, Obra Residencial, Obra Comercial, Construcción, Remodelación">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link id="stylesheet1" href="{{asset('../css/estilos.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('../engine1/style.css')}}" />
<meta name="viewport" content="width=device-width">
<script type="text/javascript" src="{{ url('engine1/jquery.js') }}"></script>
<script type="text/javascript" src="{{ url('engine1/rollhover.js') }}"></script>

@yield('obras')

</head>

<!-- <body onLoad="MM_preloadImages('images/obra-publica-hover.png','images/obra-comercial-hover.png','images/obra-residencial-hover.png')"> -->

<!--HEADER-->

       @role('Administrador') @if (Auth::check()) <?php $proyectos = DB::table('projects')->orderBy('nombre', 'asc')->first(); ?> @endif @endrole

       @role('Cliente') @if (Auth::check()) <?php $idProyecto = DB::table('projects')->where("id", "=", Auth::user()->project_id)->value('id'); ?> @endif @endrole
       @role('Cliente') @if (Auth::check()) <?php $nombreProyecto = DB::table('projects')->where("id", "=", Auth::user()->project_id)->value('nombre'); ?> @endif @endrole

       @role('Cliente') @if (Auth::check()) <?php $proyectoReferido = DB::table('projects')->where("id", "=", "$idProyecto")->first(); ?> @endif @endrole

<header id="header" class="interior">


        @if (Auth::check())
					<div class="login-box">
						<h4 class="log log-on"><span class="glyphicon glyphicon-user color-gris" id="iconoLogueado" aria-hidden="true"></span> {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h4>
						<a href="{{ url('/logout') }}"><h5 class="log"><span class="glyphicon glyphicon-remove color-rojo" aria-hidden="true" style="padding-right: 5px; font-size: 1.2em; display: inline-block;"></span>SALIR</h5></a>
					</div>
        @endif

                        <!-- @role('Administrador')
                            <h1 style=color:green>Administrador</h1>
                        @else
                            @if (Auth::check())<h1 style=color:red>Cliente</h1> @endif
                        @endrole -->

        @if (!Auth::check())
					<a href="{{ url('/login') }}"><h4 class=""><button class="btn btn-info login-box">
						INGRESAR</h4>
					</button></a>
        @endif

  <h1><a href="{{ url('/index') }}"><img src="{{ url('images/logo-Argubel.png') }}" alt="Argubel Empresa Constructora"/></a></h1>

</header>


<!--/HEADER-->

<!--NAV-->
<nav id="nav">
  <div class="interior">
    <ul>
      @if (Auth::check() && Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <span style="color:yellow"><i>Actualmente no cuenta con un desarrollo asignado</i></span> @endif
      @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/index') }}" class="current">HOME</a></li> @endif
      @role('Administrador')<li><a href="{{ url('/registrarUsuario') }}">REGISTRAR INVERSOR</a></li>@endrole
      @role('Administrador')<li><a href="{{ url('/listaUsuarios') }}">LISTA DE INVERSORES</a></li>@endrole
      @role('Administrador')<li><a href="{{ url('/registrarProyecto') }}">REGISTRAR DESARROLLO</a></li>@endrole
      @role('Administrador') @if (isset($proyectos))<li><a href="{{ url('/listaDesarrollos') }}">LISTA DE DESARROLLOS</a></li> @endif @endrole
      @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/contacto') }}">CONTACTO</a></li> @endif
      <!--@if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="proveedores.html">PROVEEDORES</a></li> @endif-->
      @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/obra-residencial') }}">OBRA RESIDENCIAL</a></li> @endif
      @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/obra-comercial') }}">OBRA COMERCIAL</a></li> @endif
	    @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/obra-publica') }}">OBRA PÚBLICA</a></li> @endif
	    @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/servicios') }}">SERVICIOS</a></li> @endif
      @if (!Auth::check() || Auth::user()->rol == "cliente" && Auth::user()->project_id == null) <li><a href="{{ url('/empresa') }}">EMPRESA</a></li> @endif
      @role('Cliente') @if ($nombreProyecto) <li><a href="{{ URL::to('/') }}/misCuotas/{{$idProyecto}}/{{Auth::user()->id}}">CUOTAS</a></li> @endif @endrole
      @role('Cliente') @if ($nombreProyecto) <li><a href="{{ URL::to('/') }}/miDesarrollo/{{$idProyecto}}/planos">PLANOS</a></li> @endif @endrole
      @role('Cliente') @if ($nombreProyecto) <li><a href="{{ URL::to('/') }}/miDesarrollo/{{$idProyecto}}/fotos">FOTOS</a></li> @endif @endrole
      @role('Cliente') @if ($nombreProyecto) <li style="text-decoration: underline;"><a class="current" href="{{ URL::to('/') }}/miDesarrollo/{{$idProyecto}}"><b>{{ $nombreProyecto }}</b></a></li> @endif @endrole
	</ul>
  </div>
</nav>
<!--/NAV-->

@yield('contenido')

<!--FOOTER-->
<footer>
	<div class="footer">
      <div class="interior-footer" style="margin-top:900px"><p><strong>Argubel S.R.L.</strong><br>
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
