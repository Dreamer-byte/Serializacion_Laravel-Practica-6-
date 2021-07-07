@extends('plantilla')

 
@section('contenido')

    <h1 class="title">Editar alumno</h1>
    <hr />

    <form action="{{ url('/alumno/actualizar') }}" method="post" class="col-md-6" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="email" class="form-control col-md-6" name="a-email" value="{{$al->email}}"
                required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="a-nombre" value="{{$al->nombre}}" maxlength="200"
                required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control col-md-6" name="a-ncarnet" 
                maxlength="10" readonly value="{{$al->carnet}}">
        </div>
        <div class="form-group">
            <input type="number" class="form-control col-md-3" name="a-edad" value="{{$al->edad}}" min="15" max="50" required>
        </div>
        <div class="form-group">
            <input type="number" class="form-control col-md-3" name="a-curso" value="{{$al->curso}}" min="1" max="5" required>
        </div>
        <div class="form-group img">
            <img id="img" src="/Storage/{{$al->foto}}" alt="imagen de perfil" style="width: 8em; height: 8em; ">

        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="a-foto" id="a-foto">
        </div>
        <button type="submit" name="btEnviar" value="btAlumno" class="btn btn-primary">Enviar</button>
    </form>
    
   <br/>
   <a href='/alumno/create' class='card-link'>Ir Atrás</a>
@endsection