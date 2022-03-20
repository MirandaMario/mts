@extends('layouts.admin')
@section('title','Pedidos_')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Histórico de Pedidos
            </div>
            <div class="panel-body">
                <table class="display responsive  " id="myTable" {{-- id="art" --}}
                    style="font-size:100%;">
                    <thead>
                        <th class="text-left" width="5%">ID</th>
                        <th class="text-center" width="20%">Nombre </th>
                        <th class="text-center" width="10%">Email</th>
                        <th class="text-center" width="5%">Teléfono</th>
                        <th class="text-center" width="10%">Dirección</th>
                        <th class="text-center" width="10%">Mun/Dep</th>
                        <th class="text-center" >Tipo_pago</th>
                        <th class="text-center" width="10%">Transacción #</th>
                        <th class="text-center">Monto</th>
                        <th class="text-center" width="10%">Fecha</th>
                      
                        
                        <th class="text-center" width="10%">Opciones</th>
                        <th class="text-center" width="80%">Notas</th>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $p)
                        <tr>
                            <td class="text-center"> {{$p->id_pedido}}</td>
                            <td class="text-left">{{$p->nombre}}</td>
                            <td class="text-left">{{$p->email}}</td>
                            <td class="text-left">{{$p->tel}}</td>
                            <td class="text-left">{{$p->direccion}}</td>
                            <td class="text-left">{{$p->MunName}} {{$p->DepName}}</td>
                            <td class="text-left">@if ($p->tipo_pago == "r1")
                                Efectivo
                                @else
                                Transferencia/Déposito
                                @endif
                            </td>
                            <td class="text-left"   >{{$p->nume_transaccion}}</td>
                            <td class="text-right"  >$ {{$p->monto_compra}}</td>
                            <td class="text-left"   >{{$p->fecha}}</td>
                            
                            <td class="text-center" ><a
                                    href="{{URL::action('PedidoController@edit',$p->id_pedido)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span> </a></td>

                            <td class="text-left"   >{{$p->notas}}</td>        
                        </tr>
                        @endforeach

                        @foreach($pedidosl as $p)
                        <tr>
                            <td class="text-center"> {{$p->id_pedido}}</td>
                            <td class="text-left">{{$p->pnombre}}</td>
                            <td class="text-left">{{$p->pemail}}</td>
                            <td class="text-left">{{$p->ptel}}</td>
                            <td class="text-left">{{$p->pdireccion}}</td>
                            <td class="text-left">{{$p->MunName}} {{$p->DepName}}</td>
                            <td class="text-left">@if ($p->tipo_pago == "r1")
                                Efectivo
                                @else
                                Transferencia/Déposito
                                @endif
                            </td>
                            <td class="text-left"   >{{$p->nume_transaccion}}</td>
                            <td class="text-right"  >$ {{$p->monto_compra}}</td>
                            <td class="text-left"   >{{$p->fecha}}</td>
                            
                            <td class="text-center" ><a
                                    href="{{URL::action('PedidoController@edit',$p->id_pedido)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span> </a></td>
                            <td class="text-left"   >{{$p->notas}}</td>        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- 
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#articulos").css("background-color", "orange");    
$('#art').DataTable({ 
    "order": [[ 0, "desc" ]]

}); 
});
</script> --}}


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#ped").css("color", "orange");
    });
</script>

@endsection