@extends('layouts.admin')
@section('title','Detalle Compra')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Detalle de compra
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="table-responsive">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table class="table table-condensed table-responsive table-striped"
                                style="font-size:100%; width:100%;">
                                <tr>
                                    <td width="7%">PROVEEDOR</td>
                                    <td><b>{{$ingreso->nombre}}</b> </td>
                                </tr>
                                <tr>
                                    <td>TIPO</td>
                                    <td><b>{{$ingreso->tipo_comprobante}}</b></td>
                                </tr>
                                <tr>
                                    <td>NUMERO </td>
                                    <td><b>{{$ingreso->num_comprobante}}</b></td>
                                </tr>
                                <tr>
                                    <td>FECHA</td>
                                    <td><b>{{date('d-m-Y', strtotime ($ingreso->fecha))}}</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                        <div class="table-responsive">
                            <table class="table table-bordered-striper table-hover table-responsive table-striped"
                                 style="font-size:100%; width:100%;">
                                <thead style="background-color: #A9D0F5;">
                                    <th class="text-center" width="5%">Cantidad</th>
                                    <th class="text-left"   width="35%">Artículos</th>
                                    <th>FAC</th>
                                    <th>VEN</th>
                                    <th>LOT</th>
                                    <th class="text-right"  width="10%">Precio Compra</th>
                                    <th class="text-right"  width="10%">Subtotal</th>
                                </thead>

                                <tbody>
                                    @foreach($detalles as $det)
                                    <tr>
                                        <td class="text-center">{{$det->cantidad}}     </td>
                                        <td class="text-left"   width="35%">{{$det->articulo . " " . $det->nombreModelo }}</td>
                                        <td>{{$det->fecha_fac}}</td>
                                        <td>{{$det->fecha_ven}}</td>
                                        <td>{{$det->lote}}</td>
                                        <td class="text-right"  width="10%">$ {{number_format($det->precio_compra, 2, '.', ',')}}</td>
                                        <td class="text-right"  width="10%">
                                            ${{number_format($det->cantidad*$det->precio_compra, 2, '.', ',')}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @if ($ingreso->tipo_comprobante == "CCF")
                                    <th><h4 class="text-right">SUMAS $<br></h4>
                                        <h4 class="text-right">IVA $<br></h4>
                                        <h4 class="text-right">RETENCION $</h4>
                                        <h4 class="text-right">TOTAL $</h4></th>                                      
                                    <th><h4 class="text-right">{{$ingreso->total}}<br>
                                        <h4 class="text-right">{{number_format($ingreso->total* $varios->iva, 2)}}</h4>
                                        <h4 class="text-right">{{number_format($ingreso->retencion, 2)}}</h4>
                                        <h4 class="text-right">{{number_format(($ingreso->total*$varios->iva)+$ingreso->total + $ingreso->retencion, 2)}}</h4><br></th>                                                                                           
                                @else
                                    <th><h4 class="text-right">TOTAL $</h4></th>
                                    <th><h4 class="text-right">{{number_format($ingreso->total, 2, '.', ',')}} </th>                                                                                                                
                                 @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script> 
    $(document).ready(function(){
        $("#compra").css("background-color", "orange");    
        });
</script>

@endsection
