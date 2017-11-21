<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarProyectoController extends Controller
{
  public function registrarProyecto()
  {
    return view('registroProyecto');
  }
}
