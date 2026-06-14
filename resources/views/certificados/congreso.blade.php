<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Asistencia</title>

    <style>

        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Georgia, serif;
            margin: 40px;
            font-size: 1.05em;
            line-height: 1.6;
            color: #222;
        }

        .membrete {
            text-align: center;
            margin-bottom: 30px;
        }

        .membrete img {
            width: 100%;
            max-width: 800px;
        }

.contenido {
    max-width: 1050px;
    margin: 30px auto 0 auto;
}

        .firma {
            margin-top: 60px;
            text-align: center;
        }

        .firma img {
            width: 600px;
            max-width: 100%;
        }

        p {
            margin-bottom: 20px;
        }

       .membrete {
    text-align: center;
    margin-bottom: 40px;
}

.titulo-congreso {
    font-size: 2.8rem;
    font-weight: bold;
    vertical-align: middle;
    margin-right: 10px;
}

.logo-sa {
    width: 180px;
    height: auto;
    vertical-align: middle;
    margin-left: 10px;
}

.header-certificado {
    width: 100%;
    max-width: 900px;
    height: auto;
}

.certificado {
    max-width: 1200px;
    margin: 20px auto;
    padding: 40px 60px;
    border: 1px solid #000;
    background: white;
}

    </style>
</head>

<body>

  <body>

<div class="certificado">

  <div class="membrete">
    <img
        src="{{ asset('imgs/banner-congreso-certificados.jpg') }}"
        class="header-certificado">
</div>


    <div class="contenido">

        <p>
            Se certifica que
            <strong>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </strong>

            DNI
            <strong>{{ $usuario->DNI }}</strong>

            participó del Congreso Secundaria Aprende,
            realizado el día
            <strong>
                {{ \Carbon\Carbon::parse($evento->fecha_congreso)->format('d-m-Y') }}
            </strong>

            en la Universidad de la Ciudad,
            sita en Tte. Gral. Juan Domingo Perón 802,
            en calidad de
            <strong>
                {{ strtoupper(str_replace('_', ' ', $usuario->rol)) }}
            </strong>.
        </p>

        @if(isset($tipo) && $tipo == 'expositor')

            <p>
                Participó como expositor en la mesa:

                <strong>
                    {{ $temaMesa }}
                </strong>.
            </p>

        @endif

        @if(isset($tipo) && $tipo == 'tallerista')

            <p>
                Tuvo a cargo el taller:

                <strong>
                    {{ $tituloTaller }}
                </strong>.
            </p>

        @endif

        <p>
            Agradecemos su participación en este espacio de encuentro,
            intercambio y reflexión sobre las prácticas educativas y los
            desafíos de la escuela secundaria.
        </p>

        <p>
            Se extiende el presente certificado para los fines que la
            persona interesada estime corresponder.
        </p>

        <p>
            Ciudad Autónoma de Buenos Aires,
            {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('d \d\e F \d\e Y') }}.
        </p>

    </div>

    <div class="firma">

        <img
            src="{{ asset('imgs/firma_digital.png') }}"
            alt="Firma digital">

    </div>
    </div>

</body>
</html>