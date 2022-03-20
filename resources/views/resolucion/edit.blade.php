@extends('layouts.admin')
@section('title','Editar Resolucion')
@section('contenido')
<div class="row" >
    <div>
        <div class="col-md-12 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:150%; height: 40px;">
                    Editar resolucion N° {{$resolucion->id_resolucion}}
                </div>
                <div class="panel-body">
                    {!!Form::model($resolucion,['method'=>'PATCH','route'=>['resolucion.update',$resolucion->id_resolucion],'autocomplete'=>'off'])!!}
                    {{Form::token()}}

                    <div class="row">

                        <div class="form-group">
                            <label class="control-label col-md-2">T-Compro :</label>
                            <div class="col-md-4">
                                <select name="tipo_documento" class="form-control" readonly>
                                    <option value="3" {{$resolucion->tipo_documento == 3 ?  'selected' : ''}}>CCF</option>
                                    <option value="2" {{$resolucion->tipo_documento == 2 ?  'selected' : ''}}>Factura</option>
                                    <option value="1" {{$resolucion->tipo_documento == 1 ?  'selected' : ''}}>Ticket</option>
                                </select>
                            </div>
                            
                            <label class="control-label col-md-2">Serie_res :</label>
                            <div class="col-md-4">
                                <input type="text" name="serie_resolucion"  class="form-control"  value="{{$resolucion->serie_resolucion}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Desde :</label>
                            <div class="col-md-4">
                                <input type="text" name="rango_desde"  class="form-control" value="{{$resolucion->rango_desde}}" />
                            </div>
                            <label class="control-label col-md-2">Hasta :</label>
                            <div class="col-md-4">
                                <input type="text" name="rango_hasta"  class="form-control" value="{{$resolucion->rango_hasta}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Num_res :</label>
                            <div class="col-md-4">
                                <input type="text" name="numero_resolucion"  class="form-control"  value="{{$resolucion->numero_resolucion}}"/>
                            </div>
                            <label class="control-label col-md-2">Fecha :</label>
                            <div class="col-md-4">
                                <input type="text" name="fecha_resolucion"  readonly id="check_in"  class="form-control" 
                                value="{{$resolucion->fecha_resolucion}}">
            
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Tienda_res:</label>
                            <div class="col-md-4">
                                <select name="tienda_res"  class="form-control">
                                    @foreach($tiendas as $t)
                                    <option value="{{$t->id}}" {{$t->id == $resolucion->tienda_res ? "selected" : "" }}> {{$t->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-md-2">Estado :</label>
                            <div class="col-md-4">
                                <select name="estado_res" class="form-control">
                                    <option value="1" {{$resolucion->estado_res == 1 ?  'selected' : ''}}>Activo</option>
                                    <option value="0" {{$resolucion->estado_res == 0 ?  'selected' : ''}}>Inactivo</option> 
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa">
                        <br><br><br>
                        <button class="btn btn-success btn-sm m-t-10" type="submit">Actualizar</button>
                        <a href="{{ url('/resolucion') }}"><button class="btn btn-primary btn-sm m-t-10"
                                type="button">Cancelar</button></a> <button class="btn btn-warning btn-sm m-t-10"
                            type="reset">Reset</button>
                    </div>


                    {!!Form::close()!!}
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection 