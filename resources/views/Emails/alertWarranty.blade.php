<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>
<body>
    <div>
        <p>Hola,</p>
        <p>Un cliente ha solicitado servicio de garantía y está esperando tu llamada, recuerda que lo debes contactar telefónicamente el día de hoy, a más tardar mañana en la mañana.</p>
        <p> <b> CÉDULA: </b> {!! $identificationNumber !!}</p>
        <p> <b> NOMBRE TITULAR: </b> {!! $clientNames." ".$clientLastNames !!}</p>
        <p> <b> NOMBRE USUARIO: </b> N/a</p>
        <table>
            <tr>
                <th>Factura</th>
                <th>Producto</th>
                <th>Fecha de compra</th>
                <th>Almacén de compra</th>
            </tr>
            <tr>
                <td>{!! $invoiceNumber !!}</td>
                <td>N/a</td>
                <td>{!! $day !!}/{!! $month !!}/{!! $year !!}</td>
                <td>N/a</td>
            </tr>
        </table>

    </div>
</body>
</html>
