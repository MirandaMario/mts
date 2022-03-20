@extends('layouts.admin')
@section('title','Nueva Salida')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
@include('partial.error')
<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Datos de la  nueva salida
            </div>
            <div class="panel-body">

                {!!Form::open(array('url'=>'salida','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
                {{Form::token()}}

                <div class="row">
                    <div class="col-lg-10 col-sm-10 col-md-10 col-xs-12 pa">
                        <div class="form-group">
                                <b><label class="a">Proveedor</label></b>
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

                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="codigo" class="apa">Numero</label>
                            <input type="number" name="numero" required value="{{old('numero')}}" class="form-control"
                                placeholder="numero..."  step="1"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="tipo" class="apa">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="1" > Ticket </option>
                                <option value="2" > Factura </option>
                                <option value="3" selected> CCF </option>
                                {{-- <option value="4" > CCF GASOLINA </option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">Valor </label>
                            <input type="number" name="valor" id="valor" class="form-control"
                            min="0" step="0.0001"  placeholder="0.00" required/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">IVA </label>
                            <input type="text" name="iva" id="iva" class="form-control"
                            min="0"  value="0.00" readonly/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">Cotrans Fovial</label>
                            <input type="number" name="imp1" id="imp1" class="form-control"
                            min="0" step="0.0001" value="0.00" required/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">Imp2 </label>
                            <input type="number" name="imp2" id="imp2" class="form-control"
                            min="0" step="0.0001" value="0.00" required/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="precioCompra" class="apa">Retencion</label>
                            <input type="number" min="0" step="0.001" name="retencion" id="retencion" required
                            step="0.0001" class="form-control pa" value="0.00" />
                        </div>
                    </div> 
                    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa">
                        <div class="form-group">
                            <label for="descripcion" class="apa">Concepto</label>
                            <input type="text" name="concepto" value="{{old('concepto')}}" class="form-control"
                                placeholder="Concepto de la salida..." />
                           
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="precioCompra" class="apa">Total</label>
                            <input type="text" min="0" name="total" id="total" required
                            class="form-control pa" readonly/>
                        </div>
                    </div>  
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                    <div class="form-group">
                        <div class="input-group">
                            <b><label class="a">Fecha</label></b>
                            <input type="text"  name="check_in" readonly id="check_in" class="form-control text-center pa"
                                value="{{  isset($venta->fecha_hora) ?    date('Y-m-d', strtotime($venta->fecha_hora))  : date('Y-m-d')}}">
                        </div>
                    </div> 
                </div>                                     
                </div>
                <BR>
                <div class="row ">
                    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa pull-right">
                        <button class="btn btn-success btn-sm m-t-10" type="submit">GUARDAR</button>
                        <a href="{{ url('/articulo') }}"><button class="btn btn-primary btn-sm m-t-10"
                                type="button">CANCELAR</button></a>
                        <button class="btn btn-warning btn-sm m-t-10" type="reset" class="text-right">RESET</button>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
        <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/ingreso/helper.js')}}"></script>
<script src="{{asset('js/ingreso/agregar_ccf.js')}}"></script>
<script src="{{asset('js/ingreso/salida.js')}}"></script>

@endsection