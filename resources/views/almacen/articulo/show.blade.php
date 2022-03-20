@extends('layouts.admin')
@section('title', 'Estadistica Artículo')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <div class="row" {{-- style=" {{ config('constantes.FONT') }}" --}}>
        <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:150%; height: 40px;"> Estadistica de artículo
                    {{-- en {{$articulo->nombreTienda}} --}} </div>
                    @php $precio = precio($articulo, $varios ) @endphp
                <div class="panel-body">
                    <h3>{{ $articulo->nombre }} <small> &nbsp;&nbsp;&nbsp;&nbsp; {{-- {{$articulo->descripcion}}  &nbsp;&nbsp;&nbsp;&nbsp --}}
                            {{ $articulo->nombreMarca }} {{ $articulo->nombreModelo }} &nbsp;&nbsp;   <b>$<span id="precio">{{number_format($precio[0], 2, '.', '')}}</span></b> </small>
                    </h3>
                    
                    <div >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th width="15%" class="text-center">Id</th>
                                            <th width="15%" class="text-center">Código</th>
                                            <th width="15%" class="text-center">Stock</th>
                                            <th width="15%" class="text-center">Estado</th>
                                            <th  class="text-center">Rentabilidad $</th>
                                            <th  class="text-center">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%" class="text-center">{{ $articulo->idarticulo }}</td>
                                            <td width="15%" class="text-center">{{ $articulo->codigo }}</td>
                                            <td width="15%" class="text-center">{{ $articulo->stock }}</td>
                                            <td width="15%" class="text-center">{{ $articulo->estado }}</td>
                                            <td class="text-center" id="rentabilidad"></td>
                                            <td class="text-center" id="porcentaje"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
                            <table class="table  table-bordered table-condensed table-hover">
                                <tr>
                                    <th>...</th>
                                    <th>Comprados</th>
                                    <th>Vendidos </th>
                                    <th>Diferencia   </th>
                                    <th>Pendiente</th>
                                    <th>Proyeccion</th>
                                    <th>Beneficio Proyectado</th>
                                </tr>
                                <tr>
                                    <th>Articulos</th>
                                    <td id="ver_total_articulo_compra"></td>
                                    <td id="ver_total_articulo_vendido"></td>
                                    <td id="diferencia_articulo" ></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td id="ver_total_compra"></td>
                                    <td id="ver_total_venta"></td>
                                    <td id="diferencia_compra_venta"></td>
                                    <td id="total_pendiente"></td>
                                    <td id="proyeccion"></td>
                                    <td id="beneficio"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="detalles"
                                        class="table table-striped table-bordered table-condensed table-hover">
                                        <thead style="background-color: #A9D0F5;">
                                            <th width="10%" class="text-center">id Ingreso</th>
                                            <th width="10%" class="text-center">Fecha</th>
                                            <th width="40%" class="text-center">Proveedor</th>
                                            <th>FAC</th>
                                            <th>VEN</th>
                                            <th>LOTE</th>
                                            <th width="10%" class="text-center" colspan="2">Comprobante</th>
                                            <th width="10%" class="text-center">Cantidad</th>
                                            <th width="10%" class="text-center">Precio Compra</th>
                                            <th width="10%" class="text-center">Subtotal</th>
                                        </thead>
                                        @php
                                            $i2 = 0;
                                            $i = 0;
                                            $total_venta = 0;
                                        @endphp
                                        <tbody>
                                            @foreach ($detalles as $det)
                                                <tr>
                                                    <td class="text-center"><b>{{ $det->ingreso }} </a></b></td>
                                                    <td class="text-center">{{ $det->fecha_hora }}</td>
                                                    <td>{{ $det->nombre }}</td>
                                                    <td>{{ $det->fecha_fac }}</td>
                                                    <td>{{ $det->fecha_ven }}</td>
                                                    <td>{{ $det->lote }}</td>
                                                    <td class="text-center">
                                                        {{$det->tipo_comprobante}}
                                                    </td>
                                                    <td class="text-right">
                                                        @if ($det->documento != null)
                                                        <a href="{{asset('facccf/'.$det->documento)}}"  target="_blank"> {{$det->num_comprobante}}</a>
                                                        @else
                                                         {{$det->num_comprobante}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $det->cantidad }}</td>
                                                    @php
                                                        // $i = 0;
                                                        $i += $det->cantidad;
                                                    @endphp
                                                    <td class="text-right">{{ $det->precio_compra }}</td>
                                                    <td class="text-right">
                                                        {{ number_format($det->cantidad * $det->precio_compra, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        <tfoot>
                                            <th colspan="8"></th>
                                            <th class="text-center" id="total_articulo_compra">{{$i}}</th>
                                            <th>
                                                <h5 class="text-right">SUMAS $<br>
                                                    <h5 class="text-right">IVA $<br>
                                                        <h5 class="text-right">TOTAL $</h5>
                                            </th>
                                            <th>
                                                <h5 class="text-right"> {{ $total->total }}<br>
                                                    <h5 class="text-right">{{ number_format($total->total *$varios->iva, 2) }}
                                                    </h5>
                                                    <h5 class="text-right" id="total_compra">
                                                        {{ number_format($total->total * $varios->iva + $total->total, 2,  '.', '') }}<br>
                                            </th>

                                        </tfoot>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @php
                            $i2 = 0;
                        @endphp
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="detalles"
                                        class="table table-striped table-bordered table-condensed table-hover">
                                        <thead style="background-color: #A9D0F5;">
                                            <th width="10%" class="text-center">id Salida</th>
                                            <th width="10%" class="text-center">Fecha</th>
                                            <th width="30%" class="text-center">Cliente</th>
                                            <th width="10%" class="text-center">Descuento</th>
                                            <th width="10%" class="text-center" colspan="2" >Comprobante</th>
                                            <th width="10%" class="text-center">Cantidad</th>
                                            <th width="10%" class="text-center">Precio Venta</th>                                     
                                            <th width="10%" class="text-center">Subtotal</th>
                                        </thead>

                                        <tbody>
                                            @foreach ($detallesv as $detv)
                                                <tr>
                                                    <td class="text-center">
                                                        <b> {{ $detv->venta }} </a></b>
                                                    </td>
                                                    <td class="text-center">{{ $detv->fecha_horav }}</td>
                                                    <td>{{ $detv->nombrev }}</td>
                                                    <td class="text-center">{{ $detv->descuento }} %</td>
                                                    <td class="text-right">
                                                        @if ($detv->tipov == 1)
                                                            TIC
                                                        @elseif ($detv->tipov == 2)
                                                            FAC
                                                        @else
                                                            CCF
                                                        @endif
                                                        
                                                        &nbsp;&nbsp;&nbsp;
                                                        {{ $detv->seriev }} &nbsp;&nbsp;&nbsp; 
                                                        
                                                    </td>
                                                    <td class="text-right"><a href="{{URL::action('VentaController@show',$detv->venta)}}" target="_blank">
                                                        <b><span aria-hidden="true" >{{ $detv->numv }}</span> </b></a></td>
                                                    <td class="text-center">
                                                        {{ $detv->cantidadv }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($detv->tipov === '3')
                                                            {{ $detv->preciov + $detv->preciov * $varios->iva}}
                                                        @else
                                                            {{  number_format($detv->preciov , 2,  '.', '')}}

                                                        @endif
                                                    </td>
                                                   
                                                    @if ($detv->tipov === '3')
                                                        @php
                                                            $i2 += $detv->cantidadv;
                                                            $subtotal_venta = $detv->cantidadv * $detv->preciov - $detv->cantidadv * $detv->preciov * ($detv->descuento / 100);
                                                            $subtotal_venta_iva = $subtotal_venta + $subtotal_venta * $varios->iva;
                                                            $total_venta += $subtotal_venta_iva;
                                                        @endphp
                                                        <td class="text-right">$
                                                            {{ number_format($subtotal_venta_iva, 2,  '.', '') }}</td>
                                                    @else
                                                        @php
                                                            $i2 += $detv->cantidadv;
                                                            $subtotal_venta = $detv->cantidadv * $detv->preciov - $detv->cantidadv * $detv->preciov * ($detv->descuento / 100);
                                                            $total_venta += $subtotal_venta;
                                                        @endphp
                                                        <td class="text-right">{{ number_format($subtotal_venta, 2,  '.', '') }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="total_articulo_vendido" class="text-center">{{ $i2}}</th>
                                            <th>
                                                <h5 class="text-right">SUMAS $</h5>
                                            </th>
                                            <th>
                                                <h5 class="text-right" id="total_venta"> {{ $total_venta }}</h5>
                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                {{-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                  <p>&nbsp;&nbsp;Total de elementos adquiridos :  <b>{{ $i }} </b>   </p>
                  <p>&nbsp;&nbsp;Total de elementos vendidos :  <b> {{ $i2 }}   </b></p>
                  <p>&nbsp;&nbsp;Promedio costo del artículo :<b> $   {{ ($i>0) ? number_format($total->total/$i , 2) : ($i)}} </b></p>
                  <p>&nbsp;&nbsp;Promedio Venta del artículo : <b>$   {{ ($i2>0) ? ($totalv->totalv/$i2)  : ($i2) }} </b></p>
                  <p>&nbsp;&nbsp;Margen de contribucion del artículo :  <b>$  {{ (($i2>0) && ($total->total>0)) ? number_format(($totalv->totalv/$i2)-($total->total/$i),2) :($i2) }}</b> </p>
                  <p>&nbsp;&nbsp;Contribución actual total  :<b> $   {{(($i2>0) && ($total->total>0))  ? number_format((($totalv->totalv/$i2)-($total->total/$i))* $i2, 2 )    : ($i2)}} </b></p>
                  <p>&nbsp;&nbsp;Beneficio del producto  :  <b>% {{ (($i2>0) && ($total->total>0))? number_format(((($totalv->totalv/$i2)-($total->total/$i))/($total->total/$i))*100, 2) : ($i2) }}</b> </p>
                </div> --}}
            </div>

                    </div>

                </div>

            </div>
        </div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $( document ).ready(function() {
        var total_venta  = 0; 
        var total_compra = 0; 
        var total_articulo_compra  = 0;
        var total_articulo_vendido = 0;
        var precio = 0; 


        precio = $("#precio").text() * 1; 

        total_venta =  $("#total_venta").text() * 1;
        total_articulo_compra =  $("#total_articulo_compra").text() * 1; 
        $("#ver_total_articulo_compra").text(total_articulo_compra)

        total_articulo_vendido =  $("#total_articulo_vendido").text() * 1; 
        $("#ver_total_articulo_vendido").text(total_articulo_vendido)


        total_compra =  $("#total_compra").text() * 1; 
        $("#ver_total_compra").text(total_compra)

        total_venta =  $("#total_venta").text() * 1; 
        $("#ver_total_venta").text(total_venta)
                
        $("#diferencia_articulo").text(total_articulo_compra - total_articulo_vendido)
        $("#diferencia_compra_venta").text((total_venta - total_compra).toFixed(2))

        $("#total_pendiente").text((total_articulo_compra - total_articulo_vendido) * precio)

        $("#proyeccion").text((((total_articulo_compra - total_articulo_vendido) * precio) + total_venta).toFixed(2))

        $("#beneficio").text((((total_venta +(total_articulo_compra - total_articulo_vendido) * precio))  -total_compra).toFixed(2)); 

        $("#rentabilidad").text(((((total_venta +(total_articulo_compra - total_articulo_vendido) * precio))  -total_compra)/total_articulo_compra).toFixed(2)); 

        $("#porcentaje").text(((((total_venta +(total_articulo_compra - total_articulo_vendido) * precio))  -total_compra)/total_compra).toFixed(2)); 
    });
</script>
    @endsection
