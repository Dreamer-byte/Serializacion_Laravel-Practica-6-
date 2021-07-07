
@extends('plantilla')

 
@section('contenido')
    <a class="btn btn-success" href="/auto/list" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
          </svg>
        <!--Ver Listado de Autos--></a>

    <hr />

    <center><h1>Formulario Autos</h1></center>

    <form action="{{ url('/auto/insert') }}" method="post" class="col-md-6" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="input-group">
            <label for="floatingInput" class="input-group-text">Placa del vehiculo</label>
            <input type="tex" class="form-control" id="floatingInput" name="au-placa" placeholder="Placa" required>
          </div>
          
          <div class="input-group">
              <label for="mc" class="input-group-text">Marca:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            
            <input id="mc" type="text" class="form-control" name="au-marca" required placeholder="Marca" required>
          </div>
        
          <div class="input-group">
            <label for="md" class="input-group-text">Modelo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          
          <input id="md" type="text" class="form-control" name="au-modelo" required placeholder="Modelo" required>
        </div>
        <fieldset border="2">
            <legend>Elige un calor de carro</legend>
            <label for="r1">Rojo &nbsp;&nbsp;</label>
            <input type="radio" name="au-color" id="r1" required value="Rojo"><br>
            <label for="r2">Negro</label>
            <input type="radio" name="au-color" id="r2" value="Negro" required><br>
            <label for="r3">Blanco</label>
            <input type="radio" name="au-color" id="r3" value="Blanco" required><br>

        </fieldset>
        

        <div class="form-group">
            <label  class="input-group">Foto</label>
            <input type="file" class="form-control" name="au-foto" id="au-foto" required>
        </div>
        <button type="submit" name="btEnviar" value="btAlumno" class="btn btn-primary">Enviar</button>
    </form>
@endsection