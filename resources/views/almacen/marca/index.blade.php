@extends('layouts.admin')
@section('title','Marcas')
@section('contenido')
@include('almacen.marca.create')
{{-- @include('modals.addCategoriaModal') --}}

<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

<div class="row" style="{{ config('constantes.FONT') }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
        <div class="panel-heading" style="font-size:150%; height: 40px;">
                Marcas
            <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                  <a href="" data-target="#formMarcaModal" data-toggle="modal"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
            </p>
        </div>
        <br>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover display compact" id="myTable3" style="font-size:100%;">
                    <thead>
                        <th class="text-left" width="5%" >Id</th>
                        <th class="text-left" width="33%">Nombre</th>
                        <th class="text-center" width="5%">Estado</th>
                        <th class="text-center" width="25%">Logo</th>
                        <th class="text-center" width="7%">Opc</th>
                    </thead>

                    <tbody>
                     @foreach($marcas as $mar)
                    <tr>
                        <td>{{$mar->idMarca}}</td>
                        <td>{{$mar->nombreMarca}}</td>
                        <td class="text-center">{{$mar->estado}}</td>
                        <td class="text-center">
                            @if ($mar->logo != null)
                        <img src="{{ asset("imagenes/logos/".$mar->logo)  }}" height="100px"
                        width="100px" />
                        @endif
                        </td>
                        <td class="text-center"> {{-- <a href="" data-target="#modal-edit-marca{{$mar->idMarca}}" data-toggle="modal">
                   
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span>
                            </a> --}}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{URL::action('MarcaController@edit',$mar->idMarca)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span>
                                </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="" data-target="#modal-delete-{{$mar->idMarca}}" data-toggle="modal">
                            <span aria-hidden="true" class="glyphicon glyphicon-minus-sign">
                                    </span>
                            </a>
                        </td>
                    </tr>
{{-- @include('almacen.marca.edit') --}}
{{-- @include('almacen.marca.modalMarca') --}}
@endforeach
                   </tbody>
                </table>
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
