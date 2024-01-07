@php
    use Carbon\Carbon;
    date_default_timezone_set('America/Lima');

    function formatDateInSpanish($date)
    {
        $date = Carbon::parse($date);
        $mes = $date->format('F');
        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Setiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];
        return $date->format('d') . ' de ' . $meses[$mes] . ' del ' . $date->format('Y');
    }

@endphp
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <title>{{ $oferta->postulacion->candidato->nombre }} - Firmar Contrato</title>
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
            text-align: center;
            line-height: 35px;
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
        }

        main {
            margin-top: 100px;
            margin-bottom: 80px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <header style="border-bottom: 1px solid black; margin-bottom: 12px">
        <img style="width: 100px; height: 100px; margin: auto" src="{{ public_path('assets/cepas_escudo.png') }}"
            alt="CEPAS ESCUDO">
        <h2 style="text-transform: uppercase;font-size: 1.2rem">Institución Educativa Privada CEPAS</h2>
        <h3 style="text-transform: uppercase;font-size: 1rem">
            Area de Recursos Humanos
        </h3>
    </header>
    <footer>
        <table style="width: 100%;font-size: 0.8rem;border-top: 1px solid black;border-collapse: collapse">
            <tbody>
                <tr>
                    <td style="font-size: 0.8rem;">
                        Av. Víctor Raúl Haya de la Torre Nro. 158 V Etapa - Urb. San Andrés
                    </td>
                    <td style="font-size: 0.8rem;text-align: right">
                        <a href="https://rrhh.edu.pe" target="_blank">
                            rrhh.edu.pe
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0.8rem;">
                        Trujillo - Perú
                    </td>
                    <td style="font-size: 0.8rem;text-align: right">
                        rrhh@cepas.edu.pe
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
    <main class="container-fluid">
        <h6
            style="text-align: center;text-transform: uppercase;font-size: 1.2rem;font-weight: bold; margin-bottom: 0px;text-decoration: underline">
            CONTRATO DE TRABAJO A PLAZO FIJO BAJO LA MODALIDAD DE CONTRATO DE TEMPORADA</h6>

        <p>
            Conste por el presente documento el Contrato de Trabajo a plazo fijo bajo la modalidad de “Contrato de
            Temporada”, que celebran al amparo del Art. 67º de la Ley de Productividad y Competitividad Laboral aprobado
            por D. S. Nº 003-97-TR, y normas complementarias, de una parte INSTITUCIÓN EDUACTIVA PRIVADA CEPAS, con
            R.U.C. Nº 20560136791 y domicilio
            fiscal en, debidamente representada por el señor YVÁN FRANK SALINAS FLORES, con D.N.I. Nº 07167812, según
            poder inscrito en
            la partida registral No 11246205 del Registro de Personas Jurídicas de Lima, a quien en adelante se le
            denominará simplemente <b>EL EMPLEADOR</b>; y de la otra parte
            {{ $oferta->postulacion->candidato->nombre }}, con D.N.I. Nº {{ $oferta->postulacion->candidato->dni }},
            domiciliado en
            {{ $oferta->postulacion->candidato->direccion }}, a quien en adelante se le denominará simplemente <b>EL
                TRABAJADOR</b>; en los términos y condiciones
            siguientes:
        </p>
        <p>
            <b>PRIMERO:</b> EL EMPLEADOR es una empresa dedicada a Enseñanza Secundaria la cual requiere cubrir las
            necesidades
            de recursos humanos con el objeto de incrementar las actividades educativas, debido al aumento de la demanda durante el año escolar {{ Carbon::parse($oferta->contrato_fecha_inicio)->format('Y') }}.
        <p>
            <b>SEGUNDO:</b> Por el presente documento EL
            EMPLEADOR contrata a plazo fijo bajo la modalidad ya indicada en la cláusula precedente, los servicios de EL
            TRABAJADOR quien desempeñará el cargo de {{ $oferta->postulacion->plaza->puesto->nombre }}, en relación con
            el objeto precisado en la cláusula
            primera.
        </p>
        <p>
            <b>TERCERO:</b> El presente contrato tiene una duración de {{ $oferta->meses_contrato }} Meses,
            cuyo inicio será el
            {{ formatDateInSpanish($oferta->contrato_fecha_inicio) }}
            y concluye el
            {{ formatDateInSpanish(Carbon::parse($oferta->contrato_fecha_inicio)->addMonths($oferta->meses_contrato)) }}.
        </p>

    </main>
    <main>

        <p style="margin-top: 100px">
            <b>CUARTO:</b> EL TRABAJADOR estará
            sujeto a un período de prueba de tres meses, la misma que inicia el
            {{ formatDateInSpanish($oferta->contrato_fecha_inicio) }}
            y termina el
            {{ formatDateInSpanish(Carbon::parse($oferta->contrato_fecha_inicio)->addMonths(3)) }}.
        </p>
        <p>
            <b>QUINT0</b>: EL TRABAJADOR cumplirá el horario de trabajo siguiente: De lunes viernes de
            7am a 1pm y de 2pm a 5pm
        </p>
        <p>
            <b>SEXTO:</b> EL TRABAJADOR deberá cumplir con las normas propias del Centro de Trabajo, así
            como las contenidas en el Reglamento Interno de Trabajo y en las demás normas laborales, y las que se
            impartan por necesidades del servicio en ejercicio de las
            facultades de administración de la empresa, de conformidad con el Art. 9º de la Ley de Productividad y
            Competitividad Laboral aprobado por D. S. Nº 003-97-TR.
        </p>
        <p>
            <b>SETIMO:</b> EL EMPLEADOR abonara al TRABAJADOR la
            cantidad de S/{{ $oferta->salario }} como remuneración mensual, de la cual se deducirán las aportaciones y
            descuentos por
            tributos establecidos en la ley que le resulten aplicables.
        </p>
        <p>
            <b>OCTAVO:</b> Este contrato queda sujeto a las
            disposiciones que contiene el TUO del D. Leg. Nº 728 aprobado por D. S. Nº 003-97-TR Ley de Productividad y
            Competitividad Laboral, y demás normas legales que lo regulen) o que sean dictadas durante la vigencia del
            contrato. Conforme con todas las cláusulas anteriores, firman las partes, por triplicado a los
            {{ formatDateInSpanish(null) }}.
        </p>

        {{-- la parte de las firmas y los nombres, pero en formato tabla, display flex no funciona en pdf --}}
        <table style="width: 100%;font-size: 0.8rem;border-collapse: collapse; margin-top: 60px">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <p style="text-align: center">
                            _____________________________
                        </p>
                        <p style="text-align: center">
                            <b>YVÁN FRANK SALINAS FLORES</b>
                            <br/>
                            <b>DNI Nº 07167812</b>
                        </p>
                    </td>
                    <td style="width: 50%;">
                        <p style="text-align: center">
                            _____________________________
                        </p>
                        <p style="text-align: center">
                            <b>{{ $oferta->postulacion->candidato->nombre }}</b>
                            <br/>
                            <b>DNI Nº {{ $oferta->postulacion->candidato->dni }}</b>
                        </p>
                    </td>
                </tr>
            </tbody>
        

    </main>
</body>
