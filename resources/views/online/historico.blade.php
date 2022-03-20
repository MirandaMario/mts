@extends('online.master')
@section('title','Historico')
@section('content')
<div class="container">
    <br><br>
    <h5>HISTORIAL DE COMPRAS ,  PUNTOS ACUMULADOS Y CANJEADOS</h5>  
    <br>
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
<br><br><br>
@endsection