@extends('layouts.admin')
@section('title','Editar Pedido')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
<div class="row" >
    <div >
        <div class="col-md-12 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:150%; height: 40px;">
                    Editar Pedido N° {{$pedido->id_pedido}}
                </div>
                <div class="panel-body">
                    {!!Form::model($pedido,['method'=>'PATCH','route'=>['pedido.update',$pedido->id_pedido],'files'=>'true'])!!}
                    {{Form::token()}}

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Nombre</label>
                                <input type="text" readonly value="{{$pedido->nombre}} "
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="email" class="apa">Correo electrónico</label>
                                <input type="text" readonly value="{{$pedido->email}}" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12  pa">
                            <div class="form-group">
                                <label for="fecha_transacción" class="apa">Fecha </label>
                                <input type="text" readonly value="{{$pedido->fecha}}" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Teléfono</label>
                                <input type="text" readonly value="{{$pedido->tel}}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <label for="direccion" class="apa">Dirección</label>
                                <input type="text" readonly value="{{$pedido->direccion}}" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Municipio</label>
                                <input type="text" readonly value="{{$pedido->MunName}}" class="form-control" />
                                <input type="hidden" name="id_municipio" value="{{$pedido->ID}}" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Departamento</label>
                                <input type="text" readonly value="{{$pedido->DepName}}" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="estado" class="apa">Estado</label>
                                <select class="form-control" name="estado">
                                    @foreach ($estados as $item)
                                    <option value="{{$item->Id}}" {{$item->Id == $pedido->estado ? "selected" : "" }}>
                                        {{$item->estado_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="tipo_pago" class="apa">Tipo Pago</label>
                                <input type="text" readonly
                                    value="{{$pedido->tipo_pago == 'r2'?'Transferencia/Deposito':'Efectivo'}}"
                                    class="form-control" />

                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="monto_compra" class="apa">Monto_compra</label>
                                <input type="number" readonly value="{{$pedido->monto_compra}}" step="0.01"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="monto_compra" class="apa">Transacción #</label>
                                <input type="number" readonly value="{{$pedido->nume_transaccion}}"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="id_banco" class="apa">Banco</label>
                                <input type="text" readonly value="{{$pedido->id_banco = '1'? 'BA' : 'BAC'}}"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="fecha_transaccion" class="apa">Fecha_transacción</label>
                                <input type="text" value="{{$pedido->fecha_transaccion}}" class="form-control"
                                    readonly />
                            </div>
                        </div>
                    </div>

                    <div class=row>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <label for="notas" class="apa">Observaciones</label>
                                <textarea name="notas" value="{{$pedido->notas}}" cols="80" rows="4"
                                    class="form-control">{{$pedido->notas}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <label for="notasint" class="apa">Notas internas</label>
                                <textarea name="notasint" value="{{$pedido->notasint}}" cols="80" rows="4"
                                    class="form-control">{{$pedido->notasint}}</textarea>
                            </div>
                        </div>
                    </div>

                    @php
                    $suma = 0;
                    @endphp

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
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
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa">
                            <br><br><br>
                            <button class="btn btn-success btn-sm m-t-10" type="submit">Actualizar</button>
                            <a href="{{ url('/pedido') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">Cancelar</button></a> <button class="btn btn-warning btn-sm m-t-10"
                                type="reset">Reset</button>
                        </div>
                    </div>

                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
        @endsection {{--477--}}