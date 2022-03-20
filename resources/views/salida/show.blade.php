@extends('layouts.admin')
@section('title','Reporte Salidas')
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}" media="print" />
<style type="text/css">
    .pa {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
    <div class="panel-heading">
        SELECCIONE RANGO DE FECHA A CONSULTAR 
    </div>

    <div class="panel-body">
        {!! Form::open(array('url'=>'salida/reporte','method'=>'get','autocomplete'=>'off','role'=>'search',
        'target'=>'_blank')) !!}
 {{Form::token()}}
       
        <div >
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">

                    <label for="check_in">Desde: </label>
                    <input type="text" placeholder="Seleccione fecha" name="fecha" readonly="readonly" id="check_in"
                        value="{{$ldate = date('Y-m-d')}}" class="form-control">

                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">

                    <label for="check_in">Hasta: </label>
                    <input type="text" placeholder="Seleccione fecha" name="fecha2" readonly="readonly" id="check_out"
                value="{{$ldate = date('Y-m-d')}}" class="form-control">
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">

                    <label>Comprobante</label>
                    <select name="tipo_comprobante" class="form-control">
                        <option value="1">Ticket</option>
                        <option value="3">CCF</option>
                        <option value="2">Factura</option>
                        <option value="FC">Fac CCF</option>
                        <option value="%">Cualquiera</option>
                        
                    </select>
                </div>
            </div>
           
           {{--  @if (auth()->user()->rol == 1)
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label>Tienda</label>
                    <select name="tienda" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
            </div>
            @else
        <input type="hidden" name="tienda" value="{{auth()->user()->id_tienda}}">
            @endif --}}
            {{-- <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                <div class="form-group">
                    <label>CESC</label>
                    <select name="cesc" class="form-control">
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <label>&nbsp;</label>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Buscar
                    </button>
                </div>
            </div>
        </div> 
    </div>
    **Agrupación solo funciona en artículos
</div>
</div></div>


{{Form::close()}}

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(function() {
          var defaults = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults(defaults);

      $("#check_in,  #check_out").datepicker({   });

      });

</script>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>

@endsection