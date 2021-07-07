<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;
class AlumnoController extends Controller
{
    //
    public function create()
    {
       return view('alumno.create');
    }
 
    public function insert(Request $request)
    {
       $alumnos = array();
       $resultado = " ";
       $lista = array();
 
       if ($request->isMethod("post") && $request->has("btEnviar")) {
 
          if (Storage::disk('local')->exists('archivo_alumnos.txt')) {
             $file = Storage::get('archivo_alumnos.txt');
             $alumnos = unserialize($file);
          }
 
          $foto = $request->file("a-foto");
          //obtenemos el nombre del archivo
          $nombrearchivofoto = $foto->getClientOriginalName();
          //indicamos que queremos guardar un nuevo archivo en el disco local
          Storage::disk('public')->put($nombrearchivofoto,  File::get($foto));
 
          $al = new stdClass();
          $al->email = $request->input("a-email");
          $al->nombre = $request->input("a-nombre");
          $al->carnet = $request->input("a-ncarnet");
          $al->edad = $request->input("a-edad");
          $al->curso = $request->input("a-curso");       
          $al->foto = $nombrearchivofoto;
 
          array_push($alumnos, $al);
          $alumnosSerialice = serialize($alumnos);
          Storage::disk('local')->put('archivo_alumnos.txt', $alumnosSerialice);
 
          $resultado = "Registro guardado satisfactoriamente...";
       }
 
       return view('alumno.resformu')->with('res', $resultado)->with('listado', $lista);
    }
 
    public function list()
    {
       $lista = array();
 
       if (Storage::disk('local')->exists('archivo_alumnos.txt')) {
          $file = Storage::get('archivo_alumnos.txt');
          $lista = unserialize($file);
          return view('alumno.resformu')->with('res', null)->with('listado', $lista);
       }
       return view('alumno.resformu')->with('res', null)->with('listado', $lista);
    }
    /**Se escanga de buscar el objeto que se va a editar y se lo pasa a la vista editar */
    public function editar($Carnet)
    {
        $lista = array();
        
        $Res = "";
        $alumno = new stdClass();
        if (Storage::disk('local')->exists('archivo_alumnos.txt')) {
           $file = Storage::get('archivo_alumnos.txt');
           $lista = unserialize($file);
          
        }
        else
        {
            $Res = "Error";
            return view('alumno.resformu')->with('res',$Res)->with('listado',$lista);
        }
        $Search = false;
        foreach($lista as $alumno)
        {
            if(strcmp($alumno->carnet,$Carnet) == 0)
            {
                $Search = true;
                break;
            }
        }

        if($Search == false)
        {
            $Res = "Alumno no encontrado";
            $lista = array();
            return view('alumno.resformu')->with('res',$Res)->with('listado',$lista);
        }
        return view('alumno.editar')->with('al',$alumno);
    }

    /** Recive un formulario a traves de post con los datos a Actualizar enviados desde la vista editar  */
    public function actualizar(Request $request)
    {
       $alumnos = array();
       $resultado = " ";
       $lista = array();
 
       if ($request->isMethod("post") && $request->has("btEnviar")) {
 
          if (Storage::disk('local')->exists('archivo_alumnos.txt')) {
             $file = Storage::get('archivo_alumnos.txt');
             $alumnos = unserialize($file);
          }
          var_export($alumnos);
          $foto = $request->file("a-foto");
          $nombrearchivofoto = null;
          if($foto != null)
          {
            $nombrearchivofoto = $foto->getClientOriginalName();
          }/*echo "<h1>claro que la foto no se envió</h1>";*/
          //obtenemos el nombre del archivo
          
          //indicamos que queremos guardar un nuevo archivo en el disco local
          
 
          $al = new stdClass();
          $al->email = $request->input("a-email");
          
          $al->nombre = $request->input("a-nombre");
          $al->carnet = $request->input("a-ncarnet");
          $al->edad = $request->input("a-edad");
          $al->curso = $request->input("a-curso");       
          $al->foto = $nombrearchivofoto;

          $alum = new stdClass();
          $Indexer = 0;
          foreach($alumnos as $alum)
          {
              if($alum->carnet == $al->carnet)
              {
                  if($al->foto != null)
                  {
                    if(Storage::disk('public')->exists($alum->foto))
                    {
                        Storage::disk('public')->delete($alum->foto);
                    }
                    
                    Storage::disk('public')->put($nombrearchivofoto,  File::get($foto));
                    $alumnos[$Indexer]->foto = $al->foto;

                  }
                  $alumnos[$Indexer]->email = $al->email;
                  $alumnos[$Indexer]->nombre = $al->nombre;
                  $alumnos[$Indexer]->carnet = $al->carnet;
                  $alumnos[$Indexer]->edad = $al->edad;
                  $alumnos[$Indexer]->curso = $al->curso;
                 
                  break;
              }
              $Indexer++;
          }
          
          $alumnosSerialice = serialize($alumnos);
          Storage::disk('local')->put('archivo_alumnos.txt', $alumnosSerialice);
 
          $resultado = "Registro Actualizado satisfactoriamente...";
       }
 
       return view('alumno.resformu')->with('res', $resultado)->with('listado', $lista);
    }

    
    /*Borrar*/
    public function borrar($Carnet) 
    {
        $lista = array();
        $Res = "";
        $listasave = array();
        $alumno = new stdClass();
        if (Storage::disk('local')->exists('archivo_alumnos.txt')) {
           $file = Storage::get('archivo_alumnos.txt');
           $lista = unserialize($file);
          
        }
        else
        {
            $Res = "Error";
            return view('alumno.resformu')->with('res',$Res)->with('listado',$lista);
        }
        $Search = false;
        $Indexer = 0;
        foreach($lista as $alumno)
        {
            if(strcmp($alumno->carnet,$Carnet) == 0)
            {
                $Search = true;
                if(Storage::disk('public')->exists($alumno->foto))
                {
                    Storage::disk('public')->delete($alumno->foto);
                }
                
                break;
            }
            $Indexer++;
        }
       
        
        echo "Indice de ultimo: ".$Indexer;
        if($Search == false)
        {
            $Res = "Alumno no encontrado";
            $lista = array();
            
        }
        else
        {
            $Res = "Alumno Borrado con exito";
            unset($lista[$Indexer]);
            foreach($lista as $element)
            {
                array_push($listasave,$element);
            }
            $alumnosSerialice = serialize($listasave);
            Storage::disk('local')->put('archivo_alumnos.txt', $alumnosSerialice);
            $lista = array();
            
        }
        return view('alumno.resformu')->with('res',$Res)->with('listado',$lista);
    }
}
