<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Proveedor</label></b></div>
                    <input type="text" name="idproveedor" id="idproveedor" class="form-control"
                    placeholder="Ingrese el nombre de su proveedor"  autofocus
                    value="{{isset($ingreso->nombre) ?  $ingreso->nombre : old('idproveedor')}}" />

                    
                    </div>
                    <input type="hidden" id="idP" name="idP"
                        value="{{isset($ingreso->idpersona) ?  $ingreso->idpersona : old('idP')}}">
                        <div id="gitempresa" ></div> 
                    <div id="ListaProveedores">
                      
            </div>                
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">N° Comp.</label></b></div>
                    <input type="text" name="num_comprobante"  id="num_comprobante"
                        value="{{isset($ingreso->num_comprobante) ?  $ingreso->num_comprobante : old('num_comprobante')}}"
                        class="form-control" placeholder="Número..." />
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">N° Serie.</label></b></div>
                    <input type="text" name="serie_comprobante"  id="serie"
                        value="{{isset($ingreso->serie_comprobante) ?  $ingreso->serie_comprobante : old('num_comprobante')}}"
                        class="form-control" placeholder="Serie..." />
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">F. compra.</label></b></div>
                    <input type="text" class="form-control text-center" placeholder="Seleccione fecha" name="check_in"
                    readonly="readonly" value="{{isset($ingreso->fecha) ?  $ingreso->fecha : date('Y-m-d')}}" id="check_in"
                    class="form-control">
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">F. Fac.</label></b></div>
                    <input type="text" class="form-control text-center"  name="fecha_fac"
                    readonly="readonly"  id="fecha_fac" class="form-control">
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">F. Vcto.</label></b></div>
                    <input type="text" class="form-control text-center" name="fecha_ven"
                    readonly="readonly" id="fecha_ven"  class="form-control">
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Lote</label></b></div>
                    <input type="text" name="lote" id="lote" class="form-control"  />
            </div>
        </div>
    </div>
    
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Artículo </label></b></div>
                    <input type="text" name="articulo" id="articulo_ingreso" class="form-control"
                        placeholder="Código producto ..." /> 
            </div>
                    <input type="hidden" id="idA" name="idA">
                    <div id="gitarticulo" ></div> 
                    <div id="ListaProductos">
                    </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Cantidad</label></b></div>
                    <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad" />
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">P Compra </label></b></div>
                    <input type="number" min="0"  step="0.01"
                   name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="P. compra" />
            </div>
        </div>
    </div>
</div>

<div class="row">  
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa ">
        <div class="form-group">
            <button type="button" name="bt_add" id="bt_add_ingreso" class="btn btn-primary btn-lg btn-block">
                AGREGAR ITEM
            </button>
        </div>
    </div>
</div>

