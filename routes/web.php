<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
      return view('index');
});

Route::get('/index', 'HomeController@index')->name('index');

Route::get('/empresa', 'EmpresaController@view')->name('empresa');

Route::get('/servicios', 'ServiciosController@view')->name('servicios');

Route::get('/obra-publica', 'ObraPublicaController@view')->name('obra-publica');

Route::get('/obra-comercial', 'ObraComercialController@view')->name('obra-comercial');

Route::get('/obra-residencial', 'ObraResidencialController@view')->name('obra-residencial');

Route::get('/contacto', 'ContactoController@view')->name('contacto');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');






Route::group(['middleware' => ['permission:registrar_clientes']], function () {
    Route::get('/registrarUsuario', 'Auth\RegisterController@registrarUsuario')->name('registrarUsuario');
});

Route::group(['middleware' => ['permission:registrar_desarrollos']], function () {
    Route::post('/registrarUsuario', 'Auth\RegisterController@create')->name('registrarUsuario');
});

Route::group(['middleware' => ['permission:registrar_clientes']], function () {
  Route::get('/usuarioRegistrado', 'Auth\RegisterController@usuarioRegistrado')->name('usuarioRegistrado');
});






Route::group(['middleware' => ['permission:registrar_desarrollos']], function () {
    Route::get('/registrarProyecto', 'RegistrarProyectoController@registrarProyecto')->name('registrarProyecto');
});

Route::group(['middleware' => ['permission:registrar_desarrollos']], function () {
    Route::post('/validarDesarrollo', 'RegistrarProyectoController@validarDesarrollo')->name('validarDesarrollo');
});






Route::group(['middleware' => ['permission:lista_desarrollos']], function () {
    Route::get('/listaDesarrollos', 'ProyectosController@verLista')->name('listaDesarrollos');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::get('/agregarInversor/{id}', 'ProyectosController@agregarInversor')->name('agregarInversor');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::get('/eliminarDesarrollo/{id}', 'ProyectosController@eliminarDesarrollo')->name('eliminarDesarrollo');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::get('/modificarMontoEstablecido/{id}', 'ProyectosController@modificarMontoEstablecido')->name('modificarMontoEstablecido');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::post('/montoEstablecidoModificado/{id}', 'ProyectosController@montoEstablecidoModificado')->name('montoEstablecidoModificado');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::post('/validarInversorAgregado', 'ProyectosController@validarInversorAgregado')->name('validarInversorAgregado');
});

Route::group(['middleware' => ['permission:datos_proyectos']], function () {
    Route::get('/miDesarrollo/{idProyecto}', 'ProyectosController@miDesarrollo')->name('miDesarrollo');
});

Route::group(['middleware' => ['permission:datos_proyectos']], function () {
    Route::get('/miDesarrollo/{idProyecto}/fotos', 'ProyectosController@fotosMiDesarrollo')->name('fotosMiDesarrollo');
});

Route::group(['middleware' => ['permission:datos_proyectos']], function () {
    Route::get('/miDesarrollo/{idProyecto}/fotos/eliminarFoto/{foto}', 'ProyectosController@eliminarFoto')->name('eliminarFoto');
});

Route::group(['middleware' => ['permission:datos_proyectos']], function () {
    Route::get('/miDesarrollo/{idProyecto}/planos', 'ProyectosController@planosMiDesarrollo')->name('planosMiDesarrollo');
});

Route::group(['middleware' => ['permission:datos_proyectos']], function () {
    Route::get('/miDesarrollo/{idProyecto}/planos/eliminarPlano/{plano}', 'ProyectosController@eliminarPlano')->name('eliminarPlano');
});





Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::get('/abandonarDesarrollo/{proyectoId}/{usuarioId}', 'UsuariosController@abandonarDesarrollo')->name('abandonarDesarrollo');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::post('/ingresarEnDesarrollo/{usuarioId}', 'UsuariosController@ingresarEnDesarrollo')->name('ingresarEnDesarrollo');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::get('/eliminarInversor/{usuarioId}', 'UsuariosController@eliminarInversor')->name('eliminarInversor');
});

Route::get('/cambiarPassword/{usuarioId}', 'UsuariosController@cambiarPassword')->name('cambiarPassword');

Route::post('/passwordModificada/{usuarioId}', 'UsuariosController@passwordModificada')->name('passwordModificada');

Route::get('/misCuotas/{proyectoId}/{usuarioId}', 'UsuariosController@misCuotas')->name('misCuotas');

Route::get('/crearBalance/{proyectoId}/{usuarioId}', 'UsuariosController@crearBalance')->name('crearBalance');



Route::group(['middleware' => ['permission:editar_clientes']], function () {
  Route::post('/modificarFechaCuota/{proyectoId}/{usuarioId}/{cuotaId}', 'UsuariosController@modificarFechaCuota')->name('modificarFechaCuota');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
  Route::post('/modificarFechaVencimiento/{proyectoId}/{usuarioId}/{cuotaId}', 'UsuariosController@modificarFechaVencimiento')->name('modificarFechaVencimiento');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
  Route::post('/modificarMontoPagado/{proyectoId}/{usuarioId}/{cuotaId}', 'UsuariosController@modificarMontoPagado')->name('modificarMontoPagado');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
  Route::post('/modificarFechaPagado/{proyectoId}/{usuarioId}/{cuotaId}', 'UsuariosController@modificarFechaPagado')->name('modificarFechaPagado');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
  Route::post('/agregarCuota/{proyectoId}/{usuarioId}/{cuotaId}', 'UsuariosController@agregarCuota')->name('agregarCuota');
});

Route::group(['middleware' => ['permission:lista_clientes']], function () {
    Route::get('/listaUsuarios', 'UsuariosController@verLista')->name('listaUsuarios');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::get('/modificarCuota/{usuarioId}', 'UsuariosController@modificarCuota')->name('modificarCuota');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::post('/cuotaModificada/{usuarioId}', 'UsuariosController@cuotaModificada')->name('cuotaModificada');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::get('/modificarVencimiento/{usuarioId}', 'UsuariosController@modificarVencimiento')->name('modificarVencimiento');
});

Route::group(['middleware' => ['permission:editar_clientes']], function () {
    Route::post('/vencimientoModificado/{usuarioId}', 'UsuariosController@vencimientoModificado')->name('vencimientoModificado');
});




Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::post('/validarFotos', 'FotosProyectosController@validarFotos')->name('validarFotos');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::post('/validarPlanos', 'PlanosProyectosController@validarPlanos')->name('validarPlanos');
});






Route::get('/adminInicial', 'AdminInicialController@view')->name('adminInicial');

Route::get('logout', 'Auth\LoginController@logout');




// Route::group(['middleware' => ['permission:registrar_desarrollos']], function () {
//     Route::get('/validarDesarrollo', 'HomeController@index')->name('home');
// });
