<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados {{$año}} - Dpto Tutoría</title>
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
            <p class="h4"><strong>Resultados {{$año}} - Dpto Tutoría</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p><strong>Alumno:</strong> {{ $alumno->nombre_apellidos }}</p>
            <p><strong>Grado:</strong> {{ $alumno->aula->grado.$alumno->aula->seccion }}</p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Prueba</th>
                <th>Estado</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $resultados as $it)
                <tr>
                    <td style="width: 7%">{{ $loop->iteration}}</td>
                    <td style="width: 15%">{{ date_create($it->fecha_tomada)->format('d-m-Y')}}</td>
                    <td style="width: 24%">{{ $it->nombre}}</td>
                    <td>{{ $it->estado}}</td>
                    <td style="width: 42%">{{ $it->observacion}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <p><strong>Recomendaciones: </strong></p>
    <ol>
        @foreach ($resultados as $it)
            <li>{{$it->recomendacion}}</li>
        @endforeach
    </ol>

    <div class="text-center mt-5">
        <div class="pt-2">
            <p> ___________________________</p>
        </div>
        <p>{{$psicologo}}<br>Psicólogo</p>
    </div>

</body>
</html>
