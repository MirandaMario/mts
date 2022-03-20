@extends('layouts.admin')
@section('title','Edición CCF')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
<div class="row" style=" {{ config('constantes.FONT') }}">
    <div class="col-md-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Edición de CCF con <u><b> ID # {{$venta->idventa}}</b></u><span id="precios"></span> 
            </div>
            <div class="panel-body">
                {!!Form::model($venta,['method'=>'PATCH','route'=>['venta.update',$venta->idventa],  'autocomplete' => 'off', 'id' =>'mf'])!!}
                {{Form::token()}}
                        @include('ventas.venta.partial.comun_factura')
  
                                @php $con = 0; $sumas = 0 ;   @endphp
                                @foreach ($detalles as $det)

                                <tr class="selected" id="fila{{$con}}">
                                    @php
                                    $psid = ($det->precio_lista - ($det->precio_lista* ($det->descuento/100)))/1.13; 
                                    $sumas += $det->cantidad*$psid;
                                    $sutotal[]= $det->cantidad*$psid;
                                    @endphp
                                    <td class="text-center"><button type="button" class="btn btn-warning btn-xs" onclick="eliminar({{$con}});">x</button></td>
                                    <td>
                                        <input type="text"  style="width: 55%" name="des[]" class="outlinenone" value="{{$det->nombreMarca}} {{$det->nombreModelo}} {{$det->articulo}} ">
                                        <input type="text"  style="width: 44%" name="descripciondv[]" value="{{$det->descripciondv}}">
                                        <input type="text"  style="width: 22%" name="serie[]" value="{{$det->serie}}">
                                        <input type="text"  style="width: 22%" name="garantia[]" value="{{$det->garantia}}">
                                    </td> 
                                    <td class="text-center"><input size="5" class="outlinenone"  name="cantidad[]"       value="{{$det->cantidad}}" readonly></td>
                                    <td class="text-center"><input size="5" class="outlinenone"  name="descuentou[]"     value="{{$det->descuento}}" readonly></td>
                                    <td class="text-right"><input size="5"  class="outlinenone"   value="{{number_format($psid,2)}}" readonly>
                                        <input type="hidden" name="idarticulo[]"   value="{{$det->idarticulo}}">
                                        <input type="hidden" name="precio_venta[]" value="{{$det->precio_lista-($det->precio_lista* ($det->descuento/100))}}"></td>
                                        <input type="hidden" name="precio_lista[]" value="{{$det->precio_lista}}">
                                        <input type="hidden" name="impuesto[]"     value="{{$det->impuesto}}">
                                        <input type="hidden" name="impuesto2[]"    value="{{$det->impuestodos}}">
                                        <input type="hidden" name="beneficio[]"    value="{{$det->beneficio}}">
                                    </td>
                                    <td class="text-right">{{number_format($det->cantidad*$psid,2)}}</td>
                                    @php $con++; @endphp
                                </tr>
                                @endforeach
                                <tfoot>
                                    <th colspan="4"></th>
                                    <th>
                                        <h5 class="text-right"><b>Sumas</b></h5>
                                        <h5 class="text-right"><b>IVA</b></h5>
                                        <h5 class="text-right"><b>Total</b></h5>
                                    </th>
                                    <th>
                                        <h5 class="text-right"><b>{{number_format($sumas,2)}}</b></h5>
                                        <h5 class="text-right" id="ivav"><b>{{number_format(($sumas*$varios->iva),2)}}</b></h5>
                                        <h5 class="text-right" id="total"><b>{{number_format($sumas+($sumas*$varios->iva),2)}}</b></h5>
                                        <input type="hidden" name="tipo_comprobante" value="3" />
                                        <input type="hidden" id="tipomov" value="1" />
                                        <input type="hidden" id="sumas" value="{{number_format($sumas, 2, '.', '')}}" />
                                    </th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
                        <div class="form-group">
                            <input name="_token" value="{{csrf_token()}}" type="hidden" />
                            <button class="btn btn-warning btn-sm m-t-10"  onclick="javascript: check();">ACTUALIZAR</button>
                            <a href="{{ url('/venta') }}"><button class="btn btn-primary btn-sm m-t-10" type="button">CANCELAR</button></a>
                        </div>
                    </div>
        </div>
    @include('ventas.venta.partial.parametros_venta')
</div>  
 
{!!Form::close()!!}

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
{{-- <script src="{{asset('js/venta/helper.js')}}"></script> --}}
<script src="{{asset('js/venta/agregar_eliminar_ccf.js')}}"></script>
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
       
        sumas = ($("#sumas").val()*1);
        var tf = dosDecimales(sumas * 1.13)
        $("#total_venta").val(tf);
       
    });
    
    var cont='<?php echo $con ;?>' * 1;
    var tota='<?php echo $sumas;?>';
    var total =  Math.round(tota*100)/100
    var subtotal=<?php echo json_encode($sutotal);?>;

    $("#total_venta").val(total);

</script>
@endsection