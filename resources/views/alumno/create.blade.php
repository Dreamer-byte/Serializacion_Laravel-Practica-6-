@extends('plantilla')

 
@section('contenido')
    <a class="btn btn-primary" href="/alumno/list" role="button">Ver Listado de Alumnos</a>

    <hr />

    <h1>Formulario Alumnos</h1>

    <form action="{{ url('/alumno/insert') }}" method="post" class="col-md-6" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="email" class="form-control col-md-6" name="a-email" placeholder="Ingrese su correo electrónico"
                required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="a-nombre" placeholder="Ingrese su nombre completo" maxlength="200"
                required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control col-md-6" name="a-ncarnet" placeholder="Ingrese su número de carnet"
                maxlength="10" required>
        </div>
        <div class="form-group">
            <input type="number" class="form-control col-md-3" name="a-edad" placeholder="Edad" min="15" max="50" required>
        </div>
        <div class="form-group">
            <input type="number" class="form-control col-md-3" name="a-curso" placeholder="Curso" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="a-foto" id="a-foto" required>
        </div>
        <button type="submit" name="btEnviar" value="btAlumno" class="btn btn-primary">Enviar</button>
    </form>
@endsection