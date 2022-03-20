@extends('layouts.admin')
@section('title','Ventas Documento')
@section('contenido')
<style type="text/css">
    .pa {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<div id="muestra">
    <div class="row pa " >
        <div class="panel panel-primary pa ">
            @if ($request->fecha == $request->fecha2)
            <h5 align="center">Reporte de Ventas al día {{date('d/m/Y', strtotime($request->fecha))}} </h5>
            @else
            <h5 align="center">Reporte de Ventas
                del {{date('d/m/Y ', strtotime($request->fecha))}} hasta {{date('d/m/Y', strtotime($request->fecha2))}}
            </h5>
            @endif

            @if ($request->tipo_comprobante == 3)
            Ventas filtradas por CCF<br>
            @elseif($request->tipo_comprobante == 2)
            Ventas filtradas por Factura<br>
            @elseif($request->tipo_comprobante == 1)
            <br> Ventas filtradas por Ticket <br>
            @else
            Tosdas Ventas 
            @endif
            <br>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pa">
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%" id="agrupacion_dias">
                <thead>
                    <tr>
                        <th HEIGHT="25" class="text-left" align="left" width="5%"># </th>
                        <th class="text-center" align="center" width="10%">Fecha </th>
                        <th class="text-right" align="right" width="10%">Total </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i2 = 0; $i = 1; @endphp
                    @foreach($ventas_dias as $ven)
                        <tr>
                            <td class="text-left" align="left">{{$i++}}</td>
                            <td class="text-center" align="center">{{date('d/m/Y' , strtotime($ven->fecha_hora))}}</td>
                            <td class="text-rigth" align="right">
                                @if ($ven->estado == 'Reporte')
                                      Reporte
                                @else
                                  {{number_format($ven->total_venta, 2, '.', ',')}}
                                @endif  
                            </td>
                            @php $i2 += $ven->total_venta @endphp
                        </tr>
                    @endforeach
                </tbody>
                <tr>
                    <th></th>
                    <th>SUMAS $</th>
                    <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}</th>
                </tr>
            </table>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pa">

        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa table-responsive">
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%" id="my_table">
                <thead>
                    <tr>
                        <th HEIGHT="25" class="text-left" align="left" width="5%"># </th>
                        <th class="text-center" align="center">Fecha </th>
                        <th class="text-left" align="center" width="60%">Cliente </th>
                        <th>E_C$</th>
                        <th>E_I$</th>
                        <th>F_Pago</th>
                        <th>$_Efec</th>
                        <th align="left" width="5%">Doc</th>
                        <th align="left" width="5%">#</th>
                        <th class="text-right" align="right" width="10%">Total </th>
                    </tr>

                </thead>
                <tbody>
                    @php $i2 = 0; $i = 1;  $cc =  0;  $ec = 0; $ei = 0; @endphp
                    @foreach($ventas as $ven)
                        <tr>
                            <td class="text-left" align="left">{{$i++}}</td>
                            <td class="text-center" align="center">{{date('d/m' , strtotime($ven->fecha_hora))}}</td>
                            <td class="text-left" align="left">{{$ven->nombre}}</td>
                            <td class="text-center" align="center">{{$ven->envio}}</td>
                            <td class="text-center" align="center">{{$ven->envio_interno}}  @php  $ec += $ven->envio;  $ei += $ven->envio_interno;    @endphp </td>
                            <td class="text-center" align="center">
                                    @if($ven->forma_pago  == 4)
                                        Efectivo 
                                    @elseif($ven->forma_pago ==  1)
                                        Electronica / POS
                                    @elseif($ven->forma_pago ==  2)
                                        Guia 
                                    @elseif($ven->forma_pago ==  3)
                                        Cheque
                                    @elseif($ven->forma_pago ==  5)
                                        Transferencia
                                    @elseif($ven->forma_pago ==  6)
                                        Chivo    
                                    @else 
                                    @endif    
                            </td>
                            <td  class="text-rigth" align="right">
                                @if($ven->forma_pago  == 4)
                                    {{number_format($ven->total_venta, 2, '.', ',')}}
                                    @php  $cc +=  $ven->total_venta;  @endphp
                                @endif
                            </td>
                            <td cclass="text-center" align="center">{{$ven->tipo_comprobante}}</td>
                            <td class="text-left" align="left">{{$ven->num_comprobante}}</td>
                            <td class="text-rigth" align="right">
                                          @if ($ven->estado == 'Reporte')
                                                Reporte
                                          @else
                                            {{number_format($ven->total_venta, 2, '.', ',')}}
                                          @endif  
                            </td>
                            @php $i2 += $ven->total_venta @endphp
                        </tr>
                    @endforeach
                </tbody>
                <tr>
                    <th colspan="3"></th>
                    <th class="text-center" align="center">{{number_format($ec , 2, '.', ',') }}</th>
                    <th class="text-center" align="center">{{number_format($ei , 2, '.', ',') }}</th>
                    <th></th>
                    <th class="text-right" align="right">{{number_format($cc , 2, '.', ',') }}</th>
                    <th></th>
                    <th>_$</th>
                    <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}</th>
                </tr>
            </table>
        </div><div>
            <br>
<hr>
<br>
<p> HACIENDA CCF</p>
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%" id="my_table2">
                <thead>
                    <tr>
                        {{-- <th HEIGHT="25" class="text-left" align="left" width="5%"># </th> --}}
                        <th class="text-center" align="center" width="10%">Fecha </th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>E</th>
                        <th align="left">F</th>
                        <th>G</th>
                        <th width="10%" >NCR</th>
                        <th align="center" width="30%">Nombre</th>
                        <th>J</th>
                        <th>K</th>

                        
                        <th class="text-right" align="right" width="10%">Sumas </th>
                        <th class="text-right" align="right" width="10%">IVA </th>
                        <th>O</th>
                        <th>O</th>
                        <th class="text-right" align="right" width="10%">Total </th>
                        <th>D</th>
                        <th>O</th>
                    </tr>

                </thead>
                <tbody>
                    @php $i2 = 0; $i = 1; $sum = 0 ;  $iva = 0; @endphp
                    @foreach($ventas as $ven)
                    @if ($ven->tipo_comprobante == 3)
                        @if ($ven->total_venta > 0)
                        <tr>
                            {{-- <td class="text-left" align="left">{{$i++}}</td> --}}
                            <td class="text-center" align="center">{{date('d/m/Y' , strtotime($ven->fecha_hora))}}</td>
                            <td>1</td>
                            <td>03</td>
                            <td>15041RESIN068272021</td>
                            <td>21BL000C</td>
                            <td class="text-left" align="left">{{$ven->num_comprobante}}</td>
                            <td class="text-left" align="left">{{$ven->num_comprobante}}</td>
                            <td class="text-left" align="left">{{ str_replace('-', '', $ven->iva)}}</td>
                            <td class="text-left" align="left">{{strToUpper($ven->nombre)}}</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td class="text-right" align="left"> {{number_format(($ven->total_venta/(1+$varios->iva)), 2, '.', '')}}</td>
                            <td class="text-right" align="left"> {{number_format(($ven->total_venta * $varios->iva), 2, '.', '')}}</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td class="text-right" align="left"> {{number_format($ven->total_venta, 2, '.', '')}}</td>
                            <td></td>
                            <td>1</td>
                           
                            @php $i2 += $ven->total_venta; 
                                 $sum += $ven->total_venta/(1+ $varios->iva); 
                                 $iva += $ven->total_venta *$varios->iva; 
                            @endphp
                        </tr>
                        @else
                        @endif
                    @else
                    @endif    
                        
                    @endforeach
                </tbody>
                <tr>
                    <th colspan="12"></th>
                    <th class="text-right" align="right">{{number_format($sum , 2, '.', ',') }}</th>
                    <th class="text-right" align="right">{{number_format($iva , 2, '.', ',') }}</th>
                    <th></th>
                    <th></th>
                    <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}</th>
                </tr>
            </table>

        <hr>
        <p><b> HACIENDA FACTURA</b></p>
        <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%" id="my_table2">
            <thead>
                <tr>
                    {{-- <th HEIGHT="25" class="text-left" align="left" width="5%"># </th> --}}
                    <th class="text-center" align="center" width="10%">A </th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th align="left">F</th>
                    <th>G</th>
                    <th>H</th>
                    <th>I</th>                    
                    <th>J</th>
                    <th>K</th>
                    <th>L</th>
                    <th>M</th>
                    <th>N</th>
                    <th>O</th>
                    <th>P</th>
                    <th>Q</th>
                    <th>R</th>
                    <th>S</th>
                    <th>T</th>
                    <th>D</th>
                    <th>U</th>
                </tr>

            </thead>
            <tbody>
               {{--  @php $i2 = 0; $i = 1; $sum = 0 ;  $iva = 0; @endphp --}}
                @foreach($ventas as $ven)
                @if ($ven->tipo_comprobante == 2)
                    @if ($ven->total_venta > 0)
                    <tr>
                       {{--  <td class="text-left" align="left">{{$i++}}</td> --}}
                        <td class="text-center" align="center">{{date('d/m/Y' , strtotime($ven->fecha_hora))}}</td> {{-- A --}}
                        <td>1</td>   {{-- B --}}
                        <td>01</td>  {{-- C --}}
                        <td>150041RESIN200792021</td>    {{-- D --}}
                        <td>21BL000F1</td>               {{-- E --}}    
                        <td class="text-left" align="left">{{$ven->num_comprobante}}</td>   {{-- F --}}
                        <td class="text-left" align="left">{{$ven->num_comprobante}}</td>   {{-- G --}}
                        <td class="text-left" align="left">{{$ven->num_comprobante}}</td>   {{-- H --}}
                        <td class="text-left" align="left">{{$ven->num_comprobante}}</td>   {{-- I --}}
                        <td class="text-left" align="left"></td> {{-- J --}}
                        <td>0.00</td> {{-- K --}}
                        <td>0.00</td> {{-- L --}}
                        <td>0.00</td> {{-- M --}}
                        <td class="text-right" align="left"> {{number_format($ven->total_venta, 2, '.', '')}}</td> {{-- N --}}
                        <td>0.00</td>   {{-- --}} 
                        <td>0.00</td>   {{-- --}}
                        <td>0.00</td>   {{-- --}}
                        <td>0.00</td>   {{-- --}}
                        <td>0.00</td>   {{-- --}}
                        <td class="text-right" align="left"> {{number_format($ven->total_venta, 2, '.', '')}}</td>
                        <td></td>
                        <td>2</td>
                       
                        @php 
                                $i2 += $ven->total_venta; 
                                $sum += $ven->total_venta/1.13;    
                        @endphp
                    </tr>
                    @else
                    @endif
                @else
                @endif    
                    
                @endforeach
            </tbody>
            <tr>
                <th colspan="12"></th>
                <th class="text-right" align="right">{{number_format($sum , 2, '.', ',') }}</th>
                <th class="text-right" align="right">{{number_format($iva , 2, '.', ',') }}</th>
                <th></th>
                <th></th>
                <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}</th>
            </tr>
        </table>
        </div>
    </div>
    <a class="imprimir" href="javascript:imprSelec('muestra')">IMPRIMIR DATOS ACTUALES</a>
</div>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>
<script>
    $(document).ready(function(){
    $('#my_table , #my_table2 ,  #agrupacion_dias').DataTable({
        "order": [[ 2, "desc" ]],
        "aLengthMenu": [[1000000, 25, 50, 75, -1], [1000000, 25, 50, 75, "All"]],
        "iDisplayLength": 1000000,

    "searching" : false,
    "paging"  : false,
    //"infoFiltered": " - filtered from _MAX_ records"
    "info"  : false
    });
});
</script>
@endsection


{{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa"> --}}
{{--     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa"> --}}
{{--  <img align="left" width="125" height="85" src="{{asset('imagenes/logo.jpg')}}"> --}}
{{--  <h4 align="center"> {{ config('constantes.COMPANY') }} </h4> --}}