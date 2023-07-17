<!DOCTYPE html>
<html>

<head>
    <title>Reporte de notas</title>
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
                <th colspan="6">Reporte de Notas - Año Academico 2023 - I.E CEPAS</th>
            </tr>
            <tr>
                <th rowspan="3" colspan="2"><img src="images/logocepas.png" height="100px" alt="Logo cepas"></th>
                <th colspan="4">ALUMNO: {{$al->nombre}}</th>
            </tr>
            <tr>
                <th colspan="2">DNI: {{$al->dni}}</th>
                <th colspan="2">EDAD: {{$al->edad}}</th>
            </tr>
            <tr>
                <th colspan="2">GRADO: {{$al->aula->grado}}</th>
                <th colspan="2">SECCION: {{$al->aula->seccion}}</th>
            </tr>
            <tr>
                <th colspan="6">MIS CURSOS</th>
            </tr>
            <tr>
                <th>CURSO</th>
                <th>BIMESTRE I</th>
                <th>BIMESTRE II</th>
                <th>BIMESTRE III</th>
                <th>BIMESTRE IV</th>
                <th>PROMEDIO FINAL</th>
            </tr>
        </thead>
        <tbody>
          @foreach($calificaciones as $cs)
            <tr>
                <td>{{$cs->cursoasignado->curso->nombre}}</td>
                <td>{{$cs->b1}}</td>
                <td>{{$cs->b2}}</td>
                <td>{{$cs->b3}}</td>
                <td>{{$cs->b4}}</td>
                <td>{{$cs->prom}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
</body>

</html>
