@extends('layouts.admin')
@section('title','Resoluciones')
@section('contenido')
@include('resolucion.create') 

<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
        <div class="panel-heading" style="font-size:150%; height: 40px;">
               Resoluciones
            <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                  <a href="" data-target="#formCategoriaModal" data-toggle="modal">
                      <button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" 
                      type="button">Nuevo</button></a>
            </p>
        </div>
        <br>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover display compact" id="myTable3" style="font-size:100%;">
                        <thead>
                            <th class="text-left"  >Id</th>
                            <th class="text-left"  >T_C</th>
                            <th class="text-center">Desde</th>
                            <th class="text-center">Hasta</th>
                            <th class="text-center">N_RES</th>
                            <th class="text-center">S_RES</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Tienda</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                     @foreach($resoluciones as $r)
                        <tr>
                            <td>{{$r->id_resolucion}}</td>
                            <td>
                                @if ($r->tipo_documento == 1)
                                    TIC
                                @elseif($r->tipo_documento == 2)
                                    FAC
                                @else
                                    CCF
                                @endif
                            </td>
                            <td>{{$r->rango_desde}}</td>
                            <td>{{$r->rango_hasta}}</td>
                            <td class="text-center">{{$r->numero_resolucion}}</td>
                            <td class="text-center">{{$r->serie_resolucion}}</td>
                            <td class="text-center">{{$r->fecha_resolucion}} </td>
                            <td class="text-center">{{$r->estado_res}}</td>
                            <td class="text-center">{{$r->tienda_res}}</td>
                            <td><a href="{{URL::action('ResolucionController@edit',$r->id_resolucion)}}" target="_blank">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a>
                            </td>   
                        </tr>
            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
    $('#myTable').DataTable({
        "order": [[ 0, "desc" ]],
        "aLengthMenu": [[13, 25, 50, 75, -1], [13, 25, 50, 75, "All"]],
        "iDisplayLength": 13,
    });
});

</script>


<script> 
    $(document).ready(function(){
        $("#varios").css("color", "orange");
    });
</script>


@endsection