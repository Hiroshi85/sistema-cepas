<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acta de notificacion de sanción</title>
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

    <div class="row mb-4 text-center">
        <div class="col-12">
            <img src="assets/cepas_escudo.png" width="100">
        </div>
        <div class="col-12">
            <p class="h4"><strong>Acta de comportamiento #{{$comportamiento->id}}</strong></p>
        </div>
    </div>

    <div class="p-2">
        <div class="p-2">
            <strong>Identificación del estudiante</strong>
            <ul>
                <li>Nombres y apellidos: {{$comportamiento->alumno->nombre_apellidos}}</li>
                <li>Aula: {{$comportamiento->alumno->aula->grado.$comportamiento->alumno->aula->seccion}}</li>
                <li>Código de estudiante: {{$comportamiento->alumno->idalumno}}</li>
            </ul>
            <p>
                Estimado(s) apoderado(s): <br>Siendo el día {{$hoy->dayName}}, {{$hoy->format('d')}} de {{$hoy->monthName}} del {{$hoy->format('Y')}}, informamos que el estudiante cometió la infracción "{{$comportamiento->conducta->nombre}}".
            </p>
            <p>
                Por ello, desde Dirección de Escuela, se decicidió sancionar al estudiante con
                <strong>"{{$comportamiento->sancion->nombre}}"</strong> .
            </p>
            <p>
                @switch($comportamiento->sancion->id)
                    @case(2)
                        Se exhorta a los apoderados a cubrir los gastos de los perjuicios materiales causados por el estudiante.
                        @break
                    @case(3)@case(4)@case(5)
                        Teniendo en cuenta la gravedad de la infracción, toda evaluación que se realice durante el periodo de expulsión
                        se calificará con la nota mínima (0).
                        @break
                    @case(6)
                        El retiro permanente de la institución sin opción de reingreso en la institución Cepas se realizará
                        en un plazo de 5 días a partir de la notificación de la presente acta.
                        @break
                    @default
                        Se exhota a los apoderados a tomar las medidas correctivas necesarias para evitar reincidencias en este tipo de comportamientos.
                @endswitch
            </p>
            <p>
                Para cualquier consulta o acuerdo con la institución, así como reclamo ante un posible malentendido, por favor
                comunicarlo en la oficina de dirección o del auxiliar {{$nombreResponsable}}.
            </p>
            @if($comportamiento->observacion)
                <p>
                    Observaciones: {{$comportamiento->observacion}}
                </p>
            @endif
        </div>
    </div>

    <br>

    <table style="width: 100%">
        <tbody>
            <tr>
                <td class="text-center">
                    ___________________________
                </td>
                <td class="text-center">
                    ___________________________
                </td>
            </tr>
            <tr>
                <td><p class="text-center">Firma de apoderado</p></td>
                <td>
                    <p class="text-center">Firma de representante de colegio <br> {{$nombreResponsable}}</p>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
