@extends('layouts.admin')
@section('title','Nueva Transferencia')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<style>
/*     .fixed-panel {
        height: 540px;
        overflow-y: scroll;
    }

    .fixed-panel2 {
        height: 500px
    } */

    .unselectable {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<div class="row" style=" {{ config('constantes.FONT') }}">
    {!!Form::open(array('url'=>'transferencia','method'=>'POST','autocomplete'=>'off', 'id' =>'mf'))!!}
    {{Form::token()}}
    <div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:125%; height: 40px;">
                    Tienda origen {{$request->get('idtienda')}} &nbsp;&nbsp;&nbsp;&nbsp;Destino
                    {{$request->get('idtienda2')}} &nbsp;&nbsp;&nbsp;&nbsp; 
                    <span class="text-right"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nota de envio </span>
                </div>

                <div class="panel-body fixed-panel2">
                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-md-10 col-xs-12 pa">
                            <div class="form-group">
                                <label for="inputEmail3" class="apa">Artículo </label>
                                <input type="text" id="articulo" class="form-control  input-sm pa"
                                    placeholder="Código, nombre producto ..." onclick="javascript: limpia(this);"
                                    onBlur="javascript: verifica(this);" autofocus>
                                <div id="ListaProductos" name="ListaProductos">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <label for="cantidad" class="apa">
                                 <a id="min" class="unselectable"><span   class="fa fa-minus-square" style=" font-size: 18px;" aria-hidden="true"></span>
                                    </a> &nbsp;&nbsp; Cant &nbsp;&nbsp;
                                    <a id="plus" class="unselectable"><span  id="plus" class="fa fa-plus-square" style=" font-size: 18px;" aria-hidden="true">
                                    </span></a></label> 
                            <div class="form-group">
                                <input type="number" id="pcantidad" name="pcantidad"  class="form-control input-sm text-center pa" value="1">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="inputEmail3" class="apa" id="ad2">Stock</label>
                                <input type="number" step="1" id="stock" class="form-control input-sm apa"
                                    placeholder="Stock">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">P. Venta </label>
                                <input id="pprecio_venta" class="form-control input-sm pa" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="precio_venta" class="apa">Código</label>
                                <input type="number" step="0.01" id="codigo_articulo" class="form-control input-sm"
                                    placeholder="Código" />
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="agregar">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" name="bt_add" id="bt_add" class="btn btn-primary ">
                                    AGREGAR ITEM
                                </button>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <div row>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div>
                                <img src="" id="imagen" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa ">
                            <div class="well">
                                <table>
                                    <th width="10%">
                                        <h4 class="text-right"> <b> Total Articulos </b> </h4>

                                    </th>
                                    <th width="10%">
                                        <h4 class="text-right" id="total">0</h4>
                                    </th>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                            <br>
                            <div class="form-group tetx-right">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <input type="hidden" id="idtienda" name="idtienda" value="{{$request->get('idtienda')}}">
                                <input type="hidden" id="idtienda2" name="idtienda2" value="{{$request->get('idtienda2')}}">
                                <input type="hidden" id="iva" value="{{$varios->iva}}">
                                <input type="hidden" id="cesc" value="{{$varios->cesc}}">
                                <input type="hidden" id="idcliente" value="1" />
                                <input type="hidden" id="num_comprobante" value="1" />
                                <button class="btn btn-success btn-sm m-t-10"
                                    onclick="javascript: check();">GUARDAR</button>
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
                <div class="panel-body fixed-panel">
                    <div>
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"
                            style="font-size:100%;">
                            <thead style="background-color: #A9D0F5;">
                                <th class="text-left" width="5%">-</th>
                                <th class="text-left">Artículo</th>
                                <th class="text-center" width="10%">Cantidad</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@endsection
@push('scripts')
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/venta/helper.js')}}"></script>


<script type="text/javascript">

    $("#transbtn").css({"color":"orange" , "font-size": "18px"});

  
        var cont=0;
        var total = 0; 
        var articulos=[]; 

    function agregar(){
        datosArticulo = $("#articulo").val().split('      ');
        idarticulo = datosArticulo[0];
        articulo = datosArticulo[0]+" "+datosArticulo[1] +" "+datosArticulo[2] +" "+datosArticulo[3];
        cantidad = $("#pcantidad").val() * 1;      
        stock = $("#stock").val() * 1;
        
        if(idarticulo!="" && cantidad!="" ){
            if(cantidad<=stock){
               
                articulos[cont] = cantidad; 
                total = total+articulos[cont];
                
                var fila = '<tr class="selected" id="fila'+cont
                +'"><td class="text-center"><button type="button" class="btn btn-warning btn-xs"  onclick="eliminar('+cont
                +');">x</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo
                +'"><input type="text" class="outlinenone" name="des[]"   size="39" value="'+articulo
                +'" readonly></td><td class="text-center"><input size="5"  class="outlinenone"  name="cantidad[]" value="'+cantidad
                +'" readonly></td></tr>';
                cont++;

                limpiar();
                total = Math.round(total*100)/100
                $("#total").html(total); 
                $("#codigo_articulo").focus();

                evaluar();
                $('#detalles').prepend(fila);
            }else{
                swal("Error", "La cantidad a transferir  supera el stock", "error");
            }
        }else{
            swal("Error", "Al ingresar el detalle de la transferencia, revise los datos del artículo", "error");
        }
    }

    function eliminar(index){
        total = total-articulos[index];
        $("#fila"+index).remove()
        $("#total").html(total); 

        evaluar();
    }

</script>
@endpush