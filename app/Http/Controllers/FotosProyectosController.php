<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\ProjectPictures;
use Session;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Auth;

class FotosProyectosController extends Controller
{
    public function validarFotos(Request $request)
    {

       // {{dd($request->all());}}
      // // {{dd($request->has('photos'));}}
      // // {{dd($request->all());}}
      // // var_dump($request->all());exit;
      // // var_dump($request->input('photos'));exit;
      //
      // // $rules = [
      // //       'nombre' => 'required'
      // //   ];
      //
      //   $photos = count($request->photos);
      //
      //   foreach(range(0, $photos) as $index) {
      //       $rules['photos.' . $index] = 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=640,min_height=480';
      //   }
      //
      //   // {{dd($rules);}}
      //
      //   // $photos = count($this->input('photos'));
      //
      //   // {{dd($photos);}}
      //
      //   // {{dd($rules);}}
      //
      //   // echo "<pre>";
      //   //
      //   // foreach ($rules as $key => $value) {
      //   //   var_dump($key, $value);
      //   //   // $reglas = $key[$value];
      //   // }exit;
      //
      //       // {{dd($reglas);}}
      //
      //   $validator = Validator::make($request->all(), [
      //     'photos.*' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=640,min_height=480',
      //   ]);
      //
      //     // {{dd($validator);}}
      //
      //     if($validator->fails()) {
      //
      //       $failedRules = $validator->failed();
      //
      //       // echo "<pre>";
      //
      //       // {{dd($failedRules);}}
      //
      //       $errors = [];
      //
      //       if(isset($failedRules['photos.*']['image']))
      //        {
      //          $errors['nombreMin'] = ("El nombre debe poseer un mínimo de 2 caracteres.");exit;
      //        }
      //
      //      }




      if(Auth::user()->rol != "administrador" && $proyectoReferido == null || Auth::user()->rol == "cliente" && $proyectoReferido->id != Auth::user()->project_id)
        {
          Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
          return Redirect::route('index');
        }





           $input = $request->all();
           $rules = [];

           $photos = count($request->photos);

           if($request->cantidadFotos + $photos > 10)
           {
             Session::flash('maximoFotosExcedido', "Cada proyecto no puede tener mas de 10 fotos.");

             return Redirect::back();
           }

           // {{dd($photos);}}

           $idProyecto = $request->idProyecto;
           $nombreProyecto = $request->nombreProyecto;

           // {{dd($idProyecto);}}
           // {{dd($input);}}


           // {{dd($photos);}}

           foreach(range(0, $photos) as $index) {
                 $rules['photos.' . $index] = 'image|mimes:jpeg,png,jpg|dimensions:min_width=640,min_height=480|max:10240';
             }

           $validator = Validator::make($input, $rules);

           // {{dd($validator);}}

           if ($validator->fails())
           {

                  $failedRules = $validator->failed();

                  $errors = [];

                  // {{dd($failedRules);}}

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

                  // if(isset($failedRules['photos.0']['Required']) || isset($failedRules['photos.1']['Required']) || isset($failedRules['photos.2']['Required']) || isset($failedRules['photos.3']['Required']) || isset($failedRules['photos.4']['Required']) || isset($failedRules['photos.5']['Required']) || isset($failedRules['photos.6']['Required']) || isset($failedRules['photos.7']['Required']) || isset($failedRules['photos.8']['Required']) || isset($failedRules['photos.9']['Required']) || isset($failedRules['photos.10']['Required']))
                  //  {
                  //    $errors['photos0Required'] = ("Debe adjuntar una foto.");
                  //  }

                   if(isset($failedRules['photos.0']['Max']) || isset($failedRules['photos.1']['Max']) || isset($failedRules['photos.2']['Max']) || isset($failedRules['photos.3']['Max']) || isset($failedRules['photos.4']['Max']) || isset($failedRules['photos.5']['Max']) || isset($failedRules['photos.6']['Max']) || isset($failedRules['photos.7']['Max']) || isset($failedRules['photos.8']['Max']) || isset($failedRules['photos.9']['Max']) || isset($failedRules['photos.10']['Max']))
                    {
                     $errors['photos0Max'] = ("Cada foto no debe exceder los 10MB de peso.");
                   }

                   if(isset($failedRules['photos.0']['Image']) || isset($failedRules['photos.1']['Image']) || isset($failedRules['photos.2']['Image']) || isset($failedRules['photos.3']['Image']) || isset($failedRules['photos.4']['Image']) || isset($failedRules['photos.5']['Image']) || isset($failedRules['photos.6']['Image']) || isset($failedRules['photos.7']['Image']) || isset($failedRules['photos.8']['Image']) || isset($failedRules['photos.9']['Image']) || isset($failedRules['photos.10']['Image']))
                    {
                     $errors['photos0Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
                   }

                   if(isset($failedRules['photos.0']['uploaded']) || isset($failedRules['photos.1']['uploaded']) || isset($failedRules['photos.2']['uploaded']) || isset($failedRules['photos.3']['uploaded']) || isset($failedRules['photos.4']['uploaded']) || isset($failedRules['photos.5']['uploaded']) || isset($failedRules['photos.6']['uploaded']) || isset($failedRules['photos.7']['uploaded']) || isset($failedRules['photos.8']['uploaded']) || isset($failedRules['photos.9']['uploaded']) || isset($failedRules['photos.10']['uploaded']))
                    {
                     $errors['photos0Uploaded'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
                   }

                   if(isset($failedRules['photos.0']['Dimensions']) || isset($failedRules['photos.1']['Dimensions']) || isset($failedRules['photos.2']['Dimensions']) || isset($failedRules['photos.3']['Dimensions']) || isset($failedRules['photos.4']['Dimensions']) || isset($failedRules['photos.5']['Dimensions']) || isset($failedRules['photos.6']['Dimensions']) || isset($failedRules['photos.7']['Dimensions']) || isset($failedRules['photos.8']['Dimensions']) || isset($failedRules['photos.9']['Dimensions']) || isset($failedRules['photos.10']['Dimensions']))
                    {
                     $errors['photos0Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
                   }

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

//                   if(isset($failedRules['photos.1']['Required']))
//                    {
//                      $errors['photos1Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.1']['Image']))
//                    {
//                      $errors['photos1Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.1']['uploaded']))
//                    {
//                      $errors['photos1Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.1']['Dimensions']))
//                    {
//                      $errors['photos1Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.2']['Required']))
//                    {
//                      $errors['photos2Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.2']['Image']))
//                    {
//                      $errors['photos2Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.2']['uploaded']))
//                    {
//                      $errors['photos2Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.2']['Dimensions']))
//                    {
//                      $errors['photos2Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.3']['Required']))
//                    {
//                      $errors['photos3Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.3']['Image']))
//                    {
//                      $errors['photos3Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.3']['uploaded']))
//                    {
//                      $errors['photos3Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.3']['Dimensions']))
//                    {
//                      $errors['photos3Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.4']['Required']))
//                    {
//                      $errors['photos4Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.4']['Image']))
//                    {
//                      $errors['photos4Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.4']['uploaded']))
//                    {
//                      $errors['photos4Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.4']['Dimensions']))
//                    {
//                      $errors['photos4Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.5']['Required']))
//                    {
//                      $errors['photos5Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.5']['Image']))
//                    {
//                      $errors['photos5Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.5']['uploaded']))
//                    {
//                      $errors['photos5Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.5']['Dimensions']))
//                    {
//                      $errors['photos5Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.6']['Required']))
//                    {
//                      $errors['photos6Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.6']['Image']))
//                    {
//                      $errors['photos6Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.6']['uploaded']))
//                    {
//                      $errors['photos6Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.6']['Dimensions']))
//                    {
//                      $errors['photos6Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.7']['Required']))
//                    {
//                      $errors['photos7Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.7']['Image']))
//                    {
//                      $errors['photos7Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.7']['uploaded']))
//                    {
//                      $errors['photos7Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.7']['Dimensions']))
//                    {
//                      $errors['photos7Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.8']['Required']))
//                    {
//                      $errors['photos8Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.8']['Image']))
//                    {
//                      $errors['photos8Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.8']['uploaded']))
//                    {
//                      $errors['photos8Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.8']['Dimensions']))
//                    {
//                      $errors['photos8Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.9']['Required']))
//                    {
//                      $errors['photos9Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.9']['Image']))
//                    {
//                      $errors['photos9Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.9']['uploaded']))
//                    {
//                      $errors['photos9Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.9']['Dimensions']))
//                    {
//                      $errors['photos9Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }
//
// // ----------------------------------------------------------------------------------------------------------------------------------------------------------
//
//                   if(isset($failedRules['photos.10']['Required']))
//                    {
//                      $errors['photos10Required'] = ("Debe adjuntar una foto.");
//                    }
//
//                   if(isset($failedRules['photos.10']['Image']))
//                    {
//                      $errors['photos10Image'] = ("Todas las fotos deben estar en formato .JPEG, .PNG o .JPG.");
//                    }
//
//                   if(isset($failedRules['photos.10']['uploaded']))
//                    {
//                      $errors['photos10Uploaded'] = ("Error al subir una o mas fotos.");
//                    }
//
//                   if(isset($failedRules['photos.10']['Dimensions']))
//                    {
//                      $errors['photos10Dimensions'] = ("Todas las fotos deben tener un tamaño mínimo de 640 x 480.");
//                    }

                   return Redirect::back()->withErrors($errors);

           }

           $fotosASubir = $request->photos;

           $cantidadFotos = $request->cantidadFotos;

           // {{dd($cantidadFotos);}}

           return $this->subirFotos($fotosASubir, $idProyecto, $nombreProyecto, $cantidadFotos);
    }

    public function subirFotos($fotosASubir, $idProyecto, $nombreProyecto, $cantidadFotos)
    {


      // {{dd($cantidadFotos);}}

      // $fotosSubidas = DB::table('project_pictures')->where("picture_number", "!=", null)->first();

      $fotosSubidas = DB::table('project_pictures')->where("picture_number", "!=", null)->get();

      // {{dd($fotosSubidas);}}

      $implode = $fotosSubidas->implode('picture_number', ",");
      // {{dd($implode);}}
      //
      $fotosEnDB = explode(",", $implode);   //TRAE TODOS LOS NÚMEROS DE FOTO DE CADA ARCHIVO SUBIDO

      // {{dd($fotosEnDB);}}


      // // $tres = explode(", ", $fotosEnDB);
      //
      // {{dd($fotosEnDB);}}

      // if($fotosEnDB['0'] == "")
      // {
      //   var_dump("Si, es null!");exit;
      // }else {
      //   var_dump("No, no es null!");exit;
      // }

      // // {{dd($fotosEnDB);}}
      //
      // foreach ($fotosEnDB as $numero) {
      //   var_dump($numero);
      // };exit;

      // {{dd($numeroFoto);}}

      // for ($i=0; $i < ; $i++) {
      //   # code...
      // }



        foreach ($fotosASubir as $fotoASubir) {   // POR CADA FOTO QUE ESTOY QUERIENDO SUBIR
          // {{dd($fotosASubir);}}

        if($fotosEnDB['0'] == "" && !isset($numeroFoto))
        {
          $numeroFoto = 1;  //SI NO HAY NINGUNA FOTO SUBIDA, ESTA ES LA PRIMERA
        }

        foreach($fotosEnDB as $fotoEnDB) {  // POR CADA FOTO QUE HAY EN LA BASE DE DATOS

          for ($i=1; $i < 11; $i++) { //COMPARAR CADA NUMERO DE FOTO A VER SI HAY HUECOS

          if($fotoEnDB == $i) { // SI LA FOTO ES IGUAL AL FOR CONTINUA
            continue;
          } elseif($fotoEnDB != $i) { // SI LA FOTO NO ES IGUAL AL I, SIGNIFICA QUE ESE ESPACIO ESTÁ HUECO

            var_dump($fotoEnDB, $i);

            $numeroFoto = $i;

            $proyecto = ($nombreProyecto . "/" . "Fotos");

            $file = $fotoASubir;

            $ext = 'jpeg';

            $name = ('Foto-' . $numeroFoto);

                ProjectPictures::create([
                    'nombre' => $name,
                    'project_id' => $idProyecto,
                    'picture_number' => $numeroFoto,
                ]);

            $file->storeAs($proyecto, $name.'.'.$ext);

            break;

          }


          }

        }

        // $proyecto = $nombreProyecto;
        // // {{dd($proyecto);}}
        // $file = $fotoASubir;
        // // {{dd($file);}}
        // $ext = 'jpeg';
        // // $ext = $file->extension();
        // // {{dd($ext);}}
        // // $name = uniqid();
        // // $name = ucfirst(($data['username'] . '-perfil'));
        //
        // $name = ('Foto-' . $numeroFoto);
        // // {{dd($name);}}
        //
        // // $file->storeAs($user, $name.'.'.$ext);
        //
        // // $image = new \App\Image(['src' => $name.'.'.$ext]);
        //
        // // $image = $name . '.' . $ext;
        // // var_dump($numeroFoto);exit;
        //     ProjectPictures::create([
        //         'nombre' => $name,
        //         'project_id' => $idProyecto,
        //         'picture_number' => $numeroFoto,
        //     ]);
        //
        // $numeroFoto = $numeroFoto + 1;
        //
        // $file->storeAs($proyecto, $name.'.'.$ext);

      }

    Session::flash('fotosSubidas', "Las fotos se han subido satisfactoriamente.");

    return Redirect::back();
  }

}
