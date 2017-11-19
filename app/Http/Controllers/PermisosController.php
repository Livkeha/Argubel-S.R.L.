<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermisosController extends Controller
{

  public function registrarCliente()
  {
    return view('registroClientes');
  }

  public function usuarioRegistrado()
  {
    return view('usuarioRegistrado');
  }

  public function denegado()
  {
    return view('denegado');
  }

}
