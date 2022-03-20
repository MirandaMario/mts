@extends('layouts.admin')
@section('title','Ventas por agrupacion')
@section('contenido')
<div id="muestra">
   {{--  <img align="left" width="125" height="85" src="{{asset('imagenes/logo.jpg')}}">
    <h4 align="center"> {{ config('constantes.COMPANY') }} </h4> --}}

    @if ($request->fecha == $request->fecha2)
    <h5 align="center">Reporte de Artículos Vendidos al día {{date('d/m/Y', strtotime($request->fecha))}} </h5>
    @else
    <h5 align=" center">Reporte de Artículos Vendidos entre el {{date('d-m-Y', strtotime($request->fecha))}} y
        {{date('d-m-Y', strtotime($request->fecha2))}} </h5>
    @endif



    @if ($tipoc == 3)
    Articulos filtrados por CCF<br>
    @elseif($tipoc == 2)
    Articulos filtrados por Factura<br>
    @elseif($tipoc == 1)
    <br> Articulos filtrados por Ticket <br>
    @else
    @endif
    <br>


    <table class="table table-condensed table-striped" style="font-size:12px;" border="0">
        <thead>
            <tr>
                <th HEIGHT="25" class="text-left" align="left" width="5%">#</th>
                <th class="text-left" align="left" width="15%">Código</th>
                <th class="text-left" align="center" width="5%">Cant</th>
                <th class="text-left" align="center" width="55%">Nombre</th>
               {{--  <th class="text-right" align="right">Total</th> --}}
            </tr>
        </thead>

        <tbody>
            @php $i2 = 0; $i = 1; $i3 = 0;  @endphp
            @foreach($ventas as $ven)
            <tr>
                <td class="text-left">{{$i++}}</td>
                <td class="text-left" align="left">{{$ven->codigo}}</td>
                <td class="text-left" align="center">{{$ven->cantida}}</td>
                <td class="text-left" align="left">{{$ven->nomArticulo}}</td>
             {{--    <td align="right">
                    @if($ven->tipo_comprobante === '3')
                    {{ number_format((($ven->precio_venta * 0.13) + $ven->precio_venta), 2) }}&nbsp;$

                    @php $i2 += ($ven->precio_venta * 0.13) + $ven->precio_venta; @endphp
                    @else
                    {{ number_format($ven->precio_venta , 4) }}&nbsp;$

                    @php $i3 += $ven->precio_venta @endphp
                    @endif
                </td> --}}
            </tr>

            @endforeach
        </tbody>
   {{--      <tr>

            <th>{{number_format($i3+$i2 , 2, '.', ',') }}</th>
            <th></th>
            <th>{{number_format($i3 , 2, '.', ',') }}</th>
            <th class="text-right" align="right">SUMAS </th>
            <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }} </th>
        </tr> --}}

    </table>
</div>

<a href="javascript:imprSelec('muestra')">Imprimir Datos</a>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>
@endsection
