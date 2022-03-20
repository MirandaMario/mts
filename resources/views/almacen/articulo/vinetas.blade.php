@php $precio = precio($articulo , $varios) @endphp
<div style="text-align:center;">
    <table border="0" style="margin: auto;">
        @for ($i = 0; $i < $cantidad; $i++)
            <tr>
                <td style="text-align:center; height: {{$request->espacio}}mm;" >
                    <img src="data:image/jpg;base64,{{ base64_encode($barcode) }}" alt="{{ $articulo->codigo }}"
                        style="width: 38mm; height:10mm" {{-- width="38mm" height="20mm" --}}><br>
                    <font size=2>{{ $articulo->codigo }} {{ $articulo->nombreMarca }}
                        ${{ number_format($precio[0], 2, '.', ',') }}</font><br><b
                        style="font-size: 9px">{{ strtoupper($articulo->nombre . ' ' . $articulo->nombreModelo) }}</b>
                </td>
                @if ($request->columna == 2)
                    <td style="width:{{$request->ancho}}mm;"></td>
                    <td style="text-align:center; height: {{$request->espacio}}mm;" >
                        <img src="data:image/jpg;base64,{{ base64_encode($barcode) }}" alt="{{ $articulo->codigo }}"
                            style="width: 38mm; height:10mm"><br>
                            <font size=2>{{ $articulo->codigo }} {{ $articulo->nombreMarca }}
                            ${{ number_format($precio[0], 2, '.', ',') }}</font><br><b
                            style="font-size: 9px">{{ strtoupper($articulo->nombre . ' ' . $articulo->nombreModelo) }}</b>
                    </td>
                @endif
                
            </tr>
        @endfor
    </table>
</div>