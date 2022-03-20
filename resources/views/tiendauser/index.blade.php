@extends('layouts.admin')
@section('title','Tienda Usuario')
@section('contenido')

<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    <div class="row" style="{{ config('constantes.FONT') }}">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
            <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
            TIENDAS || USUARIOS
        </div>
        <div class="panel-body">
            <table class="table table-hover display compact" id="myTable" style="font-size:90%;">
                <thead>
                    <th class="text-left" width="5%">ID</th>
                    <th class="text-left" width="15%">Tienda </th>
                    <th class="text-center" width="40%">Usuario</th>
                    <th class="text-center" width="10%">E-mail</th>
                    <th class="text-center" >---</th>
                    {{-- <th class="text-center" width="10%">Opciones</th> --}}
                </thead>

                <tbody>
                    @foreach($tienda as $zo)
                    <tr>
                        <td>{{$zo->iduser}}</td>
                        <td>{{$zo->nombreTienda}}</td>
                        <td>{{$zo->name}}</td>
                        <td>{{$zo->email}}</td>
                 
                        <td align="center"> <a href="" data-target="#modal-delete-{{$zo->iduser}}"
                                data-toggle="modal">

                                <span aria-hidden="true">
                                    EDITAR </span>
                            </a></td>
                    </tr>
                    {{-- @include('configuracion.modal') --}}
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>    
<script> 
    $(document).ready(function(){
        $("#conf").css("color", "orange");
    });
</script>
@endsection