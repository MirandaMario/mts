<div class="row">
    <div class="col-lg-2 col-md-3  col-sm-2  col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">$E_Cliente</label></b></div>
                <input type="number" name="envio" class="form-control text-center" step="0.01"
                    value="{{isset($venta->envio) ? $venta->envio : 0}}">
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-3  col-sm-2  col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">$E_Interno</label></b></div>
                <input type="number" name="envio_interno" class="form-control text-center" step="0.01"
                    value="{{isset($venta->envio_interno) ? $venta->envio_interno : 0}}">
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-3  col-sm-2  col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">Transporte</label></b></div>
                <select class="form-control" name="transporte">
                    <option value="4" {{ isset($venta->transporte) ? $venta->transporte == '4' ? 'selected' : ""  : old('transporte') == "4" ? "selected" : ""}}> N/A</option>
                    <option value="2" {{ isset($venta->transporte) ? $venta->transporte == '2' ? 'selected' : ""  : old('transporte') == "2" ? "selected" : ""}}> Local</option>
                    <option value="1" {{ isset($venta->transporte) ? $venta->transporte == '1' ? 'selected' : ""  : old('transporte') == "1" ? "selected" : ""}}> Propio</option>
                    <option value="3" {{ isset($venta->transporte) ? $venta->transporte == '3' ? 'selected' : ""  : old('transporte') == "3" ? "selected" : ""}}> Guia</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-3  col-sm-2  col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">F_Pago</label></b></div>
                <select class="form-control" name="forma_pago">
                    <option value="4" {{ isset($venta->forma_pago) ? $venta->forma_pago == '4' ? 'selected' : ""  : old('forma_pago') == "4" ? "selected" : ""}}> Efectivo</option>
                    <option value="1" {{ isset($venta->forma_pago) ? $venta->forma_pago == '1' ? 'selected' : ""  : old('forma_pago') == "1" ? "selected" : ""}}> Electronica / POS</option>
                    <option value="2" {{ isset($venta->forma_pago) ? $venta->forma_pago == '2' ? 'selected' : ""  : old('forma_pago') == "2" ? "selected" : ""}}> Guia</option>
                    <option value="3" {{ isset($venta->forma_pago) ? $venta->forma_pago == '3' ? 'selected' : ""  : old('forma_pago') == "3" ? "selected" : ""}}> Cheque</option>
                    <option value="5" {{ isset($venta->forma_pago) ? $venta->forma_pago == '5' ? 'selected' : ""  : old('forma_pago') == "5" ? "selected" : ""}}> Transferencia</option>
                    <option value="6" {{ isset($venta->forma_pago) ? $venta->forma_pago == '6' ? 'selected' : ""  : old('forma_pago') == "6" ? "selected" : ""}}> Chivo</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-3  col-sm-2  col-xs-12 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">#GUIA</label></b></div>
                <input type="text" name="nguia" class="form-control text-center" step="0.01"
                    value="{{isset($venta->nguia) ? $venta->nguia : ""}}">
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-3  col-sm-2  col-xs-6 pa">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon bgd"><b><label class="a">PAGO</label></b></div>
                <select class="form-control" name="estado_pago">
                    <option value="0" {{ isset($venta->estado_pago) ? $venta->estado_pago == '0' ? 'selected' : ""  : old('estado_pago') == "0" ? "selected" : ""}}> Pendiente</option>
                    <option value="1" {{ isset($venta->estado_pago) ? $venta->estado_pago == '1' ? 'selected' : ""  : old('estado_pago') == "1" ? "selected" : ""}}> Cancelado</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 pa">
        <div class="input-group-addon bgd"><b><label class="a">Notas </label></b></div>
        <textarea type="text" name="notas" id="notas" class="form-control"> {{isset($venta->notas) ? $venta->notas : ""}}</textarea>
    </div>
</div>