{{-- reimpresion  --}}

<!DOCTYPE html5>
<title> TICKET {{$venta->num_comprobante}} </title>
<html lang="en" style="margin: 0px; ">
<link rel="stylesheet" href="{{asset('bootstrap337/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/ticket/prueba.css')}}">
<style>
 .number{
  letter-spacing: -0.1em;
}
</style>
<body>
    <div class="container  text-center">
        <br>
        <h5 class=text-center><b>{{$venta->nombreTienda}}</b></h5>
        <p style="font-size: 12px;"><strong> {{$varios->nombre}}</strong> <br>
        <p style="font-size: 12px;"><strong>NIT : </strong> {{$varios->nit}} <br>
        <strong>NCR : </strong> {{$varios->ncr}}<br>
        <strong>GIRO : </strong> {{$varios->giro}}<br>
        <strong>Fecha / hora: </strong>{{$newDate = date("H:i d-m-Y", strtotime($venta->fecha_hora))}} <br />
        <strong>Ticket #: </strong> {{str_pad($venta->num_comprobante, 6, '0', STR_PAD_LEFT)}} <br />
        <strong>Cliente:</strong> {{$venta->nombre}}</p><br/>

        <div class="lineas"> </div>

        <table class="outer-section2"  width="100%">
            <thead>
                <tr>
                    <th class=text-left style="width:2%">C.</th>
                    <th class=text-left style="width:35%">Descrip.</th>
                    <th class=text-right style="width:4%">P.U.</th>
                    <th class=text-right style="width:10%">Total</th>
                </tr>

            </thead>
            @php $i=0; $i2=0; $e = 0 ; $g = 0; $c= 0; $sumas = 0 ;  @endphp
            <tr><td colspan="4">&nbsp;</td></tr>
            @foreach($detalles as $det)
            <tr style="font-size: 12px; font-weight: bold;" >
                <td class="text-left  ">{{$det->cantidad}}</td>
                <td class="text-left  ">{{$det->articulo}}</td>
                <td class="text-right number">{{number_format($det->precio_lista,2,'.',',')}}</td>
                @php
                $precio = cpd2($det , $venta,  $varios);
                $i += $precio[1];
                $e += $precio[2]; 
                $g += $precio[3]; 
                $c += $precio[4]; 
                @endphp

                <td class="text-right number">{{number_format($precio[1],2,'.',',')}}<b>{{$det->impuesto == 0 ? 'E' : 'G'}}</b></td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td> @php
                    $sumas = $e + $g + $c; 
                @endphp </td>
                <td></td>
                <td></td>
                <td class=text-right>
                    @if($det->descuento =='0')

                    @elseif($det->descuento > '0')
                    -{{round($det->cantidad *($det->precio_lista *($det->descuento/100)), 2)}}
                    @endif
                </td>
            </tr>
            @endforeach
            <tr style="font-size: 12px" >
                <td colspan="4" style="font-weight: bold;"><b> G = GRABADO E = EXCENTO</b></td>

            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td  class=text-right colspan="3">SUMAS $ </td>
                <td class=text-right style="font-size: 14px" ><b>{{round($i, 2)}}</b>
                </td>

            </tr>
            <tr>
                <td  class=text-right colspan="3">EXENTO $ </td>
                <td class=text-right style="font-size: 14px" ><b>{{$e}}</b></td>

            </tr>
            <tr>
                <td  class=text-right colspan="3">GRAVADO $ </td>
                <td class=text-right style="font-size: 14px" ><b>{{round($g, 2)}}</b></td>

            </tr>
            <tr>
                <td  class=text-right colspan="3">VENTAS NO SUJETAS $ </td>
                <td class=text-right style="font-size: 14px" ><b>0.00</b> </td>
            </tr>
            <tr>
                <td  class=text-right colspan="3">CESC $ </td>
                <td class=text-right style="font-size: 14px" ><b>{{round($c, 2)}}</b> </td>
            </tr>
            <tr>
                <td  class=text-right colspan="3">TOTAL $ </td>
                <td class=text-right style="font-size: 14px" ><b>{{round($sumas, 2)}}</b> </td>
            </tr>
        </table>
        <div class="lineas"> </div>
        <br> 
        <div class=" text-left">
            @if ($venta->total_venta >= 200.00)
            <label style="font-size: 10px" class=text-left>Nombre:_____________________</label> <br>
            <label style="font-size: 10px" class=text-left>DUI/NIT:____________________</label>

            @endif
        </div><br>
        <div class="lineas"> </div><br>


        <p style="font-size:11px; font-weight: bold;"> {{$venta->direccion}} <br>
            N° de Res. {{$venta->numero_resolucion}} <br>
            Fecha de Resolución:{{$venta->fecha_resolucion}} <br>
            Serie. Auto: {{$venta->rango_desde .'-'. $venta->rango_hasta }} <br>
            Tel. : {{$venta->tel_tienda}} <br>
            <br>  <input type="button" value="{{config('constantes.website') }}" onClick="window.print()"></p>

        <br> 
        <p>...</p>
    </div>
</body>