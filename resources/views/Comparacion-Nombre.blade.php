@extends('plantilla')
@section('contenido')
    @if ($Res<0)
        <h1 class="alert-success"> El Nombre: {{$FirtsName}} es mayor que  {{$LastName}}</h1>
        @else
        @if ($Res>0)
        <h1 class="alert-success"> El Nombre: {{$FirtsName}} es menor que  {{$LastName}}</h1>
        @else
        <h1 class="alert-success"> Los Nombres: {{$FirtsName}}  y  {{$LastName}}  son iguales</h1>
        @endif
    @endif
@endsection