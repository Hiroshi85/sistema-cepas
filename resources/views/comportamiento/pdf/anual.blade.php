<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Año 2023 de Comportamientos</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
    body {
        font-family: 'Helvetica' !important;
        font-size: 12 !important;
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
            <p class="h4"><strong>Reporte Año 2023 de Comportamientos</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p><strong>Alumno:</strong> {{ $alumno->nombre_apellidos }}</p>
            <div>
                <p><strong>Grado:</strong> {{ $alumno->aula->grado.$alumno->aula->seccion }}
                    <span class="mx-10 w-10"></span>
            </div>
        </div>
    </div>
    @foreach ($comportamientosAnual as $bimestre)
        @if(count($bimestre['resultados'])!=0)
            <p class="h6"><strong>Bimestre {{$bimestre['resultados'][0]->bimestre}} </strong></p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha y hora</th>
                        <th>Comportamiento</th>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bimestre['resultados'] as $comportamiento)
                        <tr>
                            <td>{{ $comportamiento->fecha}}</td>
                            <td>{{ $comportamiento->nombre }}</td>
                            <td>{{ $comportamiento->puntaje }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td><strong>Nota Final</strong></td>
                        <td class="@if ($bimestre['nota'] < 14)
                            text-danger
                        @endif"><strong>{{ $bimestre['nota'] }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @else
        <p>Todo correcto</p>
        <p><strong>Nota Final:</strong> {{$bimestre['nota']}}</p>
        @endif
    @endforeach

    <br>
    <br>
    <div class="text-center mt-4">
        <div class="pt-2">
            <p> ____________________________ </p>
        </div>
        <p>{{$auxiliar}}<br>Auxiliar académico</p>
    </div>

</body>
</html>
