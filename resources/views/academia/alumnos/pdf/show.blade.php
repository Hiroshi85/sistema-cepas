<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Año 2023 de Comportamientos</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
</head>
<style>
     @page {
            size: A4;
            margin-top: 120px;
            margin-bottom: 80px;

        }

        * {
            font-family: 'Roboto Condensed', sans-serif !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        strong {
            font-family: 'Roboto Condensed', sans-serif !important;
            font-weight: bold !important;
        }

        header {
            line-height: 35px;
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            border-bottom: 1px solid black;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
        }

        main {
            margin-bottom: 100px;
        }

        .page-break {
            page-break-after: always;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 2px;
        }
        
</style>
<body class="container my-4">
    <header>
        <div >
            <img style="width: 50px; height: 50px;"
            src="assets/cepas_escudo.png"
            alt="CEPAS ESCUDO">
            <h2 style="text-transform: uppercase;font-size: 0.7rem">Institución Educativa Privada CEPAS</h2>
        </div>
        <div style="position:absolute; right:0; top:2; text-align: right">
             <h3 style="text-transform: uppercase;font-size: 0.8rem">
                lista de estudiantes
            </h3>     
            <span style="font-size:0.7rem">Generada el {{Date::parse(now())->locale('es')->isoFormat('D [de] MMMM [del] Y')}}</span>
        </div>
    </header>
    <footer>
        <table style="width: 100%;font-size: 0.8rem;border-top: 1px solid black;border-collapse: collapse">
            <tbody>
                <tr>
                    <td style="font-size: 0.8rem;">
                        Av. Víctor Raúl Haya de la Torre Nro. 158 V Etapa - Urb. San Andrés
                    </td>
                    <td style="font-size: 0.8rem;text-align: right">
                        <a href="http://127.0.0.1:8000/admision-matriculas" target="_blank">
                            Admisión y matrículas
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0.8rem;">
                        Trujillo - Perú
                    </td>
                    <td style="font-size: 0.8rem;text-align: right">
                        <a href="https://www.cepas.edu.pe/" target="_blank">
                            cepas.edu.pe
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0.8rem;">

                        44-732464
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>
    <main>
        <h3 style="text-transform: uppercase;font-size: 1rem">
            Lista de estudiantes del ciclo académico {{$ciclo->nombre}}
        </h3>   
    <table style="width: 100%">
        <tr>
            <td style="font-size: 0.8rem; text-align: left">
                <strong>Fecha de inicio y fin:</strong> {{Date::parse($ciclo->fecha_inicio)->locale('es')->isoFormat('D [de] MMMM')}} - {{Date::parse($ciclo->fecha_fin)->locale('es')->isoFormat('D [de] MMMM [del año] Y')}}
            </td>
            <td style="font-size: 0.8rem; text-align: right">
                @php
                    $startDate = \Carbon\Carbon::parse($ciclo->fecha_inicio);
                    $endDate = \Carbon\Carbon::parse($ciclo->fecha_fin);
                    $differenceInMonths = $startDate->diffInMonths($endDate);
                @endphp
                <strong>Duración:</strong> {{$differenceInMonths}} meses
            </td>
        </tr>
    </table>
        @php
            $i = 1
        @endphp
        {{-- <h2 style="text-align: center; font-size: 1.5rem">Lista de estudiantes</h2> --}}
        <table style="margin-top: 2px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>DNI</th>
                    <th>Celular</th>
                </tr>
            </thead>
       
            <tbody>
            @foreach ($alumnos as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->alumno->nombre_apellidos}}</td>
                    <td>{{ucfirst($item->carrera->nombre)}}</td>
                    <td>{{$item->alumno->dni}}</td>
                    <td>{{$item->alumno->numero_celular}}</td>
                </tr>
            @endforeach       
            </tbody>
        </table>    
    </main>
</body>
</html>
