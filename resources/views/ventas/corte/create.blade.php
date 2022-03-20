@extends('layouts.admin')
@section('title','Corte Creacion')
@section('contenido')
<style type="text/css">
    .pa {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<div id="muestra">
    <div class="row pa" >
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
            @endif
            <br>
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%">
                <thead>
                    <tr>
                        <th HEIGHT="25" class="text-left" align="left" width="5%"># </th>
                        <th class="text-center" align="center" width="10%">Fecha </th>
                        <th class="text-left" align="center" width="60%">Cliente </th>
                        <th align="left" width="15%">Comprobante</th>
                        <th align="left" width="15%">Número</th>
                        <th class="text-right" align="right" width="10%">Total </th>
                    </tr>

                </thead>
                <tbody>
                    @php $i2 = 0; $i = 1; @endphp
                    @foreach($ventas as $ven)
                    <tr>
                        <td class="text-left" align="left">{{$i++}}</td>
                        <td class="text-center" align="center">{{date('d/m/y' , strtotime($ven->fecha_hora))}}</td>
                        <td class="text-left" align="left">{{$ven->nombre}}</td>
                        <td class="text-left" align="left">{{$ven->tipo_comprobante}}</td>
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
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>SUMAS $</th>
                    <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}</th>
                </tr>
            </table>
            <br>
        </div>
    </div>
</div>
<div >
    <div class="row pa" >
        <div class="panel panel-primary pa ">
            {!!Form::open(array('url'=>'corte','method'=>'POST','autocomplete'=>'off', 'id' =>'mf'))!!}
            {{Form::token()}}
            <div class="row">
                <br>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                    <table class="table table-condensed table-striped" style="font-size:12px;">
                        @php
                           
                            $ex = $exenta->exentas; 
                            $ex == null ? $ex = 0 :  $ex = $ex; 

                            $de = $devolucion->devolucion; 
                            $de == null ? $de = 0 :  $de = $de; 
                        @endphp
                        <tr>
                            <td>Gravadas :</td>
                            <td><input type="text" name="gravadas" class="form-control input-sm pa" step="0.01"
                                    value="{{$gravadas}}" readonly> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Exentas :</td>
                            <td><input type="text" name="exentas" class="form-control input-sm pa" step="0.01"
                                    value="{{$ex}}" readonly></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Devolución :</td>
                            <td><input type="text" name="devolucion" class="form-control input-sm pa" step="0.01"
                                    value="{{$de}}" readonly></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td> Total Devoluciones :</td>
                            <td><input type="text" name="cantidad_devoluciones" class="form-control input-sm pa" step="0.01"
                                    value="{{$devolucion->cantidad_devoluciones}}" readonly></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Ticket :</td>
                            <td>desde <input name="desde" class="form-control input-sm pa" value="{{$resumen->menor}}"
                                    readonly></td>
                            <td>hasta <input name="hasta" class="form-control input-sm pa" value="{{$resumen->mayor}}"
                                    readonly> </td>
                        </tr>
                     
                       
                    </table>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                    <table class="table table-condensed table-striped" style="font-size:12px;">
                        <tr>
                            <td>Cantidad Transacciones :</td>
                            <td><input type="text" name="cantidad_transacciones" class="form-control input-sm pa" 
                                    value="{{$i - 1}}" readonly> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Fecha :</td>
                            <td>desde <input name="fecha_desde" class="form-control input-sm pa"
                                    value="{{$request->fecha}}" readonly></td>
                            <td>hasta <input name="fecha_hasta" class="form-control input-sm pa"
                                    value="{{$request->fecha2}}" readonly> </td>
                        </tr>
                        <tr>
                            <td>Total de la venta :</td>
                            <td><input name="total_venta" class="form-control input-sm pa" step="0.01"
                                    value="{{$resumen->total_venta}}" readonly></td>
                            <td></td>
                        </tr>
               
                    </table>
                    <br>
                    <button class="btn btn-warning btn-sm m-t-10" {{-- onclick="javascript: check();" --}}>Guardar Corte
                        Como</button>
                    &nbsp;&nbsp;&nbsp;
                    <label class="radio-inline"><input type="radio" name="optradio" checked value="1">Diario</label>
                    <label class="radio-inline"><input type="radio" name="optradio" value="2">Parcial</label>
                    <label class="radio-inline"><input type="radio" name="optradio" value="3">Mensual</label>
                    <br><br>
                    <a class="imprimir" href="javascript:imprSelec('muestra')">IMPRIMIR DATOS ACTUALES</a>
                </div>
            </div>
        </div>
    </div>
</div>

{!!Form::close()!!}
<br>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>

@endsection


{{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa"> --}}
{{--     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa"> --}}
{{--  <img align="left" width="125" height="85" src="{{asset('imagenes/logo.jpg')}}"> --}}
{{--  <h4 align="center"> {{ config('constantes.COMPANY') }} </h4> --}}