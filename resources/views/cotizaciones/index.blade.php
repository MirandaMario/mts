@extends('layouts.admin')
@section('title','Histórico de Cotizaciones')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 65px;">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa text-left">
                    {!! Form::open(array('url'=>'cotizacion','method'=>'get','autocomplete'=>'off','role'=>'search', 'id'=>'bhis',  "class"=>"form-inline")) !!}
                    {{Form::token()}}
                        <input type="number"  name="numero"  placeholder="Num Cotizacion ..."    style="color:black;"/>
                        <input type="text"  name="cliente" id="empresa" size="40"  placeholder="Ingrese cliente ..."   style="color:black;"/>
                        <input type="hidden" name="idcliente" id="idcliente" value=""  />
                        <input type="submit" value="buscar"  style="color: black;" />
                        <div id="gitcliente" style=" position: absolute;"></div>
                        <div id="ListaClientes">
                        </div>
                    {{Form::close()}} 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa text-right">
                    <a href='{{ route('cotizacion.create')}}'> <button class="btn  btn-sm">GENERAR COTIZACION</button></a>
                </div>
            </div>
            <br>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover display compact" id="myTable" style="font-size:100%; width:100%;">
                        <thead>
                            <th class="text-left" width="5%">ID</th>
                            <th class="text-left" width="5%">Fecha</th>
                            <th class="text-left" width="50%">Cliente</th>
                            <th class="text-left" width="7%">Estado</th>
                            <th class="text-left" width="10%">Número</th>
                            <th class="text-right" width="5%">Total</th>
                            <th class="text-center" width="7%">Opciones</th>
                        </thead>
                        @foreach($ventas as $ven)
                        <tr>
                            <td>{{$ven->idCotizacion}}</td>
                            <td>{{date( 'd/m/y' , strtotime($ven->fecha_hora))}}</td>
                            <td>{{$ven->nombre}}</td>
                            <td>{{$ven->estado}}</td>
                            <td class="text-left">
                                @if ($ven->tipo_comprobante == "Factura" || $ven->tipo_comprobante == 2)
                                    Factura      
                                @elseif ($ven->tipo_comprobante == "CCF" || $ven->tipo_comprobante == 3)  
                                    CCF 
                                @elseif ($ven->tipo_comprobante == 4)      
                                    Vcotiza 
                                @else
                                    Ticket
                                @endif
                                -{{$ven->numeroComprobante}}
                            </td>
                            <td class="text-right">{{number_format($ven->total_cotizacion, 2 )}}</td>

                            <td class="text-center"> 
                                @if ($ven->total_cotizacion > 0) 
                                    <a title="Documento" href="{{URL::action('CotizacionController@show',$ven->idCotizacion)}}" target="_blank">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses"></span> </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                    <a title="Editar" href="{{URL::action('CotizacionController@edit',$ven->idCotizacion)}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span> </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                   {{--  href='{{ route('venta.create', ['id' =>  3])}}' --}}
                                    <a title="Generar venta" href="{{URL::route('cotizacion.edit', ['id' =>  $ven->idCotizacion, 'id2' => 1 ])}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-refresh"></span> </a>  

                                @else
                                    ANULADO
                                @endif
                            </td>
                        </tr>
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
        $("#cot").css("color", "orange");
    });
</script>
@endsection