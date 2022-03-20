<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table width="500" border="0" {{--  cellspacing="0" cellpadding="0" --}}
        style="background: #006685; border-radius: 10px; padding: 5px; color: white; font-size: 17px;" height="500" align="center" >
        <tr>
            <td align="center">
                <p style="font-size: 44px;"  ><strong> ¡BIENVENIDO A <br>MTECH! </strong></p>
                Hola {{$persona->nombre}}
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 14px;">
                 Debes de confirmar tu cuenta, dando click en el siguiente botón 
                <p align="center"> <a href="{{ url('/register/verify/' . $persona->confirmation_code) }}"><button type="button" style="background-color: #28A745; color: #FFFFFF; border-color: #1e7e34; padding: 6px 12px; font-size: 16px; border-radius: 5px;"
                    align="center">Confirmar mi cuenta</button></a> </p>
                
            </td>
        </tr>
        <tr>
            <td style="color: white; font-size: 17px;" align="center">
                        
            </td>
        </tr>

    </table>
</body>
</html>

<script src="{{asset('js/sweetalert.min.js')}}"></script>

