@extends('layouts.admin')
@section('title','Listado de Cuentas')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row " >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div id="dv1" style="position: absolute; width: 75px; left:40.1%;" class="float-none">

        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%;">
                Listado de Cuentas
                <p class="navbar-text navbar-right" style=" margin-top: 1px;">
                  <a href="cuenta/create"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
                </p>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover" id="myTable" style="font-size:100%;">
                    <thead>
                        <th>Id</th>
                        <th>Banco</th>
                         <th>Nombre</th>
                        <th>#Cuenta</th>
                        {{-- <th>#Finan</th> --}}
                        <th>Estado</th>
				        <th>Opciones</th>
                    </thead>

                    <tbody>
                     @foreach($cuentas as $cu)
            <tr>
                <td>{{$cu->id}}</td>
                <td>{{$cu->banco}}</td>
                <td>{{$cu->nombreCuenta}}</td>
                <td>{{$cu->numeroCuenta}}</td>
                {{-- <td>{{$cu->idCuentaOrigen}}</td> --}}
                <td>{{$cu->estado}}</td>
				

                <td>
                    <a href="{{URL::action('CuentasController@edit',$cu->id)}}">
                        <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                        </span>
                    </a>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    
                    <a href="" data-target="#modal-delete-{{$cu->id}}" data-toggle="modal">
                        
                        <span aria-hidden="true" class="glyphicon glyphicon-minus-sign">
                                    </span>
                    </a>
                </td>
            </tr>
            @include('cuenta.modal') 
            @endforeach
                    </tbody>
                     
                    
                </table>
                <div class="text-center">
         {{--          {!!$regCliente->links()!!}  --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection