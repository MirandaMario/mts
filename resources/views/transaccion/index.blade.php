@extends('layouts.admin')
@section('title','Historial Transacciones')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%;">
                Listado de Ultimas 500 Transacciones
                <p class="navbar-text navbar-right" style=" margin-top: 1px;">
                    <a href="transaccion/create"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo"
                            style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;"
                            type="button">Déposito</button></a>
                </p>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover" id="myTable" style="font-size:90%;">
                    <thead>
                        <th>Id</th>
                        <th>Cuenta</th>
                        <th>Nombre Cuenta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Concepto General</th>
                        <th class="text-center">Ing</th>
                        <th class="text-center">Fecha&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($cheques as $che)
                        <tr>
                            <td class="text-center">{{$che->id}}</td>
                            <td>{{$che->numeroCuenta}}</td>
                            <td>{{$che->nombreCuenta}} || {{$che->conceptog}}
                                @if ($che->tipoMov === 'INGRESO')
                                {{$che->concepto}}
                                @endif
                            </td>
                            <td class="text-right">{{number_format($che->valorIngreso, 2, '.', ',')}}</td>
                            <td class="text-center">{{$newDate = date("d-m-Y", strtotime($che->fecha))}}</td>
                            <td class="text-center">{{$che->estado}}</td>
                            <td class="text-center">
                                <a  style="color: black" href="{{URL::action('TransaccionesController@edit',$che->id)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection