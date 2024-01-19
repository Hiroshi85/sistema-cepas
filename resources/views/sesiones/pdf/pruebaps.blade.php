<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>S{{$resultado->id." - ".$resultado->nombre}}</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
    body {
        font-family: 'Helvetica';
    }
    @page {
            margin: 0 !important;
            padding: 0 !important;
    }
</style>
<body class="container my-4">

    <!-- Encabezado con el logo del colegio y título -->
    <div class="row mb-4 text-center">
        <div class="col-12">
            <!-- Reemplaza la URL con la ubicación de tu logo -->
            <img src="assets/cepas_escudo.png" width="100">
        </div>
        <div class="col-12">
            <p class="h4"><strong>Sesión {{$resultado->id}} - {{$resultado->nombre}}</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p><strong>Alumno:</strong> {{ $resultado->nombre_apellidos }}</p>
            <div>
                <p><strong>Grado:</strong> {{ $resultado->grado.$resultado->seccion }}</p>

                <p><strong>Fecha de sesión:</strong> {{$resultado->fecha_tomada}}</p>
                <p><strong>Fecha evaluada:</strong> {{$resultado->fecha_evaluado}}</p>
                </p>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Puntaje</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $resultado->puntaje}}</td>
                    <td>{{ $resultado->estado}}</td>
                </tr>
        </tbody>
    </table>
    <div>
        <p><strong>Observación:</strong></p>
        <p>{{ $resultado->observacion }}</p>
        <p><strong>Recomendación:</strong></p>
        <p>{{ $resultado->recomendacion }}</p>
        </p>
    </div>
    <br>
    <div class="text-center mt-5">
        <div class="pt-2">
            <p> ___________________________</p>
        </div>
        <p>{{$psicologo}}<br>Psicólogo</p>
    </div>

</body>
</html>
