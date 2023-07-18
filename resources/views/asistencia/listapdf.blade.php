<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Asistencia</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid black;
        }

        th, td {
            border: 2px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="10">Reporte de Asistencia - Año Academico 2023 - I.E CEPAS</th>
            </tr>
            <tr>
            <th rowspan="3" colspan="1"><img width="100px" src="assets/cepas_escudo.png" alt="Logo Personalizado"></th>
                <th colspan="9">CURSO: {{$c->curso->nombre}}</th>
            </tr>
            <tr>
                <th colspan="4">GRADO: {{$c->aula->grado}}</th>
                <th colspan="5">SECCION: {{$c->aula->seccion}}</th>
            </tr>
            <tr>
                <th colspan="9">NUMERO DE PARTICIPANTES: {{$asistencias->count()}}</th>
            </tr>
            <tr>
                <th width="150px">ALUMNO</th>
                <th width="40px">S1</th>
                <th width="40px">S2</th>
                <th width="40px">S3</th>
                <th width="40px">S4</th>
                <th width="40px">S5</th>
                <th width="40px">S6</th>
                <th width="40px">S7</th>
                <th width="40px">S8</th>
                <th width="40px">%</th>
            </tr>
        </thead>
        <tbody>
          @foreach($asistencias as $as)
            <tr>
                <td>{{$as->alumno->nombre_apellidos}}</td>
                <td>{{$as->s1}}</td>
                <td>{{$as->s2}}</td>
                <td>{{$as->s3}}</td>
                <td>{{$as->s4}}</td>
                <td>{{$as->s5}}</td>
                <td>{{$as->s6}}</td>
                <td>{{$as->s7}}</td>
                <td>{{$as->s8}}</td>
                <td>{{(nroasistencias($as)/8)*100}}%</td>
            </tr>
          @endforeach
        </tbody>
    </table>
    @php
        function nroasistencias($a)
        {
            $contador = 0;

            if($a->s1 == 'A')
                $contador++;
            if($a->s2 == 'A')
                $contador++;
            if($a->s3 == 'A')
                $contador++;
            if($a->s4 == 'A')
                $contador++;
            if($a->s5 == 'A')
                $contador++;
            if($a->s6 == 'A')
                $contador++;
            if($a->s7 == 'A')
                $contador++;
            if($a->s8 == 'A')
                $contador++;
            
            return $contador;
        }
    @endphp
</body>

</html>
