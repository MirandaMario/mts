@extends('layouts.admin')
@section('title','Edición Factura')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">Edición Factura <u><b> ID #
                        {{$venta->idventa}}</b></u><span id="precios"></span> 
            </div>
            <div class="panel-body">
                {!!Form::model($venta,['method'=>'PATCH','route'=>['venta.update',$venta->idventa],
                'autocomplete'=>'off', 'id' =>'mf'])!!}
                {{Form::token()}}
                @include('ventas.venta.partial.comun_factura')
                @php $con = 0; $t = 0; $sutotal = array(); @endphp
                @foreach ($detalles as $det)
                <tr class="selected" id="fila{{$con}}">
                    <td class="text-center"><button type="button" class="btn btn-warning btn-xs"
                            onclick="eliminar({{$con}});">x</button></td>
                    <td>
                        <input type="text" style="width: 55%" name="des[]" class="outlinenone" value="{{$det->nombreMarca}} {{$det->nombreModelo}} {{$det->articulo}} ">&nbsp;
                        <input type="text" style="width: 44%" name="descripciondv[]" value="{{$det->descripciondv}}">
                        <input type="text" style="width: 21%" name="serie[]" value="{{$det->serie}}">
                        <input type="text" style="width: 34%" name="garantia[]" value="{{$det->garantia}}">
                        <input type="text" style="width: 44%" name="sobrenombre[]" value="{{$det->sobrenombre}}">
                    </td>
                    <td class="text-center"><input size="5" name="cantidad[]"       class="outlinenone"   value="{{$det->cantidad}}" readonly></td>
                    <td class="text-center"><input size="5" name="descuentou[]"     class="outlinenone"   value="{{$det->descuento}}" readonly></td>
                    <td class="text-right"> <input size="5" name="precio_lista[]"   class="outlinenone"   value="{{$det->precio_lista}}" readonly></td>
                    <td class="text-right">
                        {{number_format($det->cantidad*$det->precio_venta,2)}}{{$det->impuesto == 0 ?  'E' :  'G'}}</td>
                    <input type="hidden" name="idarticulo[]" value="{{$det->idarticulo}}">
                    <input type="hidden" name="precio_venta[]" value="{{$det->precio_venta}}">
                    <input type="hidden" name="impuesto[]" value="{{$det->impuesto}}">
                    <input type="hidden" name="impuesto2[]" value="{{$det->impuestodos}}">
                    <input type="hidden" name="beneficio[]" value="{{$det->beneficio}}">
                </tr>
                @php
                $sut= $det->cantidad*$det->precio_venta;
                $sutotal[]= $sut;
                $t += $sut;
                $con++
                @endphp
                @endforeach
                <input type="hidden" id="tipomov" value="1" />
                <tfoot>
                    <th colspan="4"></th>
                    <th><h5 class="text-right"><b>Total</b></h5></th>
                    <th><h5 type="hidden" class="text-right" id="sumas"></h5></th>
                </tfoot>
                </table>
            </div>
            <div class="form-group tetx-right">
                <button class="btn btn-warning btn-sm m-t-10" onclick="javascript: check();">ACTUALIZAR</button>
                <a href="{{ url('/venta') }}"><button class="btn btn-primary btn-sm m-t-10"
                        type="button">CANCELAR</button></a>
            </div>
        </div>
    </div>
    @include('ventas.venta.partial.parametros_venta')
{!!Form::close()!!}
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/venta/agregar_eliminar_factura.js')}}"></script>
<script>
    $("#ventabtn").css("background-color", "orange"); 
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

        $("#sumas").html('<?php echo $t;?>');
        sumas = ($("#sumas").text()*1);
        $('#total').text(Math.round(sumas*100)/100);
        $("#total_venta").val(sumas);
        });

    var cont='<?php echo $con;?>'*1;   
    var tota='<?php echo $t;?>'*1;
    var total =  Math.round(tota*100)/100
    var subtotal=<?php echo json_encode($sutotal);?>;
    $("#total_venta").val(total); 
</script>
@endsection