<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv='Content-Type' content='text/html; charset=windows-1252' />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
    <style>
        body{
            font-family: Roboto;
            background-color: #f9f9f9;
        }

        div.mail_contenedor {
            background-color: #FFFFFF;
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 10px 20px;
            margin: 0 auto;
        }

        div.mail_contenedor p span {
            color: #ac2943;
        }

        a.boton {
            background-color: #ac2943;
            padding: 10px;
            color: #FFFFFF;
            border-radius: 5px;
            text-decoration: none;
        }

        div.footer {
            color: #959595;
            font-size: 12px;
            margin: 0 auto;
        }

        div.footer p.copy {
            text-align: center;
            font-weight: bold;
        }

        a{
            color: #ac2943;
            text-decoration: none;
        }

        p.center {
            text-align: center;
            padding:15px;
        }
    </style>
</head>
<body>
    <div class="mail_contenedor">
        <p>
            Hola <span>{{$name}}</span>,
        </p>
        <p>te damos la bienvenida a <b>GamersHUB</b>.</p>
        <p>Desde ahora podrás participar en la comunidad hecha por y para
            jugadores, podrás comentar las últimas novedades del mundo de los videojuegos y participar en los foros y
            debates que tenemos preparados para tí además de disfrutar de otros servicios que te están esperando en nuestro portal...</p>
        <p>Antes de continuar deberás confirmar tu dirección
            de correo electrónico pulsando sobre el botón inferior.</p>

        <p class="center"><a href="http://www.gamershub.es/confirmar_email/{{$id}}/{{$token}}" class="boton">Confirmar</a></p>

    </div>
    <div class="footer">
        <p>AVISO LEGAL: Este mensaje se dirige exclusivamente a su destinatario y puede contener información privilegiada o confidencial. Si usted no es el destinatario señalado, le informamos de que cualquier divulgación, copia, distribución o uso de los contenidos está prohibida. Si usted ha recibido este mensaje por error, por favor borre su contenido y comuníquenoslo en la dirección del remitente a la mayor brevedad posible. Gracias.</p>
        <p class="copy">
            © GAMERSHUB 2016. TODOS LOS DERECHOS RESERVADOS. SOBRE GAMERSHUB | <a href="http://www.gamershub.es/contacto">CONTACTO</a> | <a href="http://www.gamershub.es/aviso-legal">AVISO LEGAL</a>
        </p>
    </div>
</body>
</html>