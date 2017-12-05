<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Project;
use App\Balance;
use Redirect;
use DB;
use Auth;
use File;

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


  protected function validarDesarrollo(Request $request)
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
        'nombre' => 'required|string|min:2|unique:projects',
        'calle' => 'required|string|min:2',
        'altura' => 'required|string|min:2',
        'monto_establecido' => 'required|string|min:2',
        'imagenPresentacion' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=640,min_height=480',
        'imagenUbicacion' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=640,min_height=480',
        'descripcion' => 'required|string|min:10|max:3000',
      ]);

    }

    // if(array_key_exists(""))

    // {{dd($validator);}}

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

      if(isset($failedRules['nombre']['Unique']))
       {
         $errors['nombreUnique'] = ("El nombre del desarrollo ya se encuentra asignado.");
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

      if(isset($failedRules['monto_establecido']['Min']))
       {
         $errors['monto_establecidoMin'] = ("El monto inicial de cuota establecido debe poseer un mínimo de 1 caracter.");
       }

      if(isset($failedRules['monto_establecido']['Required']))
       {
         $errors['monto_establecidoRequired'] = ("El campo del monto inicial de cuota establecido es obligatorio.");
       }

      if(isset($failedRules['imagenPresentacion']['Required']))
       {
         $errors['imagenPresentacionRequired'] = ("Debe adjuntar una imagen de presentación.");
       }

      if(isset($failedRules['imagenUbicacion']['Required']))
       {
         $errors['imagenUbicacionRequired'] = ("Debe adjuntar una imagen de ubicación.");
       }

      if(isset($failedRules['imagenPresentacion']['Image']) || isset($failedRules['imagenUbicacion']['Image']))
        {
          if(isset($failedRules['imagenPresentacion']['Image'])) { $errors['imagenPresentacionImage'] = ("La imagen de presentación debe ser en formato .JPEG, .PNG o .JPG."); }
          if(isset($failedRules['imagenUbicacion']['Image'])) { $errors['imagenUbicacionImage'] = ("La imagen de ubicación debe ser en formato .JPEG, .PNG o .JPG."); }
        }

      if(isset($failedRules['imagenPresentacion']['uploaded']) || isset($failedRules['imagenUbicacion']['uploaded']))
        {
          if(isset($failedRules['imagenPresentacion']['uploaded'])) { $errors['imagenPresentacionUploaded'] = ("Error al adjuntar la imagen de presentación."); }
          if(isset($failedRules['imagenUbicacion']['uploaded'])) { $errors['imagenUbicacionUploaded'] = ("Error al adjuntar la imagen de ubicación."); }
        }

      if(isset($failedRules['imagenPresentacion']['Dimensions']) || isset($failedRules['imagenUbicacion']['Dimensions']))
        {
          if(isset($failedRules['imagenPresentacion']['Dimensions'])) { $errors['imagenPresentacionDimensions'] = ("La imagen de presentación debe tener un tamaño mínimo de 640 x 480."); }
          if(isset($failedRules['imagenUbicacion']['Dimensions'])) { $errors['imagenUbicacionDimensions'] = ("La imagen de ubicación debe tener un tamaño mínimo de 640 x 480."); }
        }

      if(isset($failedRules['descripcion']['Min']))
       {
         $errors['descripcionMin'] = ("La descripcion debe contener un mínimo de 10 caracteres.");
       }

      if(isset($failedRules['descripcion']['Max']))
       {
         $errors['descripcionMax'] = ("La descripcion no debe superar los 3000 caracteres.");
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

    $nuevoProyecto = Project::create([
      'nombre' => $proyectoNuevo['nombre'],
      'calle' => $proyectoNuevo['calle'],
      'altura' => $proyectoNuevo['altura'],
      'monto_establecido' => $proyectoNuevo['monto_establecido'],
      'imagenPresentacion' => $this->subirImagenPresentacion($proyectoNuevo),
      'imagenUbicacion' => $this->subirImagenUbicacion($proyectoNuevo),
      'descripcion' => $proyectoNuevo['descripcion'],
      ]);

      $idProyecto = $nuevoProyecto["id"];

          foreach ($proyectoNuevo as $inversor => $idInversor) {  // ESTE VALUE ES EL ID DEL USUARIO QUE VA A TENER EL PROYECTO

            $hayInversor = substr_compare("inversor", $inversor, 0, 8);

            // var_dump($inversor, $hayInversor);

            if($hayInversor == 0) // SI ENCUENTRA UN INVERSOR
            {
              $inversores = DB::table('users')->where("id", "=", "$idInversor")->select("project_id")->update( ['project_id' => $idProyecto] );

              $usuarioAsignado = DB::table('users')->where("id", "=", "$idInversor")->where("project_id", '=', "$idProyecto")->first();

              $balanceInicial = Balance::create([
                'monto_establecido' => $proyectoNuevo['monto_establecido'],
                'monto_pagado' => null,
                'fecha_pagado' => null,
                'balance' => 0,
                'user_id' => $idInversor,
                'project_id' => $idProyecto,
              ]);

            }

          }


    $proyectoCreado = ("El nuevo desarrollo se ha subido correctamente.");

    $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->where('rol', '=', 'cliente')->get();
    // $inversoresNuevos = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '=', null)->get();
    $inversoresOcupados = DB::table('users')->orderBy('apellido', 'asc')->where('project_id', '!=', null)->get();

    $listaProyectos = [];

    foreach ($inversoresOcupados as $inversor) {
      $nombreProyecto = DB::table('projects')->where("id", "=", "$inversor->project_id")->value('nombre');
      $listaProyectos[$inversor->project_id] = ($nombreProyecto);
    }


    $result = File::makeDirectory('imagenesDesarrollos/' . $proyectoNuevo['nombre'] . '/Fotos', 0775, true);
    $result = File::makeDirectory('imagenesDesarrollos/' . $proyectoNuevo['nombre'] . '/Planos', 0775, true);

    // return redirect()->action('PostsUsuarioController@crearPost');
    // {{dd($postSubido);}}
    // return Redirect::route('crearPost')->with($postSubido);
    // return Redirect::route('crearPost', compact('postSubido'));
      return view('registroProyecto', compact('proyectoCreado', 'inversoresNuevos', 'inversoresOcupados', 'listaProyectos'));
  }

  public function subirImagenPresentacion($proyectoNuevo)
  {

      // {{dd($proyectoNuevo);}}
      $proyecto = $proyectoNuevo['nombre'];
      // {{dd($proyecto);}}
      $file = $proyectoNuevo['imagenPresentacion'];
      // {{dd($file);}}
      $ext = 'jpeg';
      // $ext = $file->extension();
      // {{dd($ext);}}
      // $name = uniqid();
      // $name = ucfirst(($data['username'] . '-perfil'));
      $name = ucfirst(('Presentacion'));
      // {{dd($name);}}
      $file->storeAs($proyecto, $name.'.'.$ext);

      // $file->storeAs($user, $name.'.'.$ext);

      // $image = new \App\Image(['src' => $name.'.'.$ext]);

      $image = $name . '.' . $ext;
      // {{dd($image);}}

      // {{dd($image);}}

      // $user->images()->save($image);

     return $image;

   }

  public function subirImagenUbicacion($proyectoNuevo)
  {

      // {{dd($proyectoNuevo);}}
      $proyecto = $proyectoNuevo['nombre'];
      // {{dd($proyecto);}}
      $file = $proyectoNuevo['imagenUbicacion'];
      // {{dd($file);}}
      $ext = 'jpeg';
      // {{dd($ext);}}
      // $name = uniqid();
      // $name = ucfirst(($data['username'] . '-perfil'));
      $name = ucfirst(('Ubicacion'));
      // {{dd($name);}}
      $file->storeAs($proyecto, $name.'.'.$ext);

      // $file->storeAs($user, $name.'.'.$ext);

      // $image = new \App\Image(['src' => $name.'.'.$ext]);

      $image = $name . '.' . $ext;
      // {{dd($image);}}

      // {{dd($image);}}

      // $user->images()->save($image);

     return $image;

   }

}
