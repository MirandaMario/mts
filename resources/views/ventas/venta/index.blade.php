@extends('layouts.admin')
@section('title','Histórico Ventas')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@if ($message = Session::get('venta->idventa'))
<input type="hidden" id="venta_reciente" value="{{ $message }}">
@endif
<div class="row " >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div id="dv1" style="position: absolute; width: 75px; left:40.1%;" class="float-none">

        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 65px;">
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa text-left">
                {!! Form::open(array('url'=>'venta','method'=>'get','autocomplete'=>'off','role'=>'search', 'id'=>'bhis',  "class"=>"form-inline")) !!}
                {{Form::token()}}
                <input type="number"  name="numero"  placeholder="Num Comprobante ..."    style="color:black;"/>
                <input type="text"  name="cliente" id="empresa" size="40"  placeholder="Ingrese cliente ..."   style="color:black;"/>
                <input type="hidden" name="idcliente" id="idcliente" value=""  />
                <input type="submit" value="buscar"  style="color: black;" />
                <div id="gitcliente" style=" position: absolute;"></div>
                <div id="ListaClientes">
                </div>
                {{Form::close()}} 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa text-right">    
                {{-- &nbsp; &nbsp; &nbsp; &nbsp; <span style="font-size: 20px;">Histórico ventas</span>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                    <a href='{{ route('venta.create', ['id' =>  1])}}'> <button class="btn  btn-sm">TICKET</button></a>
                    <a href='{{ route('venta.create', ['id' =>  2])}}'> <button class="btn  btn-sm">FACTURA</button></a>
                    <a href='{{ route('venta.create', ['id' =>  3])}}'> <button class="btn  btn-sm">CCF</button></a>
                    
                </div>
        </div>
      
        
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover   display  compact  nowrap responsive" id="myTable" style="font-size:100%; width:100%;">
                        <thead>
                            @php $rol = auth()->user()->rol @endphp
                            <th class="text-left" width="5%">ID</th>
                            <th class="text-left" width="10%">Fecha</th>
                            {!!($rol == 1 ? "<th class='text-center' width='2%'>NT</th>" : "")!!}
                            <th class="text-left" width="3%">V</th>
                            <th class="text-left" width="35%">Cliente</th>
                            <th class="text-center" width="5%">TEL</th>
                            <th class="text-center" width="5%">Tipo</th>
                            <th class="text-center" width="5%">N°</th>
                            <th class="text-center" width="5%">E_P</th>
                            <th class="text-center" width="5%">E_I$</th>
                            <th class="text-center" width="5%">E$</th>
                            <th class="text-right" width="5%">Total</th>
                            <th class="text-center" width="10%">Opciones</th>
                            <th class="text-center">Transporte</th>
                            <th class="text-center" width="10%">F_Pago</th>
                            <th class="text-center" width="10">#GUIA</th>
                            <th class="text-center" >Notas</th>
                            <th class="text-center" >Detalle</th>

                        </thead>
                        @foreach($ventas as $ven)
                        <tr>
                            <td  class="fila{{$ven->idventa}}">{{$ven->idventa}}</td>
                            {{-- <td>{{date('d-m-Y H:i',(strtotime($ven->fecha_hora)))}}</td> --}}
                            <td>{{date('d-m-Y H:i',(strtotime($ven->created_at)))}}</td>
                            {!!( $rol == 1 ? "<td width='2%'>$ven->idtienda</td>" : "")!!}
                            <td>{{-- {{$ven->idusuario}} --}}
                            @if ($rol == 1)
                                <input class="ve" id="ve{{$ven->idventa}}" fila={{$ven->idventa}}  type="number"  style="width:20px;border:none; text-align:left; " step="1"  value="{{$ven->idusuario}}">
                            @else
                                {{$ven->idusuario}}                               
                            @endif    
                            </td>
                            <td>{{-- <b><a style="color:black;"
                                href="{{URL::action('VentaController@vineta',['id' => $ven->idventa ])}}" target="_blank">
                                {{$ven->nombre}}</a></b> --}}{{$ven->nombre}}
                            
                            </td>
                            <td>{{$ven->tel}}</td>
                            <td class="text-right" >
                                {{-- <a href="{{URL::action('VentaController@show4',$ven->idventa)}}"> --}}
                                    @if($ven->tipo_comprobante == 1 )     <span class="vd" fila={{$ven->idventa}}> Ticket   </span>
                                    @elseif($ven->tipo_comprobante == 2 ) <span class="vd" fila={{$ven->idventa}}> Factura  </span>
                                    @elseif($ven->tipo_comprobante == 3 ) <span class="vd" fila={{$ven->idventa}}> CCF      </span>
                                    @elseif($ven->tipo_comprobante == 4 ) <span class="vd" fila={{$ven->idventa}}> Vcotiza  </span>
                                    @endif {{-- </a> --}} 
                            </td>
                            <td class="text-center">{{$ven->num_comprobante}}</td>
                            <td class="text-center">{{$ven->estado_pago}}</td>
                            <td class="text-center">
                                <input class="e_i" id="e_i{{$ven->idventa}}"  fila={{$ven->idventa}}  type="number"  style="width:30px;border:none; text-align:left; " step="0.01"  value="{{$ven->envio_interno}}"></td>
                            <td class="text-center">
                                <input class="e" id="e{{$ven->idventa}}"  fila={{$ven->idventa}}  type="number"  style="width:30px;border:none; text-align:left; " step="0.01"  value="{{$ven->envio}}"></td>
                            </td>
                            <td class="text-right">{{$ven->total_venta}}</td>
                            <td class="text-center">

                                @if ($ven->total_venta == 0) Anulado

                                @elseif($ven->estado == 'Reporte')
                                Reporte
                                @else {{--SHOW--}}

                                <a href="{{URL::action('VentaController@show',$ven->idventa)}}" target="_blank">
                                    <span aria-hidden="true" class="glyphicon glyphicon-sunglasses"></span> </a>

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{--EDIT--}}
                                <a href="{{URL::action('VentaController@edit',$ven->idventa)}}"  >
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span> </a>

                                @endif
                            </td>
                            <td class="text-center">
                                @if ($ven->transporte != null)
                                    @if     ($ven->transporte == '4')
                                        N/A
                                    @elseif ($ven->transporte == '1')
                                        Propio 
                                    @elseif ($ven->transporte == '2')
                                        Local  
                                    @else  
                                        Guia
                                    @endif
                                @endif


                               {{--  @if ($ven->transporte != null)
                                    <select name="transporte">
                                        <option value="0" {{ $ven->transporte == '0' ? 'selected' : " "}}> N/A</option>
                                        <option value="1" {{ $ven->transporte == '1' ? 'selected' : " "}}> Propio</option>
                                        <option value="2" {{ $ven->transporte == '2' ? 'selected' : " "}}> Local</option>
                                        <option value="3" {{ $ven->transporte == '3' ? 'selected' : " "}}> Guia</option>
                                    </select>
                                @endif --}}
                            </td>
                            <td class="text-center">
                                @if($ven->forma_pago  == 4)
                                        Efectivo 
                                @elseif($ven->forma_pago ==  1)
                                    Electronica / POS
                                @elseif($ven->forma_pago ==  2)
                                    Guia 
                                @elseif($ven->forma_pago ==  3)
                                    Cheque
                                @elseif($ven->forma_pago ==  5)
                                    Transferencia  
                                @elseif($ven->forma_pago ==  6)
                                    Chivo      
                                @else 
                                @endif
                               {{--  @if ($ven->forma_pago != null)
                                    <select name="forma_pago">
                                        <option value="0" {{ $ven->forma_pago == '0' ? 'selected' : "" }}> Efectivo</option>
                                        <option value="1" {{ $ven->forma_pago == '1' ? 'selected' : "" }}> Electronica</option>
                                        <option value="2" {{ $ven->forma_pago == '2' ? 'selected' : "" }}> Guia</option>
                                        <option value="3" {{ $ven->forma_pago == '3' ? 'selected' : "" }}> Cheque</option>
                                    </select>
                                @endif --}}
                            </td>
                            
                            <td class="text-center">
                                <input class="ng" id="ng{{$ven->idventa}}" fila={{$ven->idventa}}  type="text"  style="width:100px;border:none; text-align:left; " step="1"  value="{{$ven->nguia}}">
                                </td>
                            <td class="text-center">{!!$ven->notas!!}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/venta/asincronos_index.js')}}"></script>
<script>
    $(document).ready(function(){
                $("#ventabtn").css("background-color", "orange"); 
                var id =$("#venta_reciente").val()*1;     
                   
     if(id > 0){
         window.open('{{asset('venta')}}'+ "/"+ id, "", "width=1200,height=700")   
     }    
        });          
</script>
@endsection