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
                Admisión {{$admision->año}}
            </h3>    
            <h5 style="font-size: 0.7rem;">{{Date::parse($admision->fecha_apertura)->locale('es')->isoFormat('D [de] MMMM')}} - {{Date::parse($admision->fecha_cierre)->locale('es')->isoFormat('D [de] MMMM')}}</h5> 
            <h5 style="font-size:0.7rem">reporte generado el {{Date::parse(now())->locale('es')->isoFormat('D [de] MMMM [del] Y')}}</h5>
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
    @foreach ($resultados->groupBy('grado') as $group => $groupResultados)
        @php
            $i = 1
        @endphp
        <div style="text-align: center">
            <strong>Postulantes a @switch($group)
                @case(1)
                    {{"1er"}}
                    @break
                @case(2)
                    {{"2do"}}
                    @break
                @case(3)
                    {{"3er"}}
                    @break
                @case(4)
                    {{"4to"}}
                    @break
                @case(5)
                    {{"5to"}}
                    @break      
            @endswitch grado de secundaria</strong>
        </div>
        
        <table style="margin-top: 2px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Aula</th>
                    <th>Resultado</th>
                </tr>
            </thead>
       
            <tbody>
            @foreach ($groupResultados as $resultado)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$resultado->postulante->dni}}</td>
                    <td>{{$resultado->postulante->nombre_apellidos}}</td>
                    <td>{{$resultado->postulante->aula->grado." ".$resultado->postulante->aula->seccion}}</td>
                    <td class="
                        @if ($resultado->resultado == "Rechazado") text-danger @else text-success @endif">
                        {{$resultado->resultado}}
                    </td>
                </tr>
            @endforeach       
            </tbody>
        </table>
    @endforeach
        
    
    </main>
</body>
</html>
