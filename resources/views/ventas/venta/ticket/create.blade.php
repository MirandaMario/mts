@extends('layouts.admin')
@section('title','Nuevo TICKET')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
<div class="row" {{-- style=" {{ config('constantes.FONT') }}" --}}>
    {!!Form::open(array('url'=>'venta','method'=>'POST','autocomplete'=>'off', 'id' =>'mf'))!!}
    {{Form::token()}}

    @if ($message = Session::get('venta->idventa'))
    <input type="hidden" id="venta_reciente" value="{{ $message }}">
    @endif

    {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
        TICKET&nbsp;&nbsp;&nbsp;{{$tienda->ticket}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date('d-m H:i')}}
        </div>
    </div> --}}
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:110%; height: 40px;">
                TICKET&nbsp;&nbsp;&nbsp;{{$tienda->ticket}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date('d/m H:i')}}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('/venta/create?id=2') }}"><button class="btn navbar-btn btv navbar-right"
                        type="button">Factura</button></a>
                <a href="create?id=3" style="text-align: right;"><button class="btn navbar-btn btv navbar-right"
                        type="button">CCF</button></a>
            </div>
            <div class="panel-body fixed-panel2">
                @include('ventas.venta.partial.comun_ticket')
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar" style="display: none;">
                        <div class="form-group text-right">

                            <button id="btnt" class="btn btn-success btn-sm m-t-10"
                                onclick="javascript: check();">GUARDAR</button>
                            <a href="{{ url('/venta') }}"><button  class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-body fixed-panel pa">
                <div>
                    <table id="detalles" class="table  table-bordered table-condensed" style="font-size:100%;">
                        <thead style="background-color: #A9D0F5;">
                            <th class="text-left" width="5%">-</th>
                            <th class="text-left" width="68%">Artículo</th>
                            <th class="text-center" class="text-center" width="5%">Can.</th>
                            <th class="text-right" width="5%">Des/U</th>
                            <th class="text-right" width="5%">Pre/U</th>
                            <th class="text-right" width="12%">Subtotal</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style=" padding: 0px 20px 0px 20px;">
        @include('ventas.venta.partial.parametros_venta')
    </div>
   
    {!!Form::close()!!}
</div>
@push('scripts')
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
{{-- <script src="{{asset('js/venta/helper.js')}}"></script> --}}
<script src="{{asset('js/venta/agregar_eliminar_ticket.js')}}"></script>
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
        console.log(id);
        if(id > 0){
            window.open('{{asset('venta')}}'+ "/"+ id, "", "width=400,height=600")
    } 
});
$("#ventabtn").css("background-color", "orange");    
    
    var cont=0;
    var total=0;
    var subtotal=[];

</script>

@endpush
@endsection
{{--312--}}