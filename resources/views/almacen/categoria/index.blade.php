@extends('layouts.admin')
@section('title','Categorías')
@section('contenido')
@include('almacen.categoria.create') 

<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

<div class="row" style="{{ config('constantes.FONT') }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
        <div class="panel-heading" style="font-size:150%; height: 40px;">
               Categorías
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
                            <th class="text-left" width="5%">Id</th>
                            <th class="text-left" width="20%">Nombre</th>
                            <th class="text-center" width="10%">Descuento</th>
                            <th class="text-center" width="20%">Slug</th>
                            <th class="text-center" width="10%">Estado</th>
                            <th class="text-center" width="10%">Opciones</th>
                        </thead>
                        <tbody>
                     @foreach($categorias as $cat)
                        <tr>
                            <td>{{$cat->idcategoria}}</td>
                            <td>{{$cat->nombreCategoria}}</td>
                            <td>{{$cat->descuento_cat}}</td>
                            <td>{{$cat->cslug}}</td>
                            <td class="text-center">{{$cat->condicion}}</td>
                            <td class="text-center"> {{-- <a href="" data-target="#modal-edit-{{$cat->idcategoria}}" data-toggle="modal">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span> </a> --}}

                                <a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}" target="_blank">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                </a>
                                &nbsp; &nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal">
                                    <span aria-hidden="true" class="glyphicon glyphicon-minus-sign"> </span> </a>
                            </td>
                        </tr>
              {{-- @include('almacen.categoria.edit') --}}
              @include('almacen.categoria.delete') 
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