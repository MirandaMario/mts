@extends('layouts.admin')
@section('title','Compra CCF')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row" >
    @if (isset($ingreso))
    {!!Form::model($ingreso,['method'=>'PATCH','route'=>['ingreso.update',$ingreso->idingreso],
                'autocomplete' => 'off', 'id' =>'mf', 'files'=>'true'])!!}
    <input type="hidden" id="tipomov" value="1" />            
    @else
    {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocomplete'=>'off', 'id' =>'mf','files'=>'true'))!!}
    @endif
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                @if (isset($ingreso))
                Editar datos de compra <u><b>CCF con ID # {{$ingreso->idingreso}}</b></u>
                @else
                Ingresar <b>CCF</b>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('ingreso.create', ['id' =>  1])}}">
                    <button class="btn btn-warning  btv navbar-right" type="button">Factura</button></a>
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
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <div class="input-group">
                                <b><label class="a">Retencion:</label></b>
                                    <input type="number" step="0.01" class="form-control" value="{{isset($ingreso->retencion) ?  $ingreso->retencion : '0.00'}}" name="retencion"class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label class="apa">Fuente &nbsp;&nbsp;&nbsp;&nbsp; </label>
                            <select name="fuente"  class="form-control">

                                @isset($ingreso)
                                <option value="1" {{$ingreso->fuente == 1 ? 'selected' : ''}} > 1 </option>
                                <option value="2" {{$ingreso->fuente == 2 ? 'selected' : ''}} > 2 </option> 
                                @else    
                                <option value="1" selected > 1 </option>
                                <option value="2"> 2 </option>
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  {{-- id="guardar"
                        style=" {{isset($ingreso)? : 'display: none;'}}" --}}>
                        <div class="form-group text-right">
                            <input name="_token" value="{{csrf_token()}}" type="hidden" />
                            <button class="btn btn-success btn-sm m-t-10" type="submit" id="btnt" onclick="javascript: check_ingreso();">
                                {{isset($ingreso)? 'ACTUALIZAR' : 'GUARDAR'}}
                            </button>
                            <a href="{{ url('/ingreso') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                        <div>
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                        <label for="documento" class="apa">Documento CCF</label>
                        <input type="file" name="documento" class="custom-file-input"  />
                        @isset($ingreso)
                        <input type="text" name="hoja_original" class="in form-control" value="{{$ingreso->documento}}"> 
                        @endisset
                       
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
                                <th class="text-left" width="35%">Artículos</th>
                                <th class="text-center" width="10%">Cantidad</th>
                                <th class="text-right" width="10%">P Compra</th>
                                <th class="text-right" width="10%">Subtotal</th>
                            </thead>

                            @if (isset($ingreso))
                            @php $con = 0; $t = 0; @endphp
                            @foreach ($detalles as $det)
                            <tr class="selected" id="fila{{$con}}">
                                <td class="text-center"><button type="button" class="btn btn-warning btn-xs"  onclick="eliminar({{$con}});">x</button></td>
                                <td>                    <input class="outlinenone" type="hidden" name="idarticulo[]" value="{{$det->idarticulo}}">
                                                        <input type="hidden" name="fecha_fac[]" value="{{$det->fecha_fac}}">
                                                        <input type="hidden" name="fecha_ven[]" value="{{$det->fecha_ven}}">
                                                        <input type="hidden" name="lote[]"      value="{{$det->lote}}">
                                    
                                    
                                     {{$det->articulo}} {{$det->fecha_fac}} {{$det->fecha_ven}}  {{$det->lote}}</td>
                                <td class="text-center"><input class="outlinenone" size="5" name="cantidad[]"        value="{{$det->cantidad}}" readonly></td>
                                <td class="text-right"> <input class="outlinenone" size="5" name="precio_compra[]"   value="{{$det->precio_compra}}" readonly></td>
                                <td class="text-right">{{number_format($det->cantidad*$det->precio_compra,2, '.', ',')}}
                                </td>
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
                                <th><h5 class="text-right"><b>SUMAS</b></h5>
                                    <h5 class="text-right"><b>IVA</b></h5>
                                    <h5 class="text-right"><b>Total</b></h5> </th>
                                <th><h5 class="text-right" id="total"><b>$ 0.00</b></h5>                        
                                    <h5 class="text-right" id="iva"><b>$ 0.00</b></h5>
                                    <h5 class="text-right" id="totalf"><b>$ 0.00</b></h5></th>                 
                            </tfoot>
                        </table>
                    </div>
                        <input type="hidden" id="total_compra" name="total_compra">
                        <input type="hidden" id="tipo_comprobante" name="tipo_comprobante"  value="CCF" >
                </div>
            </div>
        </div>
        **Los precios deben de ser ingresados sin IVA, el IVA se agregará automaticamente
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/ingreso/helper.js')}}"></script>
<script src="{{asset('js/ingreso/agregar_ccf.js')}}"></script>

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
        $("#compra").css("background-color", "orange");    
        });
</script>

<script>
    var tota=<?php echo $t;?>;
    var iva = tota*0.13;
    var total_compra = (tota * 1 )+ iva;
    $("#total").html(tota);
    $('#iva').text(Math.round(iva*100)/100);
    $('#totalf').text(Math.round(total_compra*100)/100);
    $("#total_compra").val(tota + iva);

    var subtotal=<?php echo json_encode($sutotal);?>;
    var tota='<?php echo $t;?>';
    var total =  Math.round(tota*100)/100;
    var cont='<?php echo $con;?>';

    
</script>

@endsection