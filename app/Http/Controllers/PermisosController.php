<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermisosController extends Controller
{

  public function aceptado()
  {
    return view('aceptado');
  }

  public function denegado()
  {
    return view('denegado');
  }

}
