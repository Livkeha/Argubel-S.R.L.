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
