<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Redirect;
use DB;

class RegistrarProyectoController extends Controller
{

  public function registrarProyecto()
  {

    $inversores = DB::table('users')->orderBy('apellido', 'asc')->get();

    return view('registroProyecto', compact('inversores'));
  }


  protected function validarProyecto(Request $request)
  {

    {{dd($request->all());}}




    if (array_key_exists("proyectoCreado", $request->all())) {

      $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|min:10',
        'calle' => 'required|string|min:10',
        'altura' => 'required|string|min:10',
        'inversor' => 'required|string|min:10',
        'contenido' => 'required|string|max:500',
      ]);
    }



    if($validator->fails()) {

      $failedRules = $validator->failed();

      $errors = [];

      if(isset($failedRules['titulo']['Min']))
       {
         $errors['tituloMin'] = ("El título debe poseer un mínimo de 10 caracteres.");
       }

      if(isset($failedRules['titulo']['Required']))
       {
         $errors['tituloRequired'] = ("El campo del título es obligatorio.");
       }

      if(isset($failedRules['contenido']['Max']))
       {
         $errors['contenidoMax'] = ("El contenido debe poseer un máximo de 500 caracteres.");
       }

      if(isset($failedRules['contenido']['Required']))
       {
        $errors['contenidoRequired'] = ("El campo del contenido es obligatorio.");
       }


      // {{dd($errors);}}

      // $errors = array(
      //       'required' => 'The :attribute field is required',
      //       'email' => 'The :attribute field is required',
      //       'alpha_num' => 'The :attribute field must only be letters and numbers (no spaces)'
      //   );

      // {{dd($failedRules);}}


      // {{dd("Está fallando los valores que pasaste!");}}
      return Redirect::route('registrarProyecto')->withErrors($errors);
      // return view('crear-post-usuario', compact('errors');
    }

    $proyectoNuevo = $request->all();

    return $this->registroProyecto($proyectoNuevo);

  }

  public function registroProyecto(array $proyectoNuevo)
  {

    $user_id = Auth::user()->id;

    $nuevoPost = Project::create([
      'titulo' => $proyectoNuevo['titulo'],
      'slug' => str_slug($proyectoNuevo['titulo']),
      'contenido' => $proyectoNuevo['contenido'],
      'user_id' => $user_id,
      ]);

    $proyectoSubido = ("Tu nuevo proyecto se ha subido correctamente.");


    // return redirect()->action('PostsUsuarioController@crearPost');
    // {{dd($postSubido);}}
    // return Redirect::route('crearPost')->with($postSubido);
    // return Redirect::route('crearPost', compact('postSubido'));
      return view('crear-post-usuario', compact('proyectoSubido'));
    // return Redirect::route('crearPost')->withErrors($postSubido); ESTE ES EL QUE FUNCA
  }

}
