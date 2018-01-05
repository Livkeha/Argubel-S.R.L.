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

           if($request->cantidadPlanos + $blueprints > 30)
           {
             Session::flash('maximoPlanosExcedido', "Cada proyecto no puede tener mas de 30 planos.");

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


                   if(isset($failedRules['blueprints.0']['Max']) || isset($failedRules['blueprints.1']['Max']) || isset($failedRules['blueprints.2']['Max']) || isset($failedRules['blueprints.3']['Max']) || isset($failedRules['blueprints.4']['Max']) || isset($failedRules['blueprints.5']['Max']) || isset($failedRules['blueprints.6']['Max']) || isset($failedRules['blueprints.7']['Max']) || isset($failedRules['blueprints.8']['Max']) || isset($failedRules['blueprints.9']['Max']) || isset($failedRules['blueprints.10']['Max']) || isset($failedRules['blueprints.11']['Max']) || isset($failedRules['blueprints.12']['Max']) || isset($failedRules['blueprints.13']['Max']) || isset($failedRules['blueprints.14']['Max']) || isset($failedRules['blueprints.15']['Max']) || isset($failedRules['blueprints.16']['Max']) || isset($failedRules['blueprints.17']['Max']) || isset($failedRules['blueprints.18']['Max']) || isset($failedRules['blueprints.19']['Max']) || isset($failedRules['blueprints.20']['Max']) || isset($failedRules['blueprints.21']['Max']) || isset($failedRules['blueprints.22']['Max']) || isset($failedRules['blueprints.23']['Max']) || isset($failedRules['blueprints.24']['Max']) || isset($failedRules['blueprints.25']['Max']) || isset($failedRules['blueprints.26']['Max']) || isset($failedRules['blueprints.27']['Max']) || isset($failedRules['blueprints.28']['Max']) || isset($failedRules['blueprints.29']['Max']) || isset($failedRules['blueprints.30']['Max']))
                    {
                     $errors['blueprints0Max'] = ("Cada plano no debe exceder los 10MB de peso.");
                   }

                   if(isset($failedRules['blueprints.0']['Image']) || isset($failedRules['blueprints.1']['Image']) || isset($failedRules['blueprints.2']['Image']) || isset($failedRules['blueprints.3']['Image']) || isset($failedRules['blueprints.4']['Image']) || isset($failedRules['blueprints.5']['Image']) || isset($failedRules['blueprints.6']['Image']) || isset($failedRules['blueprints.7']['Image']) || isset($failedRules['blueprints.8']['Image']) || isset($failedRules['blueprints.9']['Image']) || isset($failedRules['blueprints.10']['Image']) || isset($failedRules['blueprints.11']['Image']) || isset($failedRules['blueprints.12']['Image']) || isset($failedRules['blueprints.13']['Image']) || isset($failedRules['blueprints.14']['Image']) || isset($failedRules['blueprints.15']['Image']) || isset($failedRules['blueprints.16']['Image']) || isset($failedRules['blueprints.17']['Image']) || isset($failedRules['blueprints.18']['Image']) || isset($failedRules['blueprints.19']['Image']) || isset($failedRules['blueprints.20']['Image']) || isset($failedRules['blueprints.21']['Image']) || isset($failedRules['blueprints.22']['Image']) || isset($failedRules['blueprints.23']['Image']) || isset($failedRules['blueprints.24']['Image']) || isset($failedRules['blueprints.25']['Image']) || isset($failedRules['blueprints.26']['Image']) || isset($failedRules['blueprints.27']['Image']) || isset($failedRules['blueprints.28']['Image']) || isset($failedRules['blueprints.29']['Image']) || isset($failedRules['blueprints.30']['Image']))
                    {
                     $errors['blueprints0Image'] = ("Todas los planos deben estar en formato .JPEG, .PNG o .JPG.");
                   }

                   if(isset($failedRules['blueprints.0']['uploaded']) || isset($failedRules['blueprints.1']['uploaded']) || isset($failedRules['blueprints.2']['uploaded']) || isset($failedRules['blueprints.3']['uploaded']) || isset($failedRules['blueprints.4']['uploaded']) || isset($failedRules['blueprints.5']['uploaded']) || isset($failedRules['blueprints.6']['uploaded']) || isset($failedRules['blueprints.7']['uploaded']) || isset($failedRules['blueprints.8']['uploaded']) || isset($failedRules['blueprints.9']['uploaded']) || isset($failedRules['blueprints.10']['uploaded']) || isset($failedRules['blueprints.11']['uploaded']) || isset($failedRules['blueprints.12']['uploaded']) || isset($failedRules['blueprints.13']['uploaded']) || isset($failedRules['blueprints.14']['uploaded']) || isset($failedRules['blueprints.15']['uploaded']) || isset($failedRules['blueprints.16']['uploaded']) || isset($failedRules['blueprints.17']['uploaded']) || isset($failedRules['blueprints.18']['uploaded']) || isset($failedRules['blueprints.19']['uploaded']) || isset($failedRules['blueprints.20']['uploaded']) || isset($failedRules['blueprints.21']['uploaded']) || isset($failedRules['blueprints.22']['uploaded']) || isset($failedRules['blueprints.23']['uploaded']) || isset($failedRules['blueprints.24']['uploaded']) || isset($failedRules['blueprints.25']['uploaded']) || isset($failedRules['blueprints.26']['uploaded']) || isset($failedRules['blueprints.27']['uploaded']) || isset($failedRules['blueprints.28']['uploaded']) || isset($failedRules['blueprints.29']['uploaded']) || isset($failedRules['blueprints.30']['uploaded']))
                    {
                     $errors['blueprints0Uploaded'] = ("Todas los planos deben estar en formato .JPEG, .PNG o .JPG.");
                   }

                   if(isset($failedRules['blueprints.0']['Dimensions']) || isset($failedRules['blueprints.1']['Dimensions']) || isset($failedRules['blueprints.2']['Dimensions']) || isset($failedRules['blueprints.3']['Dimensions']) || isset($failedRules['blueprints.4']['Dimensions']) || isset($failedRules['blueprints.5']['Dimensions']) || isset($failedRules['blueprints.6']['Dimensions']) || isset($failedRules['blueprints.7']['Dimensions']) || isset($failedRules['blueprints.8']['Dimensions']) || isset($failedRules['blueprints.9']['Dimensions']) || isset($failedRules['blueprints.10']['Dimensions']) || isset($failedRules['blueprints.11']['Dimensions']) || isset($failedRules['blueprints.12']['Dimensions']) || isset($failedRules['blueprints.13']['Dimensions']) || isset($failedRules['blueprints.14']['Dimensions']) || isset($failedRules['blueprints.15']['Dimensions']) || isset($failedRules['blueprints.16']['Dimensions']) || isset($failedRules['blueprints.17']['Dimensions']) || isset($failedRules['blueprints.18']['Dimensions']) || isset($failedRules['blueprints.19']['Dimensions']) || isset($failedRules['blueprints.20']['Dimensions']) || isset($failedRules['blueprints.21']['Dimensions']) || isset($failedRules['blueprints.22']['Dimensions']) || isset($failedRules['blueprints.23']['Dimensions']) || isset($failedRules['blueprints.24']['Dimensions']) || isset($failedRules['blueprints.25']['Dimensions']) || isset($failedRules['blueprints.26']['Dimensions']) || isset($failedRules['blueprints.27']['Dimensions']) || isset($failedRules['blueprints.28']['Dimensions']) || isset($failedRules['blueprints.29']['Dimensions']) || isset($failedRules['blueprints.30']['Dimensions']))
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

      $planosSubidos = DB::table('project_blueprints')->where("blueprint_number", "!=", null)->where("project_id", "=", "$idProyecto")->get();

      $implode = $planosSubidos->implode('blueprint_number', ",");

      $planosEnDB = explode(",", $implode);   //TRAE TODOS LOS NÚMEROS DE PLANO DE CADA ARCHIVO SUBIDO

      $numeroPlano = end($planosEnDB);

        foreach ($planosASubir as $planoASubir) {   // POR CADA FOTO QUE ESTOY QUERIENDO SUBIR

          foreach ($planosEnDB as $planoEnDB) {

            while ($numeroPlano == $planoEnDB) {
              if($numeroPlano == "") $numeroPlano = 0;
              $numeroPlano = $numeroPlano + 1;
              break;
            };

          }

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

            $numeroPlano = $numeroPlano + 1;

      }

    Session::flash('planosSubidos', "Los planos se han subido satisfactoriamente.");

    return Redirect::back();
  }
}
