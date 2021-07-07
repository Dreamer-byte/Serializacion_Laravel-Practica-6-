<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function Saludar($Nombre)
    {
        $Nombre = strtoupper($Nombre);

        return view('VistaSaludo',compact('Nombre'));
    }

    public function ClacularEdad($Nombre,$Anyo)
    {
        $edad = date('Y') - $Anyo;

        return view('Edad',compact('Nombre','edad'));
    }

    public function Comparar($FirtsName,$LastName)
    {
        $Res = strcmp($FirtsName,$LastName);

        return view('Comparacion-Nombre',compact('Res','FirtsName','LastName'));
    }

    public function Operaciones($Value1,$Opc,$Value2)
    {
        $Res = 0;
        switch($Opc)
        {
            case '+':
                $Res = $Value1 + $Value2;
                $Opc = "Suma";
                break;
                case '-':
                    $Res = $Value1 - $Value2;
                    $Opc = "Resta";
                    break;
                 case '*':
                    $Res = $Value1 - $Value2;
                    $Opc = "Multiplicacion";
                    break;
                case 'div':
                    $Opc = "Division";
                    if($Value2 == 0)
                    {
                        $Res =  "No se puede dividir entre 0";
                    }
                    else
                    {
                        $Res = $Value1 / $Value2;
                    }
                    break;
                    default: 
                    $Res = "Operacion  Invalida";
        }

        return view('Operaciones',compact('Value1','Value2','Res','Opc'));
    }
}
