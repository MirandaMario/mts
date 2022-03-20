@extends('layouts.admin')
@section('title','Control de Factura')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('layouts.message')
<div class="row" style="{{ config('constantes.FONT') }}">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
             <div class="panel-heading" style="font-size:150%; height: 40px;">
               Listado de correlativos comprobantes 
            </div>
            <br>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover display compact"  style="font-size:100%; width:100%;">
                        <thead>
                            <th class="text-left" width="5%">Id</th>
                            <th class="text-left" width="15%">Tipo</th>
                            <th class="text-left" width="15%">Serie</th>
                            <th class="text-left" width="10%">Correlativo</th>
                            <th class="text-left" width="20%">Resolución</th>
                            <th class="text-left" width="20%">Rango</th>
                            <th class="text-left" width="20%">Fecha</th>
                            <th class="text-center" width="10%">Opciones</th>
                        </thead>

                        <tbody>
                            @foreach($control as $fac)

                            <tr>
                                <td>{{$fac->id}}</td>
                                <td>{{$fac->tipo}}</td>
                                <td>{{$fac->serie}}</td>
                                <td>{{$fac->correlativo}}</td>
                                <td>{{$fac->resolución}}</td>
                                <td>{{$fac->rango}}</td>
                                <td>{{$fac->fecha}}</td>
                                <td class="text-center">
                                    <a href="{{URL::action('ComprobanteController@edit',$fac->id)}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                        </span>
                                    </a>

                                </td>
                            </tr>

            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
