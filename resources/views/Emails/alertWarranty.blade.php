<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
</head>
<body style="font-family: Barlow;font-weight: bold;">

    <table style="max-width:600px;margin: auto;border-spacing: 0px;">
        <tr>
            <td style="background-image:url('{{ asset('images/mail/tramitador.jpg')}}');width:600px;height: 923px;">
              
            </td>
        </tr>
        <tr>
            <td  style="background-image:url('{{ asset('images/mail/blueTramitador.jpg')}}');height: 234px;padding: 0px 47px;font-size: 30px;color:white">
                <p aling="justify" style="margin:0">Un cliente ha solicitado servicio de garantía y esta esperando tu llamada, recuerda que lo debes contactar telefónicamente el día de hoy, a mas tardar mañana en la mañana.</p>
            </td>
        </tr>
    </table>
    <table style="max-width:600px;margin: auto;border-spacing: 0px;">
        <tr  style="background-image:url('{{ asset('images/mail/bgTramitador.jpg')}}');width: 600px;height: 436px;">
            <td  style="width: 300px;color:white;font-size:20px">
                <table style="margin-left: 50px;margin-top: -140px;color:#001372">
                    <tr style="height:50px">
                        <td>CASO:</td>
                    </tr>
                    <tr style="height:50px">
                        <td>NOMBRE DEL TITULAR:</td>
                    </tr>
                    <tr style="height:50px">
                        <td>CÉDULA:</td>
                    </tr>
                    <tr style="height:50px">
                        <td>NOMBRE USUARIO:</td>
                    </tr>
                    <tr style="height:50px">
                        <td>MEDIO DE COMPRA:</td>
                    </tr>
                </table>
            </td >
            <td  style="width: 300px;color:white;font-size:20px">
                <table style="margin-top: -140px;color:#001372">
                    <tr style="height:50px">
                        <td>{!! $caso !!}</td>
                    </tr>
                    <tr style="height:50px">
                        <td>{!! $clientNames." ".$clientLastNames !!}</td>
                    </tr>
                    <tr style="height:50px">
                        <td>{!! $identificationNumber !!}</td>
                    </tr>
                    <tr style="height:50px">
                        <td>{!! $userName !!}</td>
                    </tr>
                    <tr style="height:50px">
                        <td><br>{!! $shop !!}</td>
                    </tr>
                </table>
            </td >
        </tr>
    </table>
    
</body>
</html>
