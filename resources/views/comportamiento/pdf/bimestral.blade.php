<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Bimestral de Comportamientos</title>
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
            <p class="h4"><strong>Reporte Bimestral de Comportamientos</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p><strong>Alumno:</strong> {{ $alumno->nombre_apellidos }}</p>
            <div>
                <p><strong>Grado:</strong> {{ $alumno->aula->grado.$alumno->aula->seccion }}
                    <span class="mx-10 w-10"></span>
                <strong>Bimestre:</strong> {{$bimestre}} </p>
            </div>
        </div>
    </div>
    @if(count($comportamientos)!=0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha y hora</th>
                <th>Comportamiento</th>
                <th>Sanción</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comportamientos as $comportamiento)
                <tr>
                    <td>{{ $comportamiento->fecha}}</td>
                    <td>{{ $comportamiento->nombre }}</td>
                    <td>{{ $comportamiento->sancion ?? 'Ninguna' }}</td>
                    <td>{{ $comportamiento->puntaje }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><strong>Nota Final</strong></td>
                <td class="@if ($nota < 14)
                    text-danger
                @endif"><strong>{{ $nota }}</strong></td>
            </tr>
        </tbody>
    </table>
    @else
    <p>Todo correcto</p>
    <p><strong>Nota Final:</strong> {{ $nota }}</p>
    @endif
    <br>
    <br>
    <div class="text-center mt-4">
        <div class="pt-2">
            <p> ___________________________</p>
        </div>
        <p>{{$auxiliar}}<br>Auxiliar académico</p>
    </div>

</body>
</html>
