<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Notificacion de pedido</title>
</head>

<body>
    <p>{{$pedido->nombre}} </p>
    <p>{{$pedido->fecha}}</p>
    <p>{{$pedido->tel}}</p>
    <p>{{$pedido->direccion}} {{$pedido->MunName}} {{$pedido->DepName}}</p>
    <p>{{$pedido->tipo_pago == 'r2'?'Transferencia/Deposito':'Efectivo'}}</p>
    <p>{{$pedido->monto_compra}}</p>
    <p>{{$pedido->nume_transaccion}}</p>

  
    <table class="table table-striped table-sm" border="0" style="font-size:100%; width:70%;"
    align="left">
    <thead>
        <th class="text-center" width="5%">ID</th>
        <th class="text-center" width="25%">ARTICULO</th>
        <th class="text-center" width="5%">CANTIDAD</th>
        <th class="text-center" width="5%">DESCUENTO</th>
        <th class="text-center" width="5%">PRECIO</th>
    </thead>
    <tbody>
        @php $suma = 0; @endphp
        @foreach($detalle as $dep)
        <tr>
            <td class="text-center" width="5%"> {{$dep->id_articulo}}</td>
            <td class="text-left" width="25%">{{$dep->nombre}} {{$dep->nombreMarca}}
                {{$dep->nombreModelo}}</td>
            <td class="text-center" width="5%">{{$dep->cantidad_items}}</td>
            <td class="text-center" width="5%">{{$dep->descuento}} </td>
            <td class="text-right" width="5%">
                {{number_format(($dep->cantidad_items  * $dep->precio), 2, '.', ',')}}
                @php $suma += (($dep->cantidad_items)*($dep->precio)) @endphp</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center">
                <h4> Total </h4>
            </td>
            <td class="text-right">
                <h4><b> {{number_format($suma, 2, '.', ',')}} </b></h4>
            </td>
        </tr>
    </tfoot>
</table>
</body>

</html>