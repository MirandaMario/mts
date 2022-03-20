@extends('layouts.admin')
@section('title','VTA * ART BENEFECIO')
@section('contenido')
<style type="text/css">
    .pa {
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<div id="muestra">
    <div class="row pa ">
        <div>
            @if ($request->fecha == $request->fecha2)
            <h5 align="center">REPORTE DE VENTAS POR ARTICULOS {{date('d/m/Y', strtotime($request->fecha))}} </h5>
            @else
            <h5 align="center">REPORTE DE VENTAS POR ARTICULOS
                DEL <b> {{date('d/m/Y ', strtotime($request->fecha))}} </b> HASTA <b> {{date('d/m/Y',
                    strtotime($request->fecha2))}} </b>
            </h5>
            @endif

            @if ($request->tipo_comprobante == 3)
            Ventas filtradas por CCF<br>
            @elseif($request->tipo_comprobante == 2)
            Ventas filtradas por Factura<br>
            @elseif($request->tipo_comprobante == 1)
            <br> Ventas filtradas por Ticket <br>
            @else
            <h5> TODAS LAS VENTAS </h5>
            @endif
            <br>
            <div class="table-responsive">
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pa">
                <b>AGRUPACION POR CATEGORIAS </b>
                <table class="table  table-striped table-hover" style="font-size:12px;" width="100%" id="top25">
                    <thead>
                        <tr>
                            <th HEIGHT="25" class="text-left" align="left" width="2%"># </th>
                            <th class="text-left"   align="center" >CAT</th>
                            <th class="text-center" align="left">Can</th>
                            <th class="text-center" align="left">Total </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; $j = 0;  $k = 0 ; @endphp
                        @foreach($agrupacion_categoria as $top)
                        <tr>
                            <td class="text-left"   align="left">{{$i++}}</td>
                            <td class="text-left"   align="left">{{$top->nombreCategoria}}</td>
                            <td class="text-center" align="center">{{$top->cantidadav}} </td>
                            <td class="text-right"  align="right">{{number_format($top->ingreso, 2, '.', ',')}} 
                                @php $j += $top->ingreso;  @endphp
                            </td>
                           
                           
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th colspan="3" class="text-right" align="right">TOTAL</th>
                        <th class="text-right" align="right">{{number_format($j, 2, '.', ',')}}</th>  
                    </tr>
                </table>
                
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa">
                <b>AGRUPACION POR ARTICULOS </b>
                <table class="table  table-striped table-hover" style="font-size:12px;" width="100%" id="top25">
                    <thead>
                        <tr>
                            <th HEIGHT="25" class="text-left" align="left" width="2%"># </th>
                            <th class="text-center" align="center" width="10%">ID_ART </th>
                            <th class="text-left"   align="center" >Nombre_Modelo</th>
                            <th class="text-left"   align="center" >CAT</th>
                            <th class="text-center" align="left">Can</th>
                            <th class="text-center" align="left">Total </th>
                            <th class="text-center" align="left">BEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; $j = 0;  $k = 0 ;  @endphp
                        @foreach($top25 as $top)
                        <tr>
                            <td class="text-left"   align="left">{{$i++}}</td>
                            <td class="text-center" align="center">{{$top->codigo}}</td>
                            <td class="text-left"   align="left">{{$top->nombrearticulo}} {{$top->nombreModelo}}</td>
                            <td class="text-left"   align="left">{{$top->nombreCategoria}}</td>
                            <td class="text-center" align="center">{{$top->cantidadav}} </td>
                            <td class="text-right"  align="right">{{number_format($top->ingreso, 2, '.', ',')}} 
                                @php $j += $top->ingreso;  @endphp
                                </td>
                            <td class="text-right" align="right">
                                @if ($top->media > 0 || $top->total_elemmentos_comprados  > 0)

                                    @php $media  = ($top->media/$top->total_elemmentos_comprados) * 1.13;  
                                         $media2 = $top->ingreso - ($media * $top->cantidadav); 
                                         $k += $media2;  
                                    @endphp 
                                    {{number_format($media2, 2, '.', ',')}} 
                                @endif
                            </td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th colspan="5" class="text-right" align="right">TOTAL</th>
                        <th class="text-right" align="right">{{number_format($j, 2, '.', ',')}}</th>
                        <th class="text-right" align="right">{{number_format($k, 2, '.', ',')}} <br>{{number_format($k/1.13, 2, '.', ',')}}</th>
                    </tr>
                </table>
                
                </div>
                <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
                <br><br><br><br>
                <b>ARTICULO POR CLIENTE, COMPROBANTE Y  FECHA  </b>
                <br><br>
                <table class="table compact table-striped table-hover" style="font-size:12px" width="100%"
                    id="table_beneficio">
                    <thead>
                        <tr>
                            <th HEIGHT="25" class="text-left" align="left" width="2%"># </th>
                            <th class="text-center" align="center" width="10%">Fecha </th>
                            <th class="text-left" align="center" width="20%">Cliente </th>
                            <th class="text-left" align="center" width="30%">Articulo </th>
                            <th class="text-center" align="center" width="5%">Cant</th>
                            <th class="text-center" align="left" width="5%">Comp</th>
                            <th class="text-right" width="5%">Número</th>
                            <th class="text-right" align="right">x&#772;</th>
                            <th class="text-right" align="right" width="7%">PLista</th>
                            <th class="text-right" align="right" width="7%">PVenta</th>
                            {{-- <th class="text-right" align="right" width="10%">Total </th> --}}
                        </tr>

                    </thead>
                    <tbody>
                        @php $i2 = 0; $i = 1; $i3= 0; $i4 = 0; @endphp
                        @foreach($ventas as $ven)
                        <tr>
                            <td class="text-left" align="left">{{$i++}}</td>
                            <td class="text-center" align="center">{{date('d/m/y' , strtotime($ven->fecha_hora))}}</td>
                            <td class="text-left" align="left">{{$ven->nombre}}</td>
                            <td class="text-left" align="left">{{$ven->nombrearticulo}} {{$ven->nombreModelo}}</td>
                            <td class="text-center" align="center">{{$ven->cantidad}} </td>
                            <td class="text-center" align="center">{{$ven->tipo_comprobante}}</td>
                            <td class="text-right" align="right">{{$ven->num_comprobante}}</td>
                            <td class="text-right" align="right">{{number_format(($ven->promedio * $ven->cantidad)*
                                1.13, 2, '.', ',')}}</td>
                            <td class="text-right" align="right">{{number_format(($ven->costoProducto * $ven->cantidad)
                                * 1.13, 2, '.', ',')}}</td>
                            <td class="text-right" align="right">{{number_format($ven->precio_venta * $ven->cantidad, 2,
                                '.', ',')}}</td>
                            @php $i2 += $ven->costoProducto * $ven->cantidad; $i3 += $ven->precio_venta *$ven->cantidad;
                            $i4 += $ven->promedio *$ven->cantidad; @endphp

                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th colspan="4"></th>
                        <th class="text-right">Benefico</th>
                        <th>{{number_format(($i3 -($i4 * 1.13))/1.13, 2, '.', ',')}}</th>
                        <th></th>
                        <th class="text-right">{{number_format($i4 * 1.13, 2, '.', ',')}}</th>
                        <th class="text-right">{{number_format($i2 * 1.13, 2, '.', ',')}}</th>
                        <th class="text-right">{{number_format($i3, 2, '.', ',')}}</th>
                    </tr>
                </table>



            </div>
        </div>
    </div>
    <a class="imprimir" href="javascript:imprSelec('muestra')">IMPRIMIR DATOS ACTUALES</a>
</div>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
    $('#table_beneficio,  #top25').DataTable({
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
<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>
@endsection