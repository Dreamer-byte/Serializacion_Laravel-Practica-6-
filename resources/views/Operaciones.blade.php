@extends('plantilla')

@section('contenido')
    <table class="table table-bordered table-success">
        <thead>
            <tr aria-colspan="3" >
                <th class="text-center" margin = "5">Operacion: {{$Opc}}</th>
            </tr>
            <tr>
                <td>Valor 1</td>
                <td>Valor 2</td>
                <td>Resultados</td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{$Value1}}</td>
                <td>{{$Value2}}</td>
                <td>{{$Res}}</td>
            </tr>
        </tbody>
    </table>
@endsection