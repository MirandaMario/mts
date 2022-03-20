@extends('layouts.admin')
@section('title','Configuración')
@section('contenido')
<div class="row" style=" {{ config('constantes.FONT') }}">

    <div class="panel panel-primary ">
        <div class="panel-heading">
            CONFIGURACIONES
        </div>
        <div class="panel-body">
            <table class="table table-hover display compact" id="myTable" style="font-size:90%;" border="0">
                <thead>
                    <th class="text-left" width="5%">ID</th>
                    <th class="text-left" width="15%">Moneda </th>
                    <th class="text-left" width="30%">Cadena </th>
                    <th class="text-left" width="20%">Descripcion </th>
                    <th class="text-center" width="10%">Opciones</th>
                </thead>

                <tbody>
                    @foreach($configuracion as $zo)
                    <tr>
                        <td>{{$zo->id_miscelanea}}</td>
                        <td>{{$zo->moneda}}</td>
                        <td>{{$zo->cadena}}</td>
                        <td>{{$zo->descripcion}}</td>
                        <td align="center"> <a href="" data-target="#modal-delete-{{$zo->id_miscelanea}}"
                                data-toggle="modal">

                                <span aria-hidden="true">
                                    EDITAR </span>
                            </a></td>
                    </tr>
                    @include('configuracion.modal')
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection