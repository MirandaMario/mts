<!DOCTYPE html>
<html lang="en" style="margin: 0px; ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COTIZACION N° {{$venta->numeroComprobante}}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
        @font-face { font-family: 'Roboto', sans-serif; }


        body { font-family: 'Roboto', sans-serif; font-size:12px; }        
  
      
             @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 4cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Estilos extra personales **/
                background-color: white;
                color: white;
                text-align: center;
                line-height: 1.5cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0.5cm; 
                left: 0.5cm; 
                right: 0.5cm;
                height: 1.5cm;

                /** Estilos extra personales **/
                background-color:#8BA4D0;
                color: black;
                text-align: center;
                line-height: 1cm;
            }
    </style>
</head>
<body>
    <header> 
        <div align="left" style="padding: 1em 3px 0px 30px;"><img src="{{asset('imagenes/mt.jpg')}}" alt="texto alternativo" width="200" height="alto" style="padding-top: 8px"></div>
    </header>
    <footer>
        <div align="center"  style="padding: -10px 3px 0px 0px;"> <b> MTECH TIENDA DE INFORMATICA ON LINE </b> 
            <p style="padding: -30px 0px 0px 0px;"> {{config('constantes.pie_pagina_cotizacion') }} <a href="https://mtech-sv.com/" >mtech-sv.com</a>  </p>
        </div> 
    </footer>
<main>
    <div align="right" style="padding: -25px 0px 0px 30px;"><span  style="font-size:14px;">San Salvador, {{fechaCastellano($venta->fecha_hora)}}</span><br><br><b> Cotizacion N° {{$venta->numeroComprobante}}</b> 
    </div>
    <div align="left"  style="padding: 0px 3px 0px 0px;">Señores<br>
        <p style="padding: -10px 0px 0px 0px;"><b>{{$venta->nombre}}</b></p>
        <p style="padding: -10px 0px 0px 0px;">Presente.</p>
    </div>
    <br>
    <p>{!!$venta->descripcion!!} </p>

    <br><br><br>
    @php    $dt = 0 ;   @endphp
    @foreach($detalles as $det)
    @php    $dt += $det->descuento;  @endphp
    @endforeach
    <table border="1" width="100%" style="font-size:12px;  border-collapse: collapse;" align="center">
        <tr  bgcolor="#8BA4D0">
            <th class="text-center" style="width:10%">Cantidad</th>
            <th class="text-center" style="width:60%">Descripción</th>
            @if ($dt > 0 )     <th class="text-center">Dto. Unit. </th>  @endif   
            <th class="text-center" style="width:10%">Precio Unit.</th>
            <th class="text-center" style="width:10%">Subtotal</th>
        </tr>
    

        @php $sumas=0; @endphp
        @foreach($detalles as $det)
                    @php    $precio = cpd($det , $venta);  
                            $sumas +=  round($precio[1],2);
                    @endphp
            <tr valign="top">
                <td align="center"  style="width:10%">{{$det->cantidad}}</td>
                <td class="text-left"   style="width:60%">{{$det->articulo}}&nbsp; 
                    {{($det->descripciondc != null) ? $det->descripciondc : $det->nombreModelo ." ".  $det->nombreMarca}}  {{$det->garantiadc}}</td>
                @if ($dt > 0 )<td class="text-right"  >{{$det->descuento}}&nbsp;</td> @endif  
                <td align="right">{{number_format($precio[0], 2, '.', ',')}}&nbsp;</td>
                <td align="right">{{number_format($precio[1], 2, '.', ',')}}&nbsp;</td>
                
            </tr>
        @endforeach

    @if ($venta->tipo_comprobante == "Factura" || $venta->tipo_comprobante == "1"  || $venta->tipo_comprobante == "2" || $venta->tipo_comprobante == "4")
        <tr valign="top">
            <td colspan="2"></td>
            @if ($dt > 0 )<td></td> @endif  
            <td align="right" >Total &nbsp;</td>
            <td align="right" >{{number_format($sumas, 2, '.', ',')}}&nbsp;</td>
        </tr>
    </table>
    {{--END FACTURA--}}
    @else {{--CCF--}}
        <tr valign="top">
            <td rowspan="3" colspan="2"></td>
            @if ($dt > 0 )<td></td> @endif  
            <td align="right"  >Sumas&nbsp;</td>
            <td align="right" >{{number_format($sumas, 2, '.', ',')}}&nbsp;</td>
        </tr>

        <tr valign="top">
        
            @if ($dt > 0 )<td></td> @endif  
            <td align="right" >IVA&nbsp;</td>
            <td align="right" >{{number_format(($sumas * $varios->iva), 2, '.', ',')}}&nbsp;</td>
        </tr>
        <tr valign="top">
        
            @if ($dt > 0 )<td></td> @endif  
            <td align="right" >Total&nbsp;</td>
            <td align="right" >{{number_format($sumas + ($sumas * $varios->iva),2, '.', ',')}}&nbsp;</td>
        </tr>
    @endif
    {{--END CCF--}}
    </table>
    <br><br>
    <div style="padding: 0px 0px 0px 0px;   text-align: justify;"><span  style="font-size:12px;">{{$venta->nota}}</span> 
    </div>
    <br><br>
    <table  width="100%" style="font-size:12px;   border-collapse: collapse; " align="center">
        <tr>
            <th rowspan="6" style="width:1%"></th>
            <th colspan="4">Gracias por preferirnos</th>
            <th rowspan="6" style="width:1%"></th>
        </tr>
        <tr>
            <td colspan="4">PRECIOS</td>
        </tr>
        <tr>
            <td colspan="4">INCLUYE IVA</td>
        </tr>
        <tr>
            <td style="height:30px;">Nombre</td>
            <td>________________________________</td>
            <td>Firma</td>
            <td>________________________________</td>
        </tr>
        <tr>
            <td style="height:30px;">Cargo</td>
            <td>________________________________</td>
            <td>Sello</td>
            <td>________________________________</td>
        </tr>
        <tr>
            <td colspan="4" align="right">Aceptado Cliente</td>
        </tr>
    </table>
    <table  width="100%"  border="0"  style="font-size:12px;">
        <tr>
            <td colspan="4"><img src="{{asset('imagenes/image001.png')}}" alt="texto alternativo" width="600%" height="alto"></td>   
        </tr>
        <tr>
            <td WIDTH="50%">Att. --Mario Miranda <br> Representante Técnico <br> Tel 7566 5507</td>
            {{-- <td align="right">
                <img src="{{asset('imagenes/image004.jpg')}}" alt="texto alternativo" width="500%" height="alto">
            </td>
            <td align="right">
                <img src="{{asset('imagenes/image002.jpg')}}" alt="texto alternativo      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
        @font-face { font-family: 'Roboto', sans-serif; }


        body { font-family: 'Roboto', sans-serif; font-size:12px; }  " width="500%" height="alto">
            </td>
            <td align="right">
                <img src="{{asset('imagenes/image003.jpg')}}" alt="texto alternativo" width="500%" height="alto">
            </td> --}}
        </tr>
    </table>
</main>
</body>