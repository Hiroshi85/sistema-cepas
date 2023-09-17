<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <title>{{ $postulacion->candidato->nombre }}</title>
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
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <header style="border-bottom: 1px solid black">
        <img style="width: 100px; height: 100px; margin: auto"
            src="https://scontent.ftru7-1.fna.fbcdn.net/v/t39.30808-6/362288740_800848801856233_7443396535582840428_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=QHSp2ULputUAX-rpFCe&_nc_ht=scontent.ftru7-1.fna&oh=00_AfBCuHkEoG4WxGZ-7TYZ3jhCBJwnRO2qMtrbZxFqFs5QqA&oe=650C60B1"
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

        <div class="row">
            <div class="col-12 mb-3">
                <strong>Postulación #:</strong>
                <span>{{ $postulacion->id }}</span>
            </div>
        </div>
        <h4>Información del Candidato</h4>
        <table class="table table-condensed">
            <tbody>

                <tr>
                    <td>
                        <h6>
                            <strong>Nombre del postulante</strong>
                        </h6>
                    </td>
                    <td>
                        <span>{{ $postulacion->candidato->nombre }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>DNI</strong>
                        </h6>
                    </td>
                    <td>
                        <span>{{ $postulacion->candidato->dni }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Email</strong>
                        </h6>
                    </td>
                    <td>
                        <span>{{ $postulacion->candidato->email }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Teléfono</strong>
                        </h6>
                    </td>
                    <td>

                        <span>{{ $postulacion->candidato->telefono ? $postulacion->candidato->telefono : 'No especificado' }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr />
        <h4>Información de Postulación</h4>

        <table class="table table-condensed">
            <tbody>
                <tr>
                    <td>
                        <h6>
                            <strong>Puesto aplicado</strong>
                        </h6>
                    </td>
                    <td>
                        <span>{{ $postulacion->plaza->puesto->nombre }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Fecha de postulación</strong>
                        </h6>
                    </td>
                    <td>
                        <span>
                            {{ $postulacion->fecha_postulacion }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Estado</strong>
                        </h6>

                    </td>
                    <td>
                        <span style="text-transform: capitalize">
                            {{ $postulacion->estado }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
