<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;
use Session;
use Redirect;
use File;

class AdminInicialController extends Controller
{
  public function view()
  {

    $ceroUsuarios = DB::table('users')->value('nombre');

    if($ceroUsuarios == null)
    {

    $role = Role::create(['name' => 'Administrador']);

    Permission::create(['name' => 'registrar_clientes']);
    Permission::create(['name' => 'editar_clientes']);
    Permission::create(['name' => 'eliminar_clientes']);
    Permission::create(['name' => 'lista_clientes']);
    Permission::create(['name' => 'registrar_desarrollos']);
    Permission::create(['name' => 'editar_desarrollos']);
    Permission::create(['name' => 'eliminar_desarrollos']);
    Permission::create(['name' => 'lista_desarrollos']);
    Permission::create(['name' => 'datos_proyectos']);

    $role->givePermissionTo('registrar_clientes');
    $role->givePermissionTo('editar_clientes');
    $role->givePermissionTo('eliminar_clientes');
    $role->givePermissionTo('lista_clientes');
    $role->givePermissionTo('registrar_desarrollos');
    $role->givePermissionTo('editar_desarrollos');
    $role->givePermissionTo('eliminar_desarrollos');
    $role->givePermissionTo('lista_desarrollos');
    $role->givePermissionTo('datos_proyectos');

    $user = User::create([
    'nombre' => 'Argubel',
    'apellido' => 'S.R.L.',
    'documento' => '71139326',
    'telefono' => '44436740',
    'email' => 'info@argubel.com.ar',
    'password' => bcrypt('poiu6549'),
    'rol' => 'administrador',
    ]);

    $user->assignRole('Administrador');

    $role = Role::create(['name' => 'Cliente']);

    $role->givePermissionTo('datos_proyectos');

    $limpiarDirectorios = File::deleteDirectory(public_path('imagenesDesarrollos'));

    Session::flash('adminInicial', "El administrador inicial ha sido creado correctamente.");
    return Redirect::route('index');

    }

    else {
      Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
      return Redirect::route('index');
    }

  }
}
