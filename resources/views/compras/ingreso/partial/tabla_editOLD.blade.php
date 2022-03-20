@php $con = 0; $t = 0; $sutotal = array(); @endphp
@foreach ($detalles as $det)

    <tr class="selected" id="fila{{$con}}">
        <td class="text-center"><button type="button" class="btn btn-warning btn-xs"
                onclick="eliminar({{$con}});">x</button></td>
        <td><input class="outlinenone" type="hidden" name="idarticulo[]"
                value="{{$det->idarticulo}}">{{$det->articulo}}</td>
        <td class="text-center"><input class="outlinenone" size="5" name="cantidad[]"
                value="{{$det->cantidad}}" readonly></td>
        <td class="text-right"><input class="outlinenone" size="5" name="precio_compra[]"
                value="{{$det->precio_compra}}" readonly></td>
        <td class="text-right">{{number_format($det->cantidad*$det->precio_compra,2)}}</td>
        @php
        $t += $det->cantidad*$det->precio_compra;
        $sutotal[]= $det->cantidad*$det->precio_compra;
        @endphp
    </tr>
@php $con++; @endphp
@endforeach