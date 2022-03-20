<title> VEN_COT {{$venta->num_comprobante}} </title>
<body background="{{asset('imagene/05.png')}}" style="background-repeat:no-repeat; background-size: 50%;">
    <br><br><br><br> {{-- quitar 3 <br><br><br> br y la imagen --}}
    <table border="0" cellspacing="0" width="69%" style="font-size:14px; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif;">
        <tbody>
            <tr>
                <td style="height:15px; " colspan="6"></td>
            </tr>
            <tr>
                <td style="height:20px; " colspan="6" align="right">
                    {{$newDate = date("d", strtotime($venta->fecha_hora))}}&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$newDate2 = date("m", strtotime($venta->fecha_hora))}}&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {{$newDate3 = date("Y", strtotime($venta->fecha_hora))}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="1" width="13%" style="height:20px;" align="right"> </td>
                <td colspan="5" style="height:20px;"> &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;{{$venta->nombre}} </td>

            </tr>
            <tr>
                <td colspan="1" style="height:20px;" align="right"> </td>
                <td colspan="5" style="height:20px;"> &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;{{$venta->direccion_cliente}} {{$venta->municipio}}</td>
            </tr>
            <tr>
                <td colspan="2" style="height:20px;" align="center"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;{{$venta->departamento}}</td>
                <td colspan="2" style="height:20px;"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;{{$venta->iva}} </td>
                <td colspan="2" style="height:20px;" align="right">{{$venta->nit}}&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" style="height:20px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$venta->giro}}</td>

            <tr>
                <td colspan="6" style="height:90px;"></td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="69%" style="font-size:14px; height:235px; border-collapse: 0; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif;" >
        @php $sumas=0;  @endphp
        @foreach($detalles as $det)  
        <tr valign="top">
            <td colspan="1" width="15%"  align="center"> &nbsp;&nbsp;&nbsp; {{$det->cantidad}} <br></td>
            <td colspan="3" width="50%"> {{$det->articulo}}      {{($det->descripciondv != null) ? $det->descripciondv : $det->nombreModelo ." ".  $det->nombreMarca}}
                {{$det->serie}}  {{$det->garantia}}<br></td>
            <td  width="11%" align="right" >{{number_format($det->precio_venta/1.13,2)}}&nbsp;&nbsp;<br></td>
            <td colspan="1" width="9%" align="right"></td>
            <td colspan="1" width="19%" align="right">{{number_format($det->cantidad*$det->precio_venta/1.13,2)}}&nbsp;&nbsp;&nbsp;<br></td>
            
            @php $sumas += $det->cantidad*$det->precio_venta/1.13 @endphp
        </tr>
        @endforeach
    </table>
    <table border="0" cellspacing="0" width="69%" style="font-size:14px; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif;">
        <tbody>
            <tr>
                <td colspan="1" width="10%"></td>
                <td colspan="3" rowspan="3" style="height:20px;">
                    {{NumeroALetras::convertir(number_format(($sumas*$varios->iva)+$sumas, 2),'DOLARES', 'CENTAVOS')}}
                </td>
                <td colspan="1"></td>
                <td colspan="1" style="height:20px;" align="right">{{number_format($sumas,2)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1" style="height:20px;" align="right"> @php $iva = $sumas * $varios->iva; @endphp
                    {{number_format(($iva),2)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="1" style="height:20px;" align="right"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
            </tr>
            <tr>
                <td colspan="6" style="height:35px;"> </td>
            </tr>
            <tr>
                <td colspan="6" style="height:20px;" align="center"> </td>
            </tr>
            <tr>
                <td colspan="6" style="height:20px;"> </td>
            </tr>
            <tr>
                <td colspan="5" style="height:20px;"></td>
                <td colspan="1" style="height:20px;" align="right">
                    {{number_format(($sumas*$varios->iva)+$sumas, 2)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </tbody>
    </table>
</body>
{{--98--}}