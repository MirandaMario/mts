@extends('layouts.admin')
@section('title','Venta Factura')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
@include('ventas.cliente.create_modal')
<div class="row " {{-- style=" {{ config('constantes.FONT') }}" --}}>
    @if ($message = Session::get('venta->idventa'))
    <input type="hidden" id="venta_reciente" value="{{ $message }}">
    @endif
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">FACTURA&nbsp;&nbsp;&nbsp;
                <span id="precios"></span> <a href="{{ url('/venta/create?id=1') }}">
                    <button class="btn navbar-btn btv navbar-right" type="button">Ticket</button></a>
                <a href="create?id=3" style="text-align: right;">
                    <button class="btn navbar-btn btv navbar-right" type="button">CCF</button></a>
            </div>
            <div class="panel-body">
                {!!Form::open(array('url'=>'venta','method'=>'POST','autocomplete'=>'off', 'id' =>'mf'))!!}
                {{Form::token()}}
                @include('ventas.venta.partial.comun_factura')
                <tfoot>
                    <th colspan="4"></th>
                    <th>
                        <h5 class="text-right"><b>Total</b></h5>
                    </th>
                    <th>
                        <h5 type="hidden" class="text-right" id="sumas">0.00</h5>
                    </th>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa" id="guardar" style="display: none;">
            <div class="form-group">
                <button id="btnt" class="btn btn-success btn-sm m-t-10" onclick="javascript: check();">GUARDAR</button>
                <a href="{{ url('/venta') }}"><button class="btn btn-primary btn-sm m-t-10"
                        type="button">CANCELAR</button></a>
            </div>
        </div>
    </div>
    @include('ventas.venta.partial.parametros_venta')
    {!!Form::close()!!}
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
{{-- <script src="{{asset('js/venta/helper.js')}}"></script> --}}
<script src="{{asset('js/venta/agregar_eliminar_factura.js')}}"></script>
<script type="text/javascript">
    $("#ventabtn").css("background-color", "orange");         
    var cont=0;
    var total=0;
    var subtotal=[];
</script>
<script>
    $( document ).ready(function() {

        $('#mf').keypress(function(e){   
        if(e == 13){
          return false;
        }
      });
    
      $('input').keypress(function(e){
        if(e.which == 13){
          return false;
        }
      });

        var id =$("#venta_reciente").val()*1;         
        if(id > 0){
            window.open('{{asset('venta')}}'+ "/"+ id, "", "width=1200,height=700")
    } 
});
</script>
@endsection