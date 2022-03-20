<div class="row">
    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Cliente <a href="" data-target="#form_cliente_create_modal" data-toggle="modal">++</a></label></b></div>
                <input type="text" id="cliente" name = "nom_cliente" class="form-control" placeholder="Ingrese cliente ..." autofocus
                    required value="{{isset($venta) ?  $venta->nombre : old('nom_cliente')}}"/>
                <input type="hidden" name="idcliente" id="idcliente" value="{{isset($venta) ?  $venta->idpersona : old('idcliente')}}"
                    class="form-control" />
            </div>
            <div id="ListaClientes"></div>
        </div>
       
    </div>
   
    <div class="col-lg-2 col-sm-12 col-md-12 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Dirigido</label></b></div>
                <input type="text" name="dirigido" id="dirigido" class="form-control" placeholder="Estimados Sres. ..."
                    required value="{{isset($venta) ?  $venta->dirigido : old('dirigido')}}"/>

            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-12 col-md-12 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Tipo doc.</label></b></div>
                <select name="tipo_comprobante"  id="tipo_comprobante" class="form-control">
                    <option value="4" {{isset($venta) ? $venta->tipo_comprobante == '4' ? 'selected' : ""  : old('tipo_comprobante') == "4" ? "selected" : ""}}>Cotizacion</option>
                    <option value="1" {{isset($venta) ? $venta->tipo_comprobante == '1' ? 'selected' : ""  : old('tipo_comprobante') == "3" ? "selected" : ""}}>Ticket</option>
                    <option value="2" {{isset($venta) ? $venta->tipo_comprobante == '2' ? 'selected' : ""  : old('tipo_comprobante') == "2" ? "selected" : ""}}>Factura</option>
                    <option value="3" {{isset($venta) ? $venta->tipo_comprobante == '3' ? 'selected' : ""  : old('tipo_comprobante') == "1" ? "selected" : ""}}>CCF</option>
                </select> 
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-112 col-md-112 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Fecha</label></b></div>
                <input type="text" placeholder="Seleccione fecha" name="check_in" readonly="readonly"
                value="{{isset($venta) ?  $venta->fecha_hora : date('Y-m-d')}}" id="check_in" class="form-control text-center">
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-12 col-md-12 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Entrega</label></b></div>
                <input type="text" name="entrega" id="entrega" class="form-control" required 
                   value="{{isset($venta) ?  $venta->entrega : (null !== (old('entrega'))  ? old('entrega') : "5 dias" )}}" />
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-12 col-md-12 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Validez</label></b></div>
                <input type="text" name="validez" id="validez" class="form-control" required 
                value="{{isset($venta) ?  $venta->validez : (null !== (old('validez'))  ? old('validez') : "30 días" )}}"/>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-12 col-md-12 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Tipo pago</label></b></div>
                <select class="form-control" name="pago" id="pago">
                    <option value="Credito" {{ isset($venta) ? $venta->pago == 'Credito' ? 'selected' : ""  : old('pago') == "Credito" ? "selected" : ""}}>Crédito</option>
                    <option value="Contado" {{ isset($venta) ? $venta->pago == 'Contado' ? 'selected' : ""  : old('pago') == "Contado" ? "selected" : ""}}>Contado</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-12 col-md-12 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Garantía</label></b></div>
                <input type="text" name="garantia" class="form-control"  required 
                value="{{isset($venta) ?  $venta->garantia : (null !== (old('garantia'))  ? old('garantia') : "20 días" )}}"/>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Artículo</label></b></div>
                <input type="text" name="articulo" id="articulo" class="form-control"
                    placeholder="Código, nombre producto ..." onclick="javascript: limpia(this);"
                    onBlur="javascript: verifica(this);" />

                <input type="hidden" id="productoValue" name="productoValue">

            </div>
            <div id="ListaProductos" name="ListaProductos">
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Cantidad</label></b></div>
                <input type="number" id="cantidad" class="form-control" value="1" />
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Stock</label></b></div>
                <input type="number" id="stock" class="form-control" placeholder="Stock" />
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">PLista</label></b></div>
                <input type="number" step="0.01" id="precio_lista" step="0.01" class="form-control"
                    placeholder="P.Lista" />
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Dto/U</label></b></div>
                <input type="number" step="1" id="descuentou" class="form-control" value="0" />
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">PCDesc.</label></b></div>
                <input type="number" step="0.01" id="precio_venta" class="form-control" placeholder="P. Venta" />
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Código</label></b></div>
                <input type="number"  id="codigo_articulo" class="form-control" placeholder="Código" />
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <button type="button" name="bt_add" id="bt_add" class="btn btn-primary btn-block m-t-8">
         GREGAR ITEM
            </button>
        </div>
    </div>
</div>