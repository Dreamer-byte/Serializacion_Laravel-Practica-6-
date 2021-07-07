<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="margin-top: 2em;">
                <div class="card text-center">
                    <div class="card-header">
                       <h1>Formulario Alumnos</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{asset('/alumno/create')}}" class="btn btn-link btn-primary" style="color:white;">Ir a Alumnos</a>
                    </div>
                </div>

            </div>

            <div class="col-md-3" style="margin-top: 2em;">
                <div class="card text-center">
                    <div class="card-header">
                       <h1>Formulario Autos</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{asset('/auto/create')}}" class="btn btn-link btn-primary" style="color:white;">Ir a Autos</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>