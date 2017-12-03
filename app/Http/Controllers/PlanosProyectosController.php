<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\ProjectBlueprints;
use Session;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Auth;

class PlanosProyectosController extends Controller
{
    public function validarPlanos(Request $request)
    {

            if(Auth::user()->rol != "administrador" && $proyectoReferido == null || Auth::user()->rol == "cliente" && $proyectoReferido->id != Auth::user()->project_id)
              {
                Session::flash('permisoDenegado', "Usted no tiene permisos para acceder a esa ruta.");
                return Redirect::route('index');
              }

           $input = $request->all();
           $rules = [];

           $blueprints = count($request->blueprints);

           if($request->cantidadPlanos + $blueprints > 10)
           {
             Session::flash('maximoPlanosExcedido', "Cada proyecto no puede tener mas de 10 planos.");

             return Redirect::back();
           }

           $idProyecto = $request->idProyecto;
           $nombreProyecto = $request->nombreProyecto;

           foreach(range(0, $blueprints) as $index) {
                 $rules['blueprints.' . $index] = 'image|mimes:jpeg,png,jpg|dimensions:min_width=640,min_height=480|max:10240';
             }

           $validator = Validator::make($input, $rules);

           if ($validator->fails())
           {

                  $failedRules = $validator->failed();

                  $errors = [];

                  // {{dd($failedRules);}}


                   if(isset($failedRules['blueprints.0']['Max']) || isset($failedRules['blueprints.1']['Max']) || isset($failedRules['blueprints.2']['Max']) || isset($failedRules['blueprints.3']['Max']) || isset($failedRules['blueprints.4']['Max']) || isset($failedRules['blueprints.5']['Max']) || isset($failedRules['blueprints.6']['Max']) || isset($failedRules['blueprints.7']['Max']) || isset($failedRules['blueprints.8']['Max']) || isset($failedRules['blueprints.9']['Max']) || isset($failedRules['blueprints.10']['Max']))
                    {
                     $errors['blueprints0Max'] = ("Cada plano no debe exceder los 10MB de peso.");
                   }

                   if(isset($failedRules['blueprints.0']['Image']) || isset($failedRules['blueprints.1']['Image']) || isset($failedRules['blueprints.2']['Image']) || isset($failedRules['blueprints.3']['Image']) || isset($failedRules['blueprints.4']['Image']) || isset($failedRules['blueprints.5']['Image']) || isset($failedRules['blueprints.6']['Image']) || isset($failedRules['blueprints.7']['Image']) || isset($failedRules['blueprints.8']['Image']) || isset($failedRules['blueprints.9']['Image']) || isset($failedRules['blueprints.10']['Image']))
                    {
                     $errors['blueprints0Image'] = ("Todas los planos deben estar en formato .JPEG, .PNG o .JPG.");
                   }

                   if(isset($failedRules['blueprints.0']['uploaded']) || isset($failedRules['blueprints.1']['uploaded']) || isset($failedRules['blueprints.2']['uploaded']) || isset($failedRules['blueprints.3']['uploaded']) || isset($failedRules['blueprints.4']['uploaded']) || isset($failedRules['blueprints.5']['uploaded']) || isset($failedRules['blueprints.6']['uploaded']) || isset($failedRules['blueprints.7']['uploaded']) || isset($failedRules['blueprints.8']['uploaded']) || isset($failedRules['blueprints.9']['uploaded']) || isset($failedRules['blueprints.10']['uploaded']))
                    {
                     $errors['blueprints0Uploaded'] = ("Todas los planos deben estar en formato .JPEG, .PNG o .JPG.");
                   }

                   if(isset($failedRules['blueprints.0']['Dimensions']) || isset($failedRules['blueprints.1']['Dimensions']) || isset($failedRules['blueprints.2']['Dimensions']) || isset($failedRules['blueprints.3']['Dimensions']) || isset($failedRules['blueprints.4']['Dimensions']) || isset($failedRules['blueprints.5']['Dimensions']) || isset($failedRules['blueprints.6']['Dimensions']) || isset($failedRules['blueprints.7']['Dimensions']) || isset($failedRules['blueprints.8']['Dimensions']) || isset($failedRules['blueprints.9']['Dimensions']) || isset($failedRules['blueprints.10']['Dimensions']))
                    {
                     $errors['blueprints0Dimensions'] = ("Todas los planos deben tener un tamaño mínimo de 640 x 480.");
                   }

                   return Redirect::back()->withErrors($errors);

           }

           $planosASubir = $request->blueprints;

           $cantidadPlanos = $request->cantidadPlanos;

           return $this->subirPlanos($planosASubir, $idProyecto, $nombreProyecto, $cantidadPlanos);
    }

    public function subirPlanos($planosASubir, $idProyecto, $nombreProyecto, $cantidadPlanos)
    {

      $planosSubidos = DB::table('project_blueprints')->where("blueprint_number", "!=", null)->get();

      $implode = $planosSubidos->implode('blueprint_number', ",");

      $planosEnDB = explode(",", $implode);   //TRAE TODOS LOS NÚMEROS DE PLANO DE CADA ARCHIVO SUBIDO

        foreach ($planosASubir as $planoASubir) {   // POR CADA FOTO QUE ESTOY QUERIENDO SUBIR

        if($planosEnDB['0'] == "" && !isset($numeroPlano))
        {
          $numeroPlano = 1;  //SI NO HAY NINGUNA FOTO SUBIDA, ESTA ES LA PRIMERA
        }

        foreach($planosEnDB as $planoEnDB) {  // POR CADA FOTO QUE HAY EN LA BASE DE DATOS

          for ($i=1; $i < 11; $i++) { //COMPARAR CADA NUMERO DE FOTO A VER SI HAY HUECOS

          if($planoEnDB == $i) { // SI LA FOTO ES IGUAL AL FOR CONTINUA
            continue;
          } elseif($planoEnDB != $i) { // SI LA FOTO NO ES IGUAL AL I, SIGNIFICA QUE ESE ESPACIO ESTÁ HUECO

            $numeroPlano = $i;

            $proyecto = ($nombreProyecto . "/" . "Planos");

            $file = $planoASubir;

            $ext = 'jpeg';

            $name = ('Plano-' . $numeroPlano);

                ProjectBlueprints::create([
                    'nombre' => $name,
                    'project_id' => $idProyecto,
                    'blueprint_number' => $numeroPlano,
                ]);

            $file->storeAs($proyecto, $name.'.'.$ext);

            break;

          }


          }

        }

      }

    Session::flash('planosSubidos', "Los planos se han subido satisfactoriamente.");

    return Redirect::back();
  }

}
