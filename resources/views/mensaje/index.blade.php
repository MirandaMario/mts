@extends('layouts.admin')
@section('title','MENSAJES')
@section('contenido')
<!--<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet"/>-->
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa text-left">   
                   <h4> LISTADO DE MENSAJES </h4>
                </div>
            </div>
            
             <br>
                <div class="panel-body">
                    <div >
                        <table class="table table-striped table-bordered  responsive" id="myTable" style="font-size:100%;">
                            <thead>
                                <th class="text-left"   width="5%">ID</th>
                                <th class="text-center" >NOMBRE</th>
                                <th class="text-center" >EMAIL</th>
                                <th class="text-left"   >TELEFONO</th>
                                <th class="text-left"   >ASUNTO</th>
                                <th class="text-center" >SUS</th>
                                <th class="text-center" >ESTADO</th>
                                <th class="text-center" >OPCIONES</th>
                                <th class="text-center" >NOTAS</th>
                                <th class="text-center" >MJS</th>
                            </thead>
                            @php
                                
                               // dd($mensajes); 
                            @endphp
                         @foreach($mensajes as $men)
                            <tr>
                                <td>{{$men->id_mesaje}}</td>
                                <td>{{$men->nombre}}</td>
                                <td>{{$men->email}}</td>
                                <td>{{$men->telefono}}</td>
                                <td>{{$men->asunto}}</td>
                                
                                <td class="text-center">{{$men->suscrito}}</td>
                                <td class="text-center">{{$men->estado == null ? 'PENDIENTE' : 'REVISADO'}}</td>
                                <td class="text-center">
                                    <a href="{{URL::action('MensajeController@edit',$men->id_mesaje)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    @if (auth()->user()->rol == 1)
                                        <a href="{{URL::action('MensajeController@destroy',$men->id_mesaje)}}">

                                            <span aria-hidden="true" class="glyphicon glyphicon-minus-sign">
                                        </span>
                                        </a>
                                    @endif
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
                                    <a href="{{URL::action('MensajeController@show',$men->id_mesaje)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                    </span>
                                    </a> 
                                </td>
                                <td></td>
                                <td class="text-center">{{$men->mjs}}</td>
                               
                            </tr>
                           {{--  @include('ventas.cliente.modal') --}}
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
        $("#mensaje").css("color", "orange");
});
</script>
@endsection