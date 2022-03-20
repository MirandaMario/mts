@extends('layouts.admin')
@section('title','Edición Factura')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
<div class="row" >
    {!!Form::model($venta,['method'=>'PATCH','route'=>['venta.update',$venta->idventa],
    'autocomplete'=>'off', 'id' =>'mf'])!!}
    {{Form::token()}}
    <div style=" padding: 0px 20px 0px 20px;">
        @include('ventas.venta.partial.parametros_venta')
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:120%; height: 40px; background-color:#ACB0B0 ;">
                EDICION&nbsp;&nbsp;&nbsp;&nbsp;TICKET&nbsp;&nbsp;&nbsp;&nbsp;{{$venta->num_comprobante}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date('d-m-Y H:i')}}
            </div>
            <div class="panel-body fixed-panel2">
                @include('ventas.venta.partial.comun_ticket')
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <br>
                        <div class="form-group tetx-right">

                            <button class="btn btn-warning btn-sm m-t-10"
                                onclick="javascript: check();">ACTUALIZAR</button>
                            <a href="{{ url('/venta') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
   
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-body fixed-panel pa">
                <div>
                    @php $con = 0; $t = 0; $sutotal = array(); @endphp
                    <table id="detalles" class="table table-bordered table-condensed" style="font-size:100%;">
                        <thead style="background-color: #A9D0F5;">
                            <th class="text-left" width="5%">-</th>
                            <th class="text-left" width="68%">Artículo</th>
                            <th class="text-center" class="text-center" width="5%">Can.</th>
                            <th class="text-right" width="5%">Des/U</th>
                            <th class="text-right" width="5%">Pre/U</th>
                            <th class="text-right" width="12%">Subtotal</th>
                        </thead>

                        @foreach ($detalles as $det)
                        <tr class="selected" id="fila{{$con}}">
                            <td class="text-center"><button type="button" class="btn btn-warning btn-xs" onclick="eliminar({{$con}});">x</button></td>
                            <td>{{$det->nombreMarca}} {{$det->nombreModelo}} {{$det->articulo}}  </td>
                            <td class="text-center"><input style="width: 100%" size="1" name="cantidad[]"     class="outlinenone" value="{{$det->cantidad}}" readonly></td>
                            <td class="text-center"><input style="width: 100%" size="1" name="descuentou[]"   class="outlinenone" value="{{$det->descuento}}" readonly></td>
                            <td class="text-right"> <input style="width: 100%" size="1" name="precio_lista[]" class="outlinenone" value="{{$det->precio_lista}}" readonly></td>
                            <td class="text-right"> {{number_format($det->cantidad*$det->precio_venta,2)}}{{$det->impuesto == 0 ?  'E' :  'G'}}</td>
                            <input type="hidden" name="idarticulo[]" value="{{$det->idarticulo}}">
                            <input type="hidden" name="precio_venta[]" value="{{$det->precio_venta}}">
                            <input type="hidden" name="impuesto[]" value="{{$det->impuesto}}">
                            <input type="hidden" name="impuesto2[]" value="{{$det->impuestodos}}">
                            <input type="hidden" name="beneficio[]" value="{{$det->beneficio}}">
                        </tr>
                        @php $con++; 
                            $sut= $det->cantidad*$det->precio_venta;
                            $sutotal[]= $sut;
                            $t += $sut;
                        @endphp
                        @endforeach
                        <input type="hidden" id="tipomov" value="1" />
                </div>
            </div>
        </div>
    </div> 


{!!Form::close()!!}
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
{{-- <script src="{{asset('js/venta/helper.js')}}"></script> --}}
<script src="{{asset('js/venta/agregar_eliminar_ticket.js')}}"></script>
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

    var cont='<?php echo $con;?>';
    var tota='<?php echo $t;?>';
    var total =  Math.round(tota*100)/100
    var subtotal=<?php echo json_encode($sutotal);?>;
    $("#total_venta").val(total); 

</script>
@endsection
{{--354--}}