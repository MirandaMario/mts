@extends('layouts.admin')
@section('title','EDITAR REMESA')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-size: 25px"> Editar Datos de Ingreso </h3>
                    </div>
                    <div class="panel-body">

                        {!!Form::model($transaccion,['method'=>'PATCH','route'=>["transaccion.update",$transaccion->id]])!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <label>Cuenta</label>
                                <select name="idBanco" id="idBanco" class="form-control" required>
                                    @foreach($cuentas as $c)
                                    <option value="{{$c->id}}"  {{$c->id == $cuenta->id ? "selected" : "" }} >
                                        {{$c->nombreCuenta}}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="idPersona" id="idPersona" value="1" class="form-control" />
                                <input type="hidden" name="tipoMov" id="tipoMov" value="INGRESO" class="form-control" />
                                <!--input type="hidden" name="estado"  id="estado" value="Activo" class="form-control" /-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg12 col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">En concepto de:</label>
                                    <input type="text" name="concepto" required value="{{$transaccion->concepto}}"
                                        class="form-control" placeholder="Ingrese el concepto" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Valor:</label>
                                    <input type="number" name="valorIngreso" required
                                        value="{{$transaccion->valorIngreso}}" class="form-control"
                                        placeholder="Digite el valor" min="0" value="0" step="0.01" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">N° de comprobante:</label>
                                    <input type="text" name="numeroRemesa" required
                                        value="{{$transaccion->numeroRemesa}}" class="form-control"
                                        placeholder="Ingrese el número" />
                                </div>
                            </div>
                            <div class="col-lg-2  col-sm-2  col-md-2 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Fecha:</label>
                                    <input type="text" name="check_in" id="check_in" required readonly="readonly"
                                        value="{{$transaccion->fecha}}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Estado</label>
                                    <select class="form-control" name="estado" id="estado">
                                        @php
                                        if (($transaccion->estado)=== 'Activo') {
                                        echo ' <option value="Activo" selected>Activo</option>' ;
                                        echo ' <option value="Anulado">Anulado</option>' ;
                                        }else {
                                        echo ' <option value="Activo">Activo</option>' ;
                                        echo ' <option value="Anulado" selected>Anulado</option>' ;

                                        }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" align="right">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-sm m-t-10" type="submit">Actualizar</button>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    <a href="{{ url('/transaccion') }}"><button class="btn btn-primary btn-sm m-t-10"
                                            type="button">Cancelar</button></a>
                                    <button class="btn btn-warning btn-sm m-t-10" type="reset"
                                        align="right">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection