@extends('layouts.admin')
@section('title','Nuevo Depósito o Remesa')
@section('contenido')
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
                        <h3 class="panel-title" style="font-size: 25px"> Datos del nuevo ingreso </h3>
                    </div>
                    <div class="panel-body">
                        {!!Form::open(array('url'=>'transaccion','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <label>Cuenta</label>
                                <select name="idBanco" id="idBanco" class="form-control" required>
                                    @foreach($cuentas as $cuenta)
                                    <option value="{{$cuenta->id}}">
                                        {{$cuenta->nombreCuenta}}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="idPersona" id="idPersona" value="1" class="form-control" />
                                <input type="hidden" name="tipoMov" id="tipoMov" value="INGRESO" class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg12 col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">En concepto de:</label>
                                    <input type="text" name="concepto" required value="{{old('tipoCuenta')}}"
                                        class="form-control" placeholder="Ingrese el concepto" />
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Valor:</label>
                                    <input type="number" name="valorIngreso" required value="{{old('tipoCuenta')}}"
                                        class="form-control" placeholder="Digite el valor" min="0" value="0"
                                        step="0.01" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">N° de comprobante:</label>
                                    <input type="text" name="numeroRemesa" required value="{{old('tipoCuenta')}}"
                                        class="form-control" placeholder="Ingrese el número" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="check_in">Fecha ingreso : </label>
                                    <input type="text" placeholder="Seleccione fecha" name="fecha" readonly="readonly"
                                        value="{{$ldate = date('Y-m-d')}}" id="check_in" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" align="right">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>&nbsp;
                                    &nbsp;&nbsp;
                                    <a href="{{ url('/transaccion') }}"><button class="btn btn-primary btn-sm m-t-10"
                                            type="button">Cancelar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection