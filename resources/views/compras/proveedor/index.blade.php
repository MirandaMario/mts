@extends('layouts.admin')
@section('title','Proveedores')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Listado de Proveedores
            <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                <a href="proveedor/create"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
            </p>
            </div>
            <br>
            <div class="panel-body">
              
                     <table class="display responsive nowrap compact" id="myTable" style="font-size:100%;">
                        <thead>
                            <th class="text-left" width="5%"></th>
                            <th class="text-left" width="30%">Nombre</th>
                            <th class="text-left" width="15%">Tel.</th>
                            <th class="text-left" width="15%">Contacto</th>
                            <th class="text-left" width="15%">Email</th>
                            <th class="text-center" width="10%">Estado</th>
                            <th class="text-center" width="10%">Opciones</th>
                        </thead>
                         @foreach($personas as $per)
                        <tr>
                            <td width="5%">{{$per->idpersona}}</td>
                            <td width="30%">{{$per->nombre}}</td>
                            <td width="15%">{{$per->tel}}</td>
                            <td width="15%">{{$per->contacto}}</td>
                            <td width="15%">{{$per->email}}</td>
                            <td width="10%" class="text-center">{{$per->estado}}</td>
                            <td width="10%" class="text-center">
                                <a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal">
                                <span aria-hidden="true" class="glyphicon glyphicon-minus-sign">
                                </span>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{URL::action('ProveedorController@show',$per->idpersona)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                </span>
                                </a>
                            </td>
                        </tr>
@include('compras.proveedor.modal')
@endforeach
                    </table>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script> 
    $(document).ready(function(){
        $("#varios").css("color", "orange");
        });
</script>


@endsection
