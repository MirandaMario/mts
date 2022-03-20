@extends('layouts.admin')
@section('title','Producción')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row" style="{{ config('constantes.FONT') }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 45px;">
                <div class="text-right"> <span style="font-size: 20px;">
                        Suministrar productos
                        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                    <a href="ingresotienda/create"><button class="btn btn-desfult btn-sm" type="button">NUEVO</button></a>
                </div>
            </div>
         
            <div class="panel-body">
                       
                            <table class="display responsive nowrap compact" id="myTable" style="font-size:100%; width:100%;">
                                <thead>
                                    <th class="text-left" width="5%">ID</th>
                                    <th class="text-left" width="35%">Proveedor</th>
                                    <th class="text-left" width="10%">Fecha</th>
                                    <th class="text-left" width="10%">Comprobante</th>
                                    <th class="text-right" width="10%">Total</th>
                                    <th class="text-left" width="10%">Opciones</th>
                                </thead>

                                @foreach($ingresos as $ing)
                                <tr>
                                    <td width="5%">{{$ing->idingreso}}</td>                                 
                                    <td width="35%">{{substr($ing->nombre, 0, 65)}}</td>
                                    <td width="10%">{{date('d/m/Y', strtotime($ing->fecha_hora))}}</td>
                                    <td width="10%">{{$ing->tipo_comprobante}} {{$ing->num_comprobante}}</td>
                                    <td width="10%" class="text-right">$
                                        @if ($ing->tipo_comprobante == "CCF")
                                        {{number_format(($ing->total_ingreso*0.13)+$ing->total_ingreso, 2)}}
                                        @else
                                        {{$ing->total_ingreso}}
                                        @endif
                                    </td>
                                    <td class="text-center" width="5%">
                                        @if ($ing->total_ingreso == 0)
                                        ANULADO
                                        @else
                                        <a href="{{URL::action('IngresoTiendaController@show',$ing->idingreso)}}">
                                            <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                            </span>
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        @if ($ing->tipo_comprobante == 'CCF')
                                        <a href="{{URL::action('IngresoTiendaController@edit2',$ing->idingreso)}}">
                                            <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                            </span>
                                        </a>
                                        @else
                                        <a href="{{URL::action('IngresoTiendaController@edit',$ing->idingreso)}}">
                                            <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                            </span>
                                        </a>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                @include('compras.ingreso.modal')
                                @endforeach
                            </table>
                       
            </div>
        </div>
    </div>
</div>



<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    
<script>
    $("#comprabtn").css("background-color", "orange");
    $(document).ready(function(){


});
</script>
@endsection
