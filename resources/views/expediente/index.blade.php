@extends('layouts.admin')
@section('title','Expedientes')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading " style="font-size:150%; height: 40px;"> Expediente 
                <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                    <a href="expediente/create"><button class="btn btn-warning navbar-btn" {{-- id="nuevo" name="nuevo" --}} style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
              </p>
                @php
                function isMobileDevice() {
                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
                |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
                , $_SERVER["HTTP_USER_AGENT"]);
                }
                @endphp
                @if(isMobileDevice())
                {{-- @include('almacen.articulo.busqueda_movil') --}}
                @else
                {{-- @include('almacen.articulo.busqueda') --}}
                @endif
            </div>
            <div class="row " style=" white-space : normal; ">
                @if(isMobileDevice())
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa" style="position: absolute; ">

                    <table id="ListaProductos" name="ListaProductos" class="table table-sm" WIDTH="80%" {{-- --}}>
                    </table>

                </div>
                @else
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pa">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa">
                    <div id="gitarticulo" style="position: absolute; "></div>
                    <div id="ListaProductos" name="ListaProductos" style="position: absolute; text-align:right;"></div>
                </div>
                @endif

            </div>

            <div class="panel-body">
                <div>
                    <table class="table table-striped table-bordered  nowrap responsive" id="art" >
                        <thead>
                            <th class="text-center">No. Expediente</th>
                            <th class="text-center">Paciente</th>
                            <th class="text-center">Hab.</th>
                            <th class="text-left">Responsable</th>            
                            <th class="text-center">Edad</th>
                            <th class="text-center">Cel. Res</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody class="responsive">
                            @foreach($expedientes as $exp)
                        <tr>
                            <td class="text-center">{{$exp->numero_expediente}}</td>
                            <td class="text-center">darioq{{--$exp->nombre--}}</td>
                            <td class="text-center">{{$exp->habitacion}}</td>
                            <td class="text-center">{{$exp->id_cliente}}</td>
                            <td class="text-center">edad{{--$exp->id_cliente--}}</td>
                            <td class="text-center">{{$exp->tel_cliente}}</td>
                            <td class="text-center"><a href="{{URL::action('ExpedienteController@edit',$exp->id_expediente)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a>      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                                <a href="{{URL::action('ExpedienteController@show',$exp->id_expediente)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                </span>
                                </a></td> 

                            @endforeach
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
     
            $("#expediente").css("color", "orange");
            $('#art').DataTable({
      
                responsive: true,  
                language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
                },
       
        "order": [[ 1, "desc" ]],
        "aLengthMenu": [[100, 25, 50, 75, -1], [100, 25, 50, 75, "All"]],
        "iDisplayLength": 100
    });
});
    </script>
    @endsection