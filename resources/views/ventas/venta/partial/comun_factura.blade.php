
<div class="col-md-10">
    <div class="row ">
        <div class="row ">
            <div class="col-lg-8  col-md-12  col-sm-12 col-xs-12 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Cliente <a href="" data-target="#form_cliente_create_modal" data-toggle="modal">++</a></label></b></div>
                        <textarea type="text" name="cliente" id="empresa" class="form-control"
                            placeholder="Ingrese cliente ..."
                            required>{{isset($venta->nombre) ?  $venta->nombre : ""}} </textarea>
                        <input type="hidden" name="idcliente" id="idcliente"
                            value="{{isset($venta->idpersona) ? $venta->idpersona : ""}}" class="form-control" />
                        <input type="hidden" name="idventa" id="idventa"
                            value="{{isset($venta->idventa) ?  $venta->idventa : ""}}" class="form-control" />
                    </div>
                    <div id="gitcliente"  style="position: absolute; "></div>
                    <div id="ListaClientes">
                    </div>
                </div>
            </div>
            <div class="col-lg-2  col-md-6 col-sm-6 col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Fecha</label></b></div>
                        <input type="text"  name="check_in" readonly id="check_in" class="form-control text-center pa"
                            value="{{  isset($venta->fecha_hora) ?    date('Y-m-d', strtotime($venta->fecha_hora))  : date('Y-m-d')}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2  col-md-6 col-sm-6 col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Cvo</label></b></div>
                        <input type="number" step="1" name="num_comprobante" id="num_comprobante"
                            class="form-control text-center"
                            value="{{isset($venta->num_comprobante) ? $venta->num_comprobante : $correlativo}}" />
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-8  col-xs-12 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Artículo</label></b></div>                     
                        <input type="text" class="form-control" name="articulo" id="articulo"
                            placeholder="Nombre producto ..." onclick="javascript: limpia(this);">                 
                    </div> 
                    <div id="gitarticulo"  style="position: absolute; "></div>
                    <div id="ListaProductos" name="ListaProductos"></div>              
                </div>               
            </div>
           
            <div class="col-lg-2  col-md-6 col-sm-4  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Cantidad</label></b></div>
                        <input type="number" id="cantidad" class="form-control text-center" value="1" />
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3  col-sm-2  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Puntos</label></b></div>
                        <input type="text" id="puntos" class="form-control" step="1" placeholder="Puntos">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3  col-sm-4  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Stock</label></b></div>
                        <input type="number" id="stock" class="form-control" placeholder="Stock" />
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3  col-sm-4  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">PLista</label></b></div>
                        <input type="number" step="0.01" id="precio_lista" class="form-control"
                            placeholder="P. Venta" />
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3  col-sm-4  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Código</label></b></div>
                        <input type="number" step="0.01" id="codigo_articulo" class="form-control"
                            placeholder="Código" />
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3  col-sm-4  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">PVDESC</label></b></div>
                        <input type="text" id="precio_venta" class="form-control" step="0.01" placeholder="P. Venta" readonly>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-4  col-xs-6 pa">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon bgd"><b><label class="a">Dto/U</label></b></div>
                        <input style="padding-left: 2px; padding-right: 0px;" type="number" id="descuentou"
                            class="form-control text-center" value="0" required />
                    </div>
                </div>
            </div>
           
           
         
            <div class="col-lg-2 col-md-12  col-sm-12  col-xs-6 pa">
                <div class="form-group">
                    <div>
                        <button type="button" name="bt_add" id="bt_add" class="btn btn-primary btn-block">
                            AGREGAR ITEM
                        </button>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
<div id="aside" class="col-md-2 ">
    <div style="text-align: center;">
        <img src="" id="imagen" class="img-fluid">
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
        <div class="table-responsive">
            <table id="detalles" class="table table-bordered table-condensed" style="font-size:100%;">
                <thead style="background-color: #A9D0F5;">
                    <th class="text-left" width="5%">---</th>
                    <th class="text-left" width="65%">Artículo</th>
                    <th class="text-center" width="7%">Cantidad</th>
                    <th class="text-right" width="7%">Desc/U</th>
                    <th class="text-right" width="7%">Precio/U</th>
                    <th class="text-right" width="7%">Subtotal</th>
                </thead>
                <input type="hidden" name="total_venta" id="total_venta">
                <input type="hidden" id="descuento" name="descuento" value="0" />
              {{--   <input type="hidden" class="text-right" id="total"> --}}
                <input type="hidden" id="idtienda" name="id_tienda" value="{{auth()->user()->id_tienda}}">
                <input type="hidden" name="tipo_comprobante" value="2" />
                <input type="hidden" id="impuesto">
                <input type="hidden" id="impuestodos">
                <input type="hidden" id="beneficio">
                <input type="hidden" name="iva" id="iva" value="{{$varios->iva}}">
                <input type="hidden" name="cesc" id="cesc" value="{{$varios->cesc}}">
                <input type="hidden" name="idresolucion" value="{{ isset($tienda->id_resolucion) ? $tienda->id_resolucion  : "" }}">

                <input name="_token" value="{{csrf_token()}}" type="hidden" />

                