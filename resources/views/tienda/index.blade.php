@extends('layouts.admin')
@section('title','Configuracion')
@section('contenido')

<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    <div class="row" style="{{ config('constantes.FONT') }}">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
            <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
            Tiendas
        </div>
        <div class="panel-body">
            <table class="display responsive nowrap compact " id="myTable" style="font-size:90%;" border="0">
                <thead>
                    <th class="text-left">ID</th>
                    <th class="text-left">Tienda </th>
                    <th class="text-left">Cotización </th>
                    <th class="text-left">N°Tickec </th>
                    <th class="text-left">N°Factura </th>
                    <th class="text-left">N°CCF </th>
                  {{--   <th class="text-left" width="10%">Resolución </th>
                    <th class="text-left" width="10%">Rango </th>
                    <th class="text-left" width="10%">Fecha Resolución </th>   --}}              
                    <th class="text-left">Dirección </th>
                    
               
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                    @foreach($tienda as $ti)
                    <tr>
                        <td>{{$ti->id}}</td>
                        <td>{{$ti->nombreTienda}}</td>
                        <td>{{$ti->cotizacion}}</td>
                        <td>{{$ti->ticket}}</td>
                        <td>{{$ti->factura}}</td>
                        <td>{{$ti->ccf}}</td>
                 {{--        <td>{{$ti->resolucion}}</td>
                        <td>{{$ti->rango}}</td>
                        <td>{{$ti->fecharesolucion}}</td> --}}
                        <td>{{$ti->direccion}}</td>
                      
                        <td align="center"> <a href="{{URL::action('TiendaController@edit',$ti->id)}}"
                            data-toggle="modal">

                            <span aria-hidden="true"> EDITAR
                                </span>
                        </a>
                    
                           
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