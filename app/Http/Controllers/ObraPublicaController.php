<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObraPublicaController extends Controller
{
  public function view()
  {
      return view('obra-publica');
  }
}
