<title> FAC {{$venta->num_comprobante}} </title>
<body background="{{asset('imagen/07.png')}}" style="background-repeat:no-repeat; background-size: 50%;">
    <br><br><br><br><br>  {{-- <br><br><br> --}}
    <table border="0" width="69%"  style="font-size:14px; border-collapse: 0; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif;" >
        <tbody>
            <tr>
                <td style="height:3px; " colspan="6"></td>
            </tr>
            <tr >
                <td style="height:20px; vertical-align:bottom;  padding: 0px 0px -5px 0px;" colspan="6" align="right">
                    {{$newDate = date("d", strtotime($venta->fecha_hora))}}&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$newDate2 = date("m", strtotime($venta->fecha_hora))}}&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$newDate3 = date("Y", strtotime($venta->fecha_hora))}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr >
                <td colspan="1" width="13%" style="height:20px;"  align="right"> </td>
                <td colspan="5" style="height:20px; vertical-align:bottom;"> &nbsp;&nbsp;&nbsp;&nbsp; {{strtoupper($venta->nombre)}} </td>

            </tr>
            <tr>
                <td colspan="1" style="height:20px;" align="right"> </td>
                <td colspan="5" style="height:40px;"> &nbsp;&nbsp;&nbsp;&nbsp; {{$venta->direccion_cliente}} &nbsp; {{$venta->municipio}}
                   {{--  @if ($venta->municipio == "San Salvador")
                        S.S.
                    @else
                    {{$venta->municipio}} {{$venta->departamento}}
                    @endif --}}
                    </td>
            </tr>
            <tr >
                <td colspan="1" width="13%" style="height:20px;"  align="right"> </td>
                <td colspan="5" style="height:20px;"> &nbsp;&nbsp;&nbsp;&nbsp; {{strtoupper($venta->nit)}} </td>

            </tr>
            {{-- <tr>
                <td colspan="2" style="height:20px;" align="right"> </td>
                <td colspan="2" style="height:20px;"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td colspan="2" style="height:20px;" align="right">&nbsp;&nbsp;&nbsp;&nbsp; </td>
            </tr> --}}
            <tr >
                <td colspan="1" width="13%" style="height:20px;"  align="right"> </td>
                <td colspan="5" style="height:20px;"> &nbsp;&nbsp;&nbsp;&nbsp; {{$venta->departamento}} </td>

            </tr>
            {{-- <tr>
                <td colspan="6" style="height:20px;"></td>
            </tr> --}}
            <tr>
                <td colspan="6" style="height:20px;"> </td>
            </tr>
        </table>
        <br><br>
        <table border="0" width="69%" style="font-size:14px; height:240px; border-collapse: 0; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif;" >
            @php $sumas=0; $i=0; $iva=0; $c = 0;  $dsc = 0; $st = 0 ;   @endphp  {{--dts = destalle sin cesc--}} 
            @foreach($detalles as $det)
            <tr valign="top">
                <td colspan="1"  align="center"> &nbsp;&nbsp;&nbsp;{{$det->cantidad}} <br></td>
                <td colspan="3" width="50%">
                    @if ($det->sobrenombre != null)
                        {{$det->sobrenombre}} <br>
                    @else
                        {{$det->articulo}}    {{($det->descripciondv != null) ? $det->descripciondv : $det->nombreModelo ." ".  $det->nombreMarca}} {{($det->impuestodos == 1 ? "*" : " ")}} 
                        {{$det->serie}}  {{$det->garantia}}<br>
                    @endif
                </td>
                
                @php 
                    if($det->impuestodos == 1) {
                        $c+= (($det->precio_venta * $det->cantidad)/1.18) * 0.05;
                        $dts = (($det->precio_venta/ 1.18 )  * 0.13) + ($det->precio_venta/ 1.18) ; 
                    } else {
                        $c+= 0;
                        $dts = $det->precio_venta; 
                    }
                    
                   $st +=  $det->cantidad*$dts; 
                  
                @endphp
            <td colspan="1"  width="20%" align="right">{{number_format($dts,2)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></td> 
            <td colspan="1"  width="17%" align="right">{{number_format($det->cantidad*$dts,2)}}&nbsp;&nbsp;&nbsp;&nbsp;<br> </td>
            </tr>
            @endforeach
            
            <tr valign="bottom">
                <td colspan="1"  align="center"></td>
                <td colspan="3" width="50%"> Visitanos en mtech-sv.com</td>
                <td colspan="1"  width="20%" align="right"></td>
                <td colspan="1"  width="17%" align="right"></td>
            </tr>      
        </table>
        <table border="0" cellspacing="0" width="69%" style="font-size:14px; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif;">
            <tbody>
            <tr>
                <td colspan="1" ></td>
                <td colspan="3" rowspan="3" style="height:20px;">
                    {{NumeroALetras::convertir(number_format($st+ $c, 2), 'DOLARES', 'CENTAVOS')}}
                </td>
                <td colspan="1" ></td>
                <td colspan="1" style="height:20px;" align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>

            </tr>
            <tr>
                <td colspan="1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                <td colspan="1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1" style="height:20px;" align="right"> {{number_format(($st),2)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="1" style="height:20px;" align="right"></td>
                <td colspan="1" ></td>
                <td colspan="1" ></td>
            </tr>
            @if ($c > 0)
            <tr>
                <td colspan="5" style="height:20px;" align="right">cesc </td>
                <td colspan="1" align="right">{{number_format(($c),2)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            @else
            <tr>
                <td colspan="5" style="height:20px;" align="right"> </td>
                <td colspan="1" align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            @endif
            
            <tr>
                <td colspan="6" style="height:20px;" align="center"> </td>
            </tr>
            <tr>
                <td colspan="6" style="height:25px;"> </td>
            </tr>
            <tr>
                <td colspan="5" style="height:20px;"></td>
                <td colspan="1" style="height:20px;"align="right" >{{number_format(($st+ $c),2)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </tbody>
    </table>
    </div>
    </table>
</body>
