@extends('layouts.admin')
@section('title','Listado Clientes')
@section('contenido')
<!--<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet"/>-->
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:100%; height: 40px;">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa text-left">
                    {!! Form::open(array('url'=>'cliente','method'=>'get','autocomplete'=>'off','role'=>'search', 'id'=>'bcliente',  "class"=>"form-inline")) !!}
                    {{Form::token()}}
                    <input type="number"  name="numero"  placeholder="Tel NIT..."    style="color:black;"/>
                    <input type="text"  name="cliente" id="empresa" size="40"  placeholder="Ingrese cliente ..."   style="color:black;"/>
                    <input type="hidden" name="idcliente" id="idcliente" value=""  />
                    <input type="submit" value="buscar"  style="color: black;" />
                    <div id="gitcliente" style=" position: absolute;"></div>
                    <div id="ListaClientes">
                    </div>
                    {{Form::close()}} 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pa text-right">    
                Listado de Clientes
                <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                  <a href="cliente/create"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
                </p>
            </div>
            </div>
             <br>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover display compact" id="myTable" style="font-size:100%;">
                            <thead>
                                <th class="text-left" width="5%">ID</th>
                                <th class="text-center" width="30%">Nombre</th>
                                <th class="text-center" width="15%">NCR</th>
                                <th class="text-left" width="20%">NIT</th>
                                <th class="text-left" width="10%">Tel</th>
                                <th class="text-center" width="2%">Con</th>
                                <th class="text-center" width="2%">Sus</th>
                                <th class="text-center" width="10%">Opciones</th>
                            </thead>

                         @foreach($personas as $per)
                            <tr>
                                <td> <a href="{{URL::action('ClienteController@puntos',$per->idpersona)}}">
                                    {{$per->idpersona}}</a></td>
                                <td>{{$per->nombre}}</td>
                            
                                <td>{{$per->iva}}</td>
                                <td>{{$per->nit}}</td>
                                <td>{{$per->tel}}</td>
                                <td class="text-center">{{$per->confirmed}}</td>
                                <td class="text-center">{{$per->suscribete}}</td>
                                <td class="text-center">
                                    <a href="{{URL::action('ClienteController@edit',$per->idpersona)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                    </a>
                                        &nbsp;&nbsp;&nbsp;
                                    <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal">

                                        <span aria-hidden="true" class="glyphicon glyphicon-minus-sign">
                                    </span>
                                    </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                                    <a href="{{URL::action('ClienteController@show',$per->idpersona)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                    </span>
                                    </a>
                                </td>
                            </tr>
                            @include('ventas.cliente.modal')
                            @endforeach
                        </table>
                    </div>
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
