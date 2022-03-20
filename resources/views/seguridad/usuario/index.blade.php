@extends('layouts.admin')
@section('title','Usuarios')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row" style="{{ config('constantes.FONT') }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Listado de usuarios
            <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                  <a href="usuario/create"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
            </p>
            </div>
                <br>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover display compact" id="myTable" style="font-size:100%;">
                            <thead>
                                <th class="text-left" width="5%">Id</th>
                                <th class="text-left" width="30%">Nombre</th>
                                <th class="text-left" width="20%">Email</th>
                                <th class="text-left" width="10%">ROL</th>
                                <th class="text-left" width="10%">Tienda</th>
                                <th class="text-center" width="10%">Opciones</th>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usu)
                            <tr>
                                <td>{{$usu->id}}</td>
                                <td>{{$usu->name}}</td>
                                <td>{{$usu->email}}</td>
                                <td>{{$usu->rol}}</td>
                                <td>{{$usu->id_tienda}}</td>
                                <td class="text-center">
                                <a href="{{URL::action('UsuarioController@edit',$usu->id)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                </a>
                             {{--    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal">
                                <span aria-hidden="true" class="glyphicon glyphicon-trash">
                                    </span>
                                </a> --}}
                                </td>
                            </tr>
                            @include('seguridad.usuario.modal')
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>


@endsection