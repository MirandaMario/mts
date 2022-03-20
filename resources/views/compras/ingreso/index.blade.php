@extends('layouts.admin')
@section('title','Compras')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 65px;">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa text-left">
                    {!! Form::open(array('url'=>'ingreso','method'=>'get','autocomplete'=>'off','role'=>'search', 'id'=>'bpro',   "class"=>"form-inline")) !!}
                    {{Form::token()}}
                    <input type="number"  name="numero"  placeholder="Comprobante ..."    style="color:black;"/>
                    <input type="text"  name="cliente" id="proveedor" size="40"  placeholder="Ingrese proveedor ..."   style="color:black;"/>
                    <input type="hidden" name="idcliente" id="idcliente" value=""  />
                    <input type="submit" value="buscar"  style="color: black;" />
                    <div id="gitcliente" style=" position: absolute;"></div>
                    <div id="ListaProveedores">
                    </div>
                    {{Form::close()}} 
                    </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa text-right">    
                    {{-- <span style="font-size: 20px;">Histórico compras</span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                    <a href="{{ route('ingreso.create', ['id' =>  1])}}">
                        <button class="btn  btn-sm" type="button">FACTURA</button></a>
                    <a href="{{ route('ingreso.create', ['id' =>  2])}}">
                        <button class="btn  btn-sm" type="button">CCF</button></a>              
                </div>
            </div>
          
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover display compact" id="myTable" style="font-size:100%; width:100%;">
                        <thead>
                            <th class="text-left" width="5%">ID</th>
                            <th class="text-left" width="12%">Fecha</th>
                            <th class="text-left" width="35%">Proveedor</th>
                            <th class="text-left">Comprobante</th>
                            <th class="text-left" width="5%">Fuente</th>
                            <th class="text-center" width="10%">Total</th>
                            <th class="text-left" width="10%">Opciones</th>
                        </thead>

                        @foreach($ingresos as $ing)
                        <tr>
                            <td width="5%">{{$ing->idingreso}}</td>
                            <td width="12%">{{date('d/m/Y', strtotime($ing->fecha_hora))}}</td>
                            <td width="35%">{{$ing->nombre}}</td>
                            <td> 
                                    @if ($ing->documento != null)
                                        <a href="{{asset('facccf/'.$ing->documento)}}"  target="_blank">{{$ing->tipo_comprobante}} {{$ing->num_comprobante}}</a>
                                    @else
                                        {{$ing->tipo_comprobante}} {{$ing->num_comprobante}}
                                    @endif
                            </td>
                            <td width="5%">{{$ing->fuente}}</td>
                            <td width="10%" class="text-right"> {{$ing->total_ingreso + $ing->retencion}} </td>
                            <td class="text-center" width="5%">
                                @if ($ing->total_ingreso == 0)
                                ANULADO
                                @else
                                <a href="{{URL::action('IngresoController@show',$ing->idingreso)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                    </span>
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                @if ($ing->tipo_comprobante == 'CCF')
                                <a href="{{URL::action('IngresoController@edit',$ing->idingreso)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                </a>
                                @else
                                <a href="{{URL::action('IngresoController@edit',$ing->idingreso)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                </a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        {{-- @include('compras.ingreso.modal') --}}
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
        $("#compra").css("background-color", "orange");    
        });
</script>
@endsection