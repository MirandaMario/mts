<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover display compact" id="myTableVentas" style="font-size:100%;">
                        <thead>
                            <th class="text-left" width="5%">ID</th>
                            <th class="text-left" width="5%">Fecha</th>
                            <th class="text-left" width="35%">Cliente</th>
                            <th class="text-center" width="10%">Tipo</th>
                            <th class="text-center" width="10%">Número</th>
                            <th class="text-right" width="5%">Total</th>
                            <th class="text-center" width="7%">Opciones</th>
                        </thead>
                        @foreach($ventas as $ven)
                        <tr>
                            <td>{{$ven->idventa}}</td>
                            <td>{{$ven->fecha_hora}}</td>
                            <td>{{$ven->nombre}}</td>
                            <td class="text-center">
                                @if($ven->tipo_comprobante == '1' && $ven->total_venta > 0 )
                                <a href="{{URL::action('VentaController@show4',$ven->idventa)}}">
                                    <span> Ticket
                                    </span>
                                </a>
                                @elseif($ven->tipo_comprobante == '2'&& $ven->total_venta > 0 )
                                <a href="{{URL::action('VentaController@show4',$ven->idventa)}}">
                                    <span> Factura
                                    </span>
                                </a>
                                @elseif($ven->tipo_comprobante == '3')
                                <a href="{{URL::action('VentaController@show4',$ven->idventa)}}">
                                    <span> CCF
                                    </span>
                                </a>
                                @endif
                            </td>

                            <td class="text-center">{{$ven->num_comprobante}}</td>


                            <td class="text-right">@if($ven->tipo_comprobante === '3')
                                {{ number_format(($ven->total_venta * 0.13) + $ven->total_venta , 2)}}
                                @else
                                {{$ven->total_venta}}
                                @endif
                            </td>
                            {{-- Opciones  --}}
{{-- 
                            <td class="text-center">

                                @if ($ven->total_venta == 0) Anulado @else
                                @if($ven->tipo_comprobante == '1')
                                <a href="{{URL::action('VentaController@show',$ven->idventa)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                    </span>
                                </a>
                                @elseif($ven->tipo_comprobante == '2')
                                <a href="{{URL::action('VentaController@show2',$ven->idventa)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                    </span>
                                </a>
                                @elseif($ven->tipo_comprobante === '3')
                                <a href="{{URL::action('VentaController@show3',$ven->idventa)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                    </span>
                                    @endif
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @if($ven->tipo_comprobante === '3')

                                    <a href="{{URL::action('VentaController@edit2',$ven->idventa)}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                        </span>
                                    </a>
                                    @else
                                    <a href="{{URL::action('VentaController@edit',$ven->idventa)}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                        </span>
                                    </a>
                                    @endif
                                    @endif
                            </td> --}}
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
