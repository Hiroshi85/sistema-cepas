<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ $postulacion->candidato->nombre }}</title>
    <style>
        @page {
            size: A4;
            margin-top: 20px;
            margin-bottom: 80px;
            /* footer height */

            @bottom-right {
                content: counter(page) " of " counter(pages);
            }
        }

        header {
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid relative">
        <header class="row">
            <div class="col-12">
                <img style="width: 100px; height: 100px;"
                    src="https://lh3.googleusercontent.com/QLevw9whLm4pnDLixgA_JpdI6uEcbEFhFpwF-JR4DNq03jBWwVVh7mDSODBpKlEVAOIDteQrxCQCEMgrNLNvncI=w16383"
                    alt="CEPAS ESCUDO">
            </div>
            <div class="col-12">
                <h2 style="text-transform: uppercase;font-size: 1.2rem">Institución Educativa Privada CEPAS</h2>
            </div>
            <div class="col-12">
                <h3 style="text-transform: uppercase;font-size: 1rem">
                    Area de Recursos Humanos
                </h3>
            </div>
        </header>
        <hr style="border: 0.5px solid black">
        <div class="row">
            <div class="col-12 mb-3">
                <strong>Postulación #:</strong>
                <span>{{ $postulacion->id }}</span>
            </div>
        </div>
        <h4>Información del Candidato</h4>
        <table class="table table-bordered table-condensed">
            <tbody>

                <tr>
                    <td>
                        <h6>
                            <strong>Nombre del postulante</strong>
                        </h6>
                        <span>{{ $postulacion->candidato->nombre }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>DNI</strong>
                        </h6>
                        <span>{{ $postulacion->candidato->dni }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Email</strong>
                        </h6>
                        <span>{{ $postulacion->candidato->email }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Teléfono</strong>
                        </h6>
                        <span>{{ $postulacion->candidato->telefono ? $postulacion->candidato->telefono : 'No especificado' }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr />
        <h4>Información de Postulación</h4>

        <table class="table table-bordered table-condensed">
            <tbody>
                <tr>
                    <td>
                        <h6>
                            <strong>Puesto aplicado</strong>
                        </h6>
                        <span>{{ $postulacion->plaza->puesto->nombre }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Fecha de postulación</strong>
                        </h6>
                        <span>
                            {{ $postulacion->fecha_postulacion>format('d/m/Y') }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            <strong>Estado</strong>
                        </h6>
                        <span style="text-transform: capitalize">
                            {{ $postulacion->estado }}
                        </span>

                    </td>
                </tr>
            </tbody>
        </table>
        <hr />
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
    </div>
</body>
