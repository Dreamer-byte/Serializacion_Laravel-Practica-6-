<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class AutoController extends Controller
{
    //
    public function create()
    {
       return view('auto.create');
    }
 
    public function insert(Request $request)
    {
       $Autos = array();
       $resultado = " ";
       $listaAutos = array();
 
       if ($request->isMethod("post") && $request->has("btEnviar")) {
 
          if (Storage::disk('local')->exists('archivo_autos.txt')) {
             $file = Storage::get('archivo_alumnos.txt');
             $alumnos = unserialize($file);
          }
 
          $foto = $request->file("au-foto");
          
          //obtenemos el nombre del archivo
          $nombrearchivofoto = $foto->getClientOriginalName();
          var_dump($nombrearchivofoto);
          //indicamos que queremos guardar un nuevo archivo en el disco local
          Storage::disk('public')->put($nombrearchivofoto,  File::get($foto));
 
          $auto = new stdClass();
          $auto->Placa = $request->input("au-placa");
          $auto->Marca = $request->input("au-marca");
          $auto->Modelo = $request->input("au-modelo");


          $auto->color = $request->input("au-color");
          
          $auto->foto = $nombrearchivofoto;
 
          array_push($Autos, $auto);
          $AutosSerialize = serialize($Autos);
          Storage::disk('local')->put('archivo_autos.txt', $AutosSerialize);
 
          $resultado = "Registro guardado satisfactoriamente...";
       }
 
       return view('alumno.resformu')->with('res', $resultado)->with('listado', $listaAutos);
    }


    /*FUNTION LIST */

    public function list()
    {
       $lista = array();
 
       if (Storage::disk('local')->exists('archivo_autos.txt')) {
          $file = Storage::get('archivo_autos.txt');
          $lista = unserialize($file);
          
          return view('auto.resformu')->with('res', null)->with('listado', $lista);
       }
       return view('auto.resformu')->with('res', null)->with('listado', $lista);
    }

    /**Editar Fuction */

    public function editar($Placa)
    {
        $lista = array();
        
        $Res = "";
        $auto = new stdClass();
        if (Storage::disk('local')->exists('archivo_autos.txt')) {
           $file = Storage::get('archivo_autos.txt');
           $lista = unserialize($file);
          
        }
        else
        {
            $Res = "Error";
            return view('auto.resformu')->with('res',$Res)->with('listado',$lista);
        }
        $Search = false;
        foreach($lista as $auto)
        {
            if(strcmp($auto->Placa,$Placa) == 0)
            {
                $Search = true;
                break;
            }
        }

        if($Search == false)
        {
            $Res = "Auto no encontrado";
            $lista = array();
            return view('auto.resformu')->with('res',$Res)->with('listado',$lista);
        }
        return view('auto.editar')->with('au',$auto);
    }


    /*Actuaalizar */

    public function actualizar(Request $request)
    {
       $autos = array();
       $resultado = " ";
       $lista = array();
 
       if ($request->isMethod("post") && $request->has("btEnviar")) {
 
          if (Storage::disk('local')->exists('archivo_autos.txt')) {
             $file = Storage::get('archivo_autos.txt');
             $autos = unserialize($file);
          }
          var_export($autos);
          $foto = $request->file("au-foto");
          $nombrearchivofoto = null;
          if($foto != null)
          {
             //obtenemos el nombre del archivo
            $nombrearchivofoto = $foto->getClientOriginalName();
          }/*echo "<h1>claro que la foto no se envió</h1>";*/
          
          
          //indicamos que queremos guardar un nuevo archivo en el disco local
          
 
          $au = new stdClass();
          $au->Marca = $request->input("au-marca");
          $au->Modelo = $request->input("au-modelo");
          $au->Placa = $request->input("au-placa");
          $au->color = $request->input("au-color");
               
          $au->foto = $nombrearchivofoto;

          $auto = new stdClass();
          $Indexer = 0;
          foreach($autos as $auto)
          {
              if($auto->Placa == $au->Placa)
              {
                  if($au->foto != null)
                  {
                    if(Storage::disk('public')->exists($au->foto))
                    {
                        Storage::disk('public')->delete($au->foto);
                    }
                    
                    Storage::disk('public')->put($nombrearchivofoto,  File::get($foto));
                    $autos[$Indexer]->foto = $au->foto;

                  }
                  $autos[$Indexer]->Placa = $au->Placa;
                  $autos[$Indexer]->Marca = $au->Marca;
                  $autos[$Indexer]->Modelo = $au->Modelo;
                  $autos[$Indexer]->color = $au->color;
                  
                 
                  break;
              }
              $Indexer++;
          }
          
          $AutosSerialize = serialize($autos);
          Storage::disk('local')->put('archivo_autos.txt', $AutosSerialize);
 
          $resultado = "Registro Actualizado satisfactoriamente...";
       }
 
       return view('auto.resformu')->with('res', $resultado)->with('listado', $lista);
    }





     /*Borrar*/
     public function borrar($Placa) 
     {
         $lista = array();
         $Res = "";
         $listasave = array();
         $auto = new stdClass();
         if (Storage::disk('local')->exists('archivo_autos.txt')) {
            $file = Storage::get('archivo_autos.txt');
            $lista = unserialize($file);
           
         }
         else
         {
             $Res = "Error";
             return view('autoresformu')->with('res',$Res)->with('listado',$lista);
         }
         $Search = false;
         $Indexer = 0;
         foreach($lista as $auto)
         {
             if(strcmp($auto->Placa,$Placa) == 0)
             {
                 $Search = true;
                 if(Storage::disk('public')->exists($auto->foto))
                 {
                     Storage::disk('public')->delete($auto->foto);
                 }
                 
                 break;
             }
             $Indexer++;
         }
        
         
         echo "Indice de ultimo: ".$Indexer;
         if($Search == false)
         {
             $Res = "Auto no encontrado";
             $lista = array();
             
         }
         else
         {
             $Res = "Auto Borrado con exito";
             unset($lista[$Indexer]);
             foreach($lista as $element)
             {
                 array_push($listasave,$element);
             }
             $AutosSerialize = serialize($listasave);
             Storage::disk('local')->put('archivo_autos.txt', $AutosSerialize);
             $lista = array();
             
         }
         return view('auto.resformu')->with('res',$Res)->with('listado',$lista);
     }






}
