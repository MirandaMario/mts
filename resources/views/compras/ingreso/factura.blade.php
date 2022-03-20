@extends('layouts.admin')
@section('title','Factura')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
{{--  @include('partial.error')  --}}
<div class="row">
    @if (isset($ingreso))
    {!!Form::model($ingreso,['method'=>'PATCH','route'=>['ingreso.update',$ingreso->idingreso],
    'autocomplete' => 'off', 'id' =>'mf'])!!}
    <input type="hidden" id="tipomov" value="1" />           
    @else
    {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocomplete'=>'off', 'id' =>'mf'))!!}
    @endif

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                @if (isset($ingreso))
                Editar datos de compra <u><b>Factura con ID # {{$ingreso->idingreso}}</b></u>
                @else
                Ingresar <b>FACTURA</b>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('ingreso.create', ['id' =>  2])}}">
                    <button class="btn btn-warning  btv navbar-right" type="button">CCF</button></a>
                @endif
            </div>

            {{Form::token()}}
            <div class="panel-body fixed-panel2">
                @include('compras.ingreso.partial.comun_form')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                        <div>
                            <img src="" id="imagen_ingreso" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar"
                        style=" {{isset($ingreso)? : 'display: none;'}}">
                        <div class="form-group text-right">
                            <input name="_token" value="{{csrf_token()}}" type="hidden" />
                            <button class="btn btn-success btn-sm m-t-10" type="submit"  id="btnt" onclick="javascript: check_ingreso();">
                                {{isset($ingreso)? 'ACTUALIZAR' : 'GUARDAR'}}
                            </button>
                            <a href="{{ url('/ingreso') }}"><button class="btn btn-primary btn-sm m-t-10"
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
                    <div class="table-responsive">
                        <table id="detalles" class="table table-bordered table-condensed" style="font-size:90%;">
                            <thead style="background-color: #96dff6;">
                                <th class="text-center" width="5%">Opciones</th>
                                <th class="text-left"   width="35%">Artículos</th>
                                <th class="text-center" width="10%">Cant.</th>
                                <th class="text-right"  width="10%">Precio</th>
                                <th class="text-right"  width="10%">Subtotal</th>
                            </thead>

                            @if (isset($ingreso))
                            @php $con = 0; $t = 0; $sutotal = array(); @endphp
                            @foreach ($detalles as $det)
                            <tr class="selected" id="fila{{$con}}">
                                <td class="text-center"><button type="button" class="btn btn-warning btn-xs"
                                        onclick="eliminar({{$con}});">x</button></td>
                                <td><input class="outlinenone" type="hidden" name="idarticulo[]"
                                        value="{{$det->idarticulo}}">
                                        
                                        <input type="hidden" name="fecha_fac[]" value="{{$det->fecha_fac}}">
                                        <input type="hidden" name="fecha_ven[]" value="{{$det->fecha_ven}}">
                                        <input type="hidden" name="lote[]"      value="{{$det->lote}}">




                                        {{$det->articulo}} {{$det->fecha_fac}} {{$det->fecha_ven}}  {{$det->lote}}</td>
                                <td class="text-center"><input class="outlinenone" size="5" name="cantidad[]"
                                        value="{{$det->cantidad}}" readonly></td>
                                <td class="text-right"><input class="outlinenone" size="5" name="precio_compra[]"
                                        value="{{$det->precio_compra}}" readonly></td>
                                <td class="text-right">{{number_format($det->cantidad*$det->precio_compra,2)}}</td>
                                @php
                                $t += $det->cantidad*$det->precio_compra;
                                $sutotal[]= $det->cantidad*$det->precio_compra;
                                $con++;
                                @endphp
                            </tr>
                            @endforeach

                            @else
                            @php $con =0; $t =0; $sutotal = array(); @endphp
                            @endif
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h5 class="text-right" width="10%"><b> TOTAL</b></h5> </th>
                                <th><h5 class="text-right" width="10%" id="total"><b>$ 0.00</b></h5> </th>     
                            </tfoot>
                        </table>
                    </div>
                    <input type="hidden" id="total_compra" name="total_compra">
                    <input type="hidden" id="tipo_comprobante" name="tipo_comprobante" value="FACTURA">
                </div>
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

<script> 
    $(document).ready(function(){
        $("#compra").css("background-color", "orange"); 
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
        });
</script>
{{-- <script src="{{asset('js/jquery.dataTables.min.js')}}"></script> --}}
<script src="{{asset('js/ingreso/helper.js')}}"></script>
<script src="{{asset('js/ingreso/agregar_factura.js')}}"></script>
<script type="text/javascript">
    var cont = '<?php echo $con;?>';
    var tota = '<?php echo $t;?>';
    var total = Math.round(tota * 100) / 100
    var subtotal1 = 0;
    var subtotal = <?php echo json_encode($sutotal); ?> ;

    $("#total").html("$ " + '<?php echo $t;?>');
    $("#total_compra").val(total);

</script>
@endsection