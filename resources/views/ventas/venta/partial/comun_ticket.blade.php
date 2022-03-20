<div class="row">
    <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Cliente</label></b></div>
                <input type="text" name="cliente" id="empresa" class="form-control"
                    placeholder="Ingrese cliente ..."
                    required value="{{isset($venta->nombre) ?  $venta->nombre : "Cliente General"}}"> 
                <input type="hidden" name="idcliente" id="idcliente"  value="{{isset($venta->idpersona) ? $venta->idpersona : "1"}}" class="form-control" />
                <input type="hidden" name="idventa" id="idventa" value="{{isset($venta->idventa) ?  $venta->idventa : ""}}" class="form-control" />
            </div>
            <div id="ListaClientes">
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-sm-10 col-md-10 col-xs-12 pa">
        <div class="form-group">
            <label for="inputEmail3" class="apa">Artículo </label>
            <input type="text" id="articulo" class="form-control  input-sm pa" placeholder="Código, nombre producto ..."
                onclick="javascript: limpia(this);" onBlur="javascript: verifica(this);" autofocus>
                <div id="gitarticulo" style="position: absolute; "></div>
            <div id="ListaProductos" name="ListaProductos">
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-1 col-md-2 col-xs-12 pa">
        <div class="form-group">
            <label for="cantidad" class="apa">Cantidad</label>
            <input type="number" id="cantidad" class="form-control input-sm text-center" value="1">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
        <div class="form-group">
            <label class="apa" id="ad2">Stock</label>
            <input type="number" step="1" id="stock" class="form-control input-lg pa" style="font-size: 30px  !important;">
        </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
        <div class="form-group">
            <label class="apa">PLista </label>
            <input type="text" id="precio_lista" class="form-control  input-lg pa" step="0.01" style="font-size: 30px; color: #00FF00; background-color: black; ">
        </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
        <div class="form-group">
            <label class="apa">Dto/U</label>
            <input type="number" step="1" id="descuentou" class="form-control input-lg " value="0" />
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <div class="form-group">
            <label class="apa">PCDesc. </label>
            <input type="text" id="precio_venta" class="form-control input-lg" step="0.01"  style="font-size: 40px  !important;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <div class="form-group">
            <label for="precio_venta" class="apa">Código</label>
            <input type="number" step="0.01" id="codigo_articulo" class="form-control input-lg" placeholder="Código"  style="font-size: 30px;"/>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <label for="agregar">&nbsp;</label>
        <div class="form-group">
            <button type="button" name="bt_add" id="bt_add" class="btn btn-primary btn-lg btn-block">
                AGREGAR ITEM
            </button>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <div>
            <img src="" id="imagen" class="img-fluid">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa ">
        <div class="well">
            <table>
                <th width="15%">
                   {{--  <select name="tipo_pago" class="form-control apa">
                        <option value="1" selected>EFECTIVO</option>
                        <option value="2">TARJETA</option>
                        <option value="3">TRANSFERENCIA</option>
                    </select> --}}
                    <h4 class="text-right">SUMAS</h4>
                    <input type="hidden" id="descuento" name="descuento" value="0" />
                    <h4 class="text-right"> Total</h4>
                    <h4 class="text-right">IMPORTE</h4>
                    <h4 class="text-right">CAMBIO</h4>
                </th>
                <th width="10%">
                   {{--  <h4 class="text-right">---</h4> --}}
                    <h4 class="text-right" id="sumas">0.00</h4>
                    <h4 class="text-right" id="total">0.00</h4>
                    <h4 class="text-right"><input size="5" class="outlinenone" id="efectivo" /></h4>
                    <h4 class="text-right" id="cambio">0.00 </h4>
                </th>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="_token" value="{{csrf_token()}}" />
{{-- <input type="hidden" name="idcliente" id="idcliente" value="1" /> --}}

<input type="hidden" name="num_comprobante" id="num_comprobante" value="{{isset( $venta->num_comprobante ) ? $venta->num_comprobante :$tienda->ticket}}" />
<input type="hidden" name="tipo_comprobante" value="1" />
<input type="hidden" name="check_in" value="{{date('Y-m-d H:i')}}">
<input type="hidden" name="total_venta" id="total_venta">
<input type="hidden" name="id_tienda" id="idtienda" value="{{auth()->user()->id_tienda }}">
<input type="hidden" id="impuesto">
<input type="hidden" id="impuestodos">
<input type="hidden" id="beneficio">
<input type="hidden" name="iva" id="iva" value="{{$varios->iva}}">
<input type="hidden" name="cesc" id="cesc" value="{{$varios->cesc}}">
<input type="hidden" name="idresolucion" value="{{ isset($tienda->id_resolucion) ? $tienda->id_resolucion  : "" }}">