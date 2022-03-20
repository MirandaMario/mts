<div class="panel panel-primary">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover display compact" id="myTableCompras" style="font-size:100%;">
                <thead>
                    <th class="text-left" width="5%">ID</th>
                    <th class="text-left" width="12%">Fecha</th>
                    <th class="text-left" width="35%">Provedor</th>
                    <th class="text-left" width="5%">Comprobante</th>
                    <th class="text-right" width="10%">Total</th>
                    <th class="text-center" width="10%">Opciones</th>
                </thead>

                <tbody>
                    @foreach($ingresos as $ing)

                    <tr>
                        <td>{{$ing->idingreso}}</td>
                        <td>{{date('d/m/Y', strtotime($ing->fecha_hora))}}</td>
                        <td>{{$ing->nombre}}</td>
                        <td>{{$ing->tipo_comprobante}} {{$ing->num_comprobante}}</td>
                        <td class="text-right">$
                            @if ($ing->tipo_comprobante == "CCF")
                            {{number_format(($ing->total_ingreso*0.13)+$ing->total_ingreso, 2)}}
                            @else
                            {{$ing->total_ingreso}}
                            @endif
                        </td>
                        <td class="text-center">

                            @if ($ing->total_ingreso == 0)
                            ANULADO
                            @else
                            <a href="{{URL::action('IngresoController@show',$ing->idingreso)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                </span>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            @if ($ing->tipo_comprobante == 'CCF')
                            <a href="{{URL::action('IngresoController@edit2',$ing->idingreso)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span>
                            </a>
                            @else
                            <a href="{{URL::action('IngresoController@edit',$ing->idingreso)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span>
                            </a>
                            @endif

                            @endif
                        </td>
                    </tr>
                    @include('compras.ingreso.modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
