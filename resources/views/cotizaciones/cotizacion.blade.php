@extends('layouts.admin')
@section('title','Cotización')
@section('contenido')
@include('ventas.cliente.create_modal')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row">
    @if ($id2 == 1)
        {!!Form::open(array('url'=>'cotizacion','method'=>'POST','autocomplete'=>'off' , 'id' =>'mf'))!!}
    @else
        @if (isset($venta))
        {!!Form::model($venta,['method'=>'PATCH','route'=>['cotizacion.update',$venta->idCotizacion],'autocomplete' => 'off', 'id' =>'mf'])!!}
        @else
        {!!Form::open(array('url'=>'cotizacion','method'=>'POST','autocomplete'=>'off' , 'id' =>'mf'))!!}
        @endif
    @endif
        
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                @if ($id2 == 1)
                    GENERACION DE VENTA A PARTIR DE LA COTIZACION   N°  {{$venta->numeroComprobante}}
                @else
                    {{ isset($venta) ? "Editar cotización N° $venta->numeroComprobante" :  "Nueva Cotización N° $control->cotizacion"}}
                @endif                
            </div>
            {{Form::token()}}
            <div class="panel-body">
                @include('cotizaciones.comun')
            <div class="row pa">
                <table id="detalles" class="table  table-bordered  table-condensed" style="font-size:100%;">
                    <thead style="background-color: #A9D0F5;">
                        <th class="text-left" width="3%">***</th>
                        <th class="text-left" width="77%">Artículo</th>
                        <th class="text-center" width="5%">Cant.</th>
                        <th class="text-right" width="5%">D/Unit.</th>
                        <th class="text-right" width="8%">Precio</th>
                        <th class="text-right" width="8%">Subtotal</th>
                    </thead>

                    @if (isset($venta))
                        @php $con = 0; $t = 0; @endphp
                    @foreach ($detalles as $det)
                    <tr class="selected" id="fila{{$con}}">
                        <td class="text-center"><button type="button" class="btn btn-warning btn-xs" onclick="eliminar({{$con}});">x</button></td>
                        <td>
                            <input type="text"  style="width: 55%" name="des[]" class="outlinenone" value=" {{$det->idArticulo}} {{$det->nombreMarca}} {{$det->nombreModelo}} {{$det->articulo}} ">
                            <input type="text"  style="width: 44%" name="descripciondc[]" value="{{$det->descripciondc}}">
                            <input type="text"  style="width: 44%" name="garantiadc[]"    value="{{$det->garantiadc}}">
                            <input type="hidden"  name="idarticulo[]" value="{{$det->idArticulo}}">
                        </td>
                        <td class="text-center"><input size="3" class="outlinenone" name="cantidad[]" value="{{$det->cantidad}}" readonly></td>
                        <td class="text-center"><input size="5" class="outlinenone" name="descuentou[]" value="{{$det->descuento}}" readonly></td>
                        <td class="text-right"><input size="5" class="outlinenone" name="precio_lista[]" value="{{$det->precio_lista}}" readonly>
                            <input type="hidden" name="precio_venta[]" value="{{$det->precioVenta}}">
                            <input type="hidden" name="beneficio[]" value="{{$det->beneficio}}">
                        </td>
                        @php
                            $sut= ($det->precio_lista - ($det->precio_lista * ($det->descuento / 100))) * $det->cantidad;
                            $sutotal[]= $sut;
                            $t += $sut;
                            $con++;
                        @endphp
                        <td class="text-right">{{number_format($sut,2)}}</td>
                    </tr>
                    @endforeach

                    @else
                        @php $con =0; $t =0; $sutotal = array(); @endphp
                    @endif

                    <tfoot>
                        <th colspan="4"></th>
                        <th>
                            <h4 class="text-right"><b>Total</b></h4>
                        </th>
                        <th>
                            <h4 class="text-right" id="total"><b>$ 0.00</b></h4>
                            <input type="hidden" name="total_venta" id="total_venta">
                        </th>
                    </tfoot>
                </table>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  
                    <div class="form-group text-right">
                        <input name="_token" value="{{csrf_token()}}" type="hidden" />
                        @if (isset($venta))
                            <button class="btn btn-success btn-sm m-t-10 type=" onclick="javascript:check_cotizacion2();" id="enviar">
                                {{ $id2 == 1  ? "GENERAR VENTA" :  "ACTUALIZAR"}} 
                            </button>
                            <a href="{{ url('/cotizacion') }}"><button class="btn btn-primary btn-sm m-t-10"  type="button">CANCELAR</button></a>
                        @else
                            <button class="btn btn-success btn-sm m-t-10 type=" onclick="javascript:check_cotizacion();" id="enviar">GUARDAR</button>
                            <a href="{{ url('/cotizacion') }}"><button class="btn btn-primary btn-sm m-t-10" type="button">CANCELAR</button></a>
                        @endif

                        <input type="hidden" id="idtienda" name="idtienda" value="{{auth()->user()->id_tienda}}">
                        <input type="hidden" name="iva" id="iva" value="{{$varios->iva}}">
                        <input type="hidden" name="cesc" id="cesc" value="{{$varios->cesc}}">
                        <input type="hidden" id="impuesto">
                        <input type="hidden" id="impuestodos">
                        <input type="hidden" id="beneficio">
                        <input type="hidden" name="num_comprobante" id="num_comprobante" value="{{isset($venta) ?  $venta->numeroComprobante :  $control->cotizacion}}" />
                        <input type="hidden" name="id2"  id="id2" value="{{isset($id2) ?  $id2 :  ''}}" />
                    </div>
                </div>
            @if($id2 == 1)
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
                    @include('ventas.venta.partial.parametros_venta')
                    <br>
                </div>
            @endif
                

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Descripción</b></label><br><span
                                id="contadorTaComentario">0/400 </span></div>
                        <textarea type="text" name="descripcion" id="taComentario" class="form-control"
                            placeholder="Informacion adicional cotizacion ..." onBlur="javascript: verifica(this);"
                            maxlength="1000" required > {{isset($venta) ?  $venta->descripcion : old('descripcion')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a"> Notas</label></b><BR> <span
                                id="contadorTaComentario2">0/180 </span></div>
                        <textarea type="text" name="nota" id="taComentario2" rows="3" cols="" class="form-control"
                            maxlength="200" placeholder="Precio establecido por cantidades..." autofocus> {{isset($venta) ?  $venta->nota : old('nota')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
   
</div>

    {!!Form::close()!!}


    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            $('#mf').keypress(function(e){   
        if(e == 13){
          return false;
        }
      });
    
      $('input').keypress(function(e){
        if(e.which == 13){
          return false;
        }
      });
        $("#cot").css("color", "orange");
    });
    </script>
<script>
    CKEDITOR.replace( 'descripcion', { customConfig: '{{asset('js/myconfig.js')}}' } );
 
</script>

    <script type="text/javascript">
        var cont='<?php echo $con;?>';
    var tota='<?php echo $t;?>'*1;
    var subtotal=<?php echo json_encode($sutotal);?>;  
    total = Math.round(tota * 100) / 100  
    </script>
<script src="{{asset('js/cotizacion/agregar.js')}}"></script>
@endsection