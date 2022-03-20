@extends('online.master')
@section('title','SEGUIMIENTO')
@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Seguimiento de Orden</h2>
                    <p>Su pedido en muy importante</p>
                </div>
                <div class="page_link">
                    <a href="index.html">Home</a>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Tracking Box Area =================-->
<section class="tracking_box_area section_gap">
    <div class="container">
        <div class="tracking_box_inner">
            <p>Para rastrear su pedido, ingrese el ID que le fue entregado al momento de hacerlo  y el correo electronico con el que se registro . 
                Este ID tambien fue enviado al correo con el que realizo su pedido 
            </p>
            {!!Form::open(array('url'=>'seguimiento','method'=>'GET','autocomplete'=>'off' ,  'class'=>'row tracking_form' ))!!}
            {{Form::token()}}
                <div class="col-md-12 form-group">
                    <input type="number" step="1" class="form-control"  name="id" placeholder="ID Pedido" required>
                </div>
                <div class="col-md-12 form-group">
                    <input type="email" class="form-control" name="email" placeholder="Correo Registrado" required>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" value="submit" class="btn submit_btn">SEGUIMIENTO DE  PEDIDO</button>
                </div>
            {!!Form::close()!!}
        </div>
        <br>
        <div class="row col-lg-8">
            @isset($pedido)
            <br>
            <table class="table table-sm table-striped  ">
                <tr>
                    <td>ID PEDIDO</td>
                    <td>{{$pedido->id_pedido}} </td>
                </tr>
                <tr>
                    <td>NOMBRE</td>
                    <td>{{$pedido->nombre}} {{$pedido->apellido}} </td>
                </tr>
                <tr>
                    <td>TEL</td>
                    <td> {{$pedido->telefono}} </td>
                </tr>
                <tr>
                    <td>FECHA DE PEDIDO</td>
                    <td> {{$pedido->fecha}} </td>
                </tr>
                <tr>
                    <td>DIRECCION</td>
                    <td>{{$pedido->direccion}} {{$pedido->MunName}} {{$pedido->DepName}} </td>
                </tr>
                <tr>
                    <td>TIPO PAGO</td>
                    <td>{{$pedido->tipo_pago == 'r2'?'Transferencia/Deposito':'Efectivo'}}   {{$pedido->monto_compra}} </td>
                </tr>
            </table>

            
            <p><h4>{{strtoupper($pedido->estado_nombre)}}</h4></p>
            @endisset
            @isset($mjs)
            <br>
            <h4>{{$mjs}}</h4>
            @endisset
        </div>
    </div>
</section>
<!--================End Tracking Box Area =================-->
@endsection