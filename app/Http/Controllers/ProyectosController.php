<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use DB;

class ProyectosController extends Controller
{

  public function verLista()
  {

      $proyectos = DB::table('projects')->orderBy('nombre', 'asc')->get();
      // {{dd($posts);}}

      if($proyectos->first() == null)
      {
        // {{dd("No hay nada, está bien");}}
        return redirect()->route('index');
      } else {
        return view('lista-proyectos', compact('proyectos'));
      }
    }

}
