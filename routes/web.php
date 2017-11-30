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

Route::get('/index', 'HomeController@view')->name('index');

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
    Route::get('/registrarProyecto', 'registrarProyectoController@registrarProyecto')->name('registrarProyecto');
});

Route::group(['middleware' => ['permission:registrar_desarrollos']], function () {
    Route::get('/validarProyecto', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['permission:registrar_desarrollos']], function () {
    Route::post('/validarProyecto', 'registrarProyectoController@validarProyecto')->name('validarProyecto');
});

Route::group(['middleware' => ['permission:lista_desarrollos']], function () {
    Route::get('/listaDesarrollos', 'ProyectosController@verLista')->name('listaDesarrollos');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::get('/agregarInversor/{id}', 'ProyectosController@agregarInversor')->name('agregarInversor');
});

Route::group(['middleware' => ['permission:editar_desarrollos']], function () {
    Route::post('/validarInversorAgregado', 'ProyectosController@validarInversorAgregado')->name('validarInversorAgregado');
});

Route::group(['middleware' => ['permission:lista_clientes']], function () {
    Route::get('/listaUsuarios', 'UsuariosController@verLista')->name('listaUsuarios');
});

// Route::group(['middleware' => ['permission:datos_proyectos']], function () {
//     Route::get('/listaUsuarios', 'UsuariosController@verLista')->name('listaUsuarios');
// });

Route::get('/adminInicial', 'AdminInicialController@view')->name('adminInicial');

Route::get('logout', 'Auth\LoginController@logout');
