<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <div>
        <p>Hola,</p>
        <p>Un cliente ha solicitado servicio de garantía y está esperando tu llamada, recuerda que lo debes contactar telefónicamente el día de hoy, a más tardar mañana en la mañana.</p>
        <p> <b> CÉDULA: </b> {!! $identificationNumber !!}</p>
        <p> <b> NOMBRE TITULAR: </b> {!! $clientNames." ".$clientLastNames !!}</p>
        <p> <b> NOMBRE USUARIO: </b> {!! $userName !!} </p>
    </div>
</body>
</html>
