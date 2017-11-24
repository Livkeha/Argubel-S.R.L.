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

    // {{dd($request["inversor"] . "%");}}


    foreach ($request->all() as $key => $value) {

      // {{dd($request->all());}}


      $hayInversor = substr_compare("inversor", $key, 0);

      // if ($hayInversor != -2) {
      //   continue;
      // }
      //
      // if ($hayInversor == -2) {
      //   return;
      // }

      if($hayInversor == -2)
      {
        break;
      }

    }





    if (array_key_exists("proyectoCreado", $request->all())) {

      $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|min:2',
        'calle' => 'required|string|min:2',
        'altura' => 'required|string|min:2',
      ]);

    }

    // if(array_key_exists(""))



    if($validator->fails() || $hayInversor != -2) {

      $failedRules = $validator->failed();

      // {{dd($failedRules);}}

      $errors = [];

      if(isset($failedRules['nombre']['Min']))
       {
         $errors['nombreMin'] = ("El nombre debe poseer un mínimo de 2 caracteres.");
       }

      if(isset($failedRules['nombre']['Required']))
       {
         $errors['nombreRequired'] = ("El campo del título es obligatorio.");
       }

      if(isset($failedRules['calle']['Min']))
       {
         $errors['calleMin'] = ("La calle debe poseer un mínimo de 2 caracteres.");
       }

      if(isset($failedRules['calle']['Required']))
       {
         $errors['calleRequired'] = ("El campo de la calle es obligatorio.");
       }

      if(isset($failedRules['altura']['Min']))
       {
         $errors['alturaMin'] = ("La altura debe poseer un mínimo de 1 caracter.");
       }

      if(isset($failedRules['altura']['Required']))
       {
         $errors['alturaRequired'] = ("El campo de la altura es obligatorio.");
       }

       if($hayInversor != 2)
       {
         $errors['sinInversor'] = ("Debe seleccionar al menos un inversor.");
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
