<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Project;
use Redirect;
use DB;
use Auth;

class RegistrarProyectoController extends Controller
{

  public function registrarProyecto()
  {

    // $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->get();
    $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();
    $inversoresOcupados = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '!=', null)->get();

    $listaProyectos = [];

    foreach ($inversoresOcupados as $inversor) {
      $nombreProyecto = DB::table('projects')->where("id", "=", "$inversor->project_id")->value('nombre');
      $listaProyectos[$inversor->project_id] = ($nombreProyecto);
    }

    // var_dump($inversoresOcupados['project_id']);

    // $inversiones = DB::table('projects')->where("id", "=", "$inversoresOcupados['project_id']")->get();


    return view('registroProyecto', compact('inversoresNuevos', 'inversoresOcupados', 'listaProyectos'));
  }


  protected function validarProyecto(Request $request)
  {

    // {{dd($request["inversor"] . "%");}}


    foreach ($request->all() as $key => $value) {

      // {{dd($request->all());}}

      $hayInversor = substr_compare("inversor", $key, 0, 8);

      // if ($hayInversor != -2) {
      //   continue;
      // }
      //
      // if ($hayInversor == -2) {
      //   return;
      // }

      if($hayInversor == 0)
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



    if($validator->fails() || $hayInversor != 0) {

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

       if($hayInversor != 0)
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

    // var_dump($proyectoNuevo);exit;

    $nuevoPost = Project::create([
      'nombre' => $proyectoNuevo['nombre'],
      'calle' => $proyectoNuevo['calle'],
      'altura' => $proyectoNuevo['altura'],
      ]);

      $idProyecto = $nuevoPost["id"];

          foreach ($proyectoNuevo as $inversor => $idInversor) {  // ESTE VALUE ES EL ID DEL USUARIO QUE VA A TENER EL PROYECTO

            // var_dump($inversor, $idInversor);

            $hayInversor = substr_compare("inversor", $inversor, 0, 8);

            // var_dump($inversor, $hayInversor);

            if($hayInversor == 0)
            {
              $inversores = DB::table('users')->where("id", "=", "$idInversor")->select("project_id")->update( ['project_id' => $idProyecto] );
            }
          }

    $proyectoCreado = ("El nuevo proyecto se ha subido correctamente.");

    $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();
    // $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->get();
    $inversoresOcupados = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '!=', null)->get();

    $listaProyectos = [];

    foreach ($inversoresOcupados as $inversor) {
      $nombreProyecto = DB::table('projects')->where("id", "=", "$inversor->project_id")->value('nombre');
      $listaProyectos[$inversor->project_id] = ($nombreProyecto);
    }


    // return redirect()->action('PostsUsuarioController@crearPost');
    // {{dd($postSubido);}}
    // return Redirect::route('crearPost')->with($postSubido);
    // return Redirect::route('crearPost', compact('postSubido'));
      return view('registroProyecto', compact('proyectoCreado', 'inversoresNuevos', 'inversoresOcupados', 'listaProyectos'));
  }

}
