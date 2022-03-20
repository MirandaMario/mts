@extends('layouts.admin')
@section('title','Listado Clientes')
@section('contenido')
<!--<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet"/>-->
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Listado de Clientes
                <p class="navbar-text navbar-right" style="margin-top: 1px; text-align: right;">
                  <a href="cliente/create"><button class="btn btn-warning navbar-btn" id="nuevo" name="nuevo" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" type="button">Nuevo</button></a>
                </p>
            </div>
             <br>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fac.</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Compra</th>
                                    <th scope="col">Puntos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $p=0 ;$c=1 ;  @endphp
                                @foreach ($compras as $item)
                                <tr>
                                    <th scope="row">{{$c}}</th>
                                    <td>{{$item->num_comprobante}}</td>
                                    <td>{{date('d-m-Y',(strtotime($item->fecha_hora)))}}</td>
                                    <td>{{$item->total_venta}}</td>
                                    <td>{{$item->puntos}}</td>
                                    @php $p+= $item->puntos;  $c++;  @endphp
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" class="text-right">Puntos Disponibles</td>
                                    <td> <b> {{$p}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

    
<script>
    
    $(document).ready(function(){
        $("#varios").css("color", "orange");
});
</script>
@endsection
