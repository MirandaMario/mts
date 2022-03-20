@extends('layouts.admin')
@section('title','Reporte Compras')
@section('contenido')

<div class="panel panel-primary" style=" {{ config('constantes.FONT') }}">
    <div class="panel-heading">
        <p class="panel-title"> Seleccionar fecha para reporte de compras </p>
    </div>
    <div class="panel-body">
        {!! Form::open(array('url'=>'ingreso/rapdf','method'=>'get','autocomplete'=>'off','role'=>'search' , 'target' =>'_blank')) !!}
        {{Form::token()}}
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon bgd"><b><label class="a">Proveedor</label></b></div>
                    <input type="text" name="idproveedor" id="idproveedor" class="form-control"
                        placeholder="Ingrese el nombre de su proveedor" autofocus
                        value="{{isset($ingreso->nombre) ?  $ingreso->nombre : old('idproveedor')}}" />
                </div>
                <input type="hidden" id="idP" name="idP"
                    value="{{isset($ingreso->idpersona) ?  $ingreso->idpersona : old('idP')}}">
                <div id="ListaProveedores">
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <label>Desde: </label>
            <input type="text" placeholder="Seleccione fecha" name="fecha" readonly="readonly" id="check_in"
                value="{{$ldate = date('Y-m-d')}}" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="check_in">Hasta: </label>
                <input type="text" placeholder="Seleccione fecha" name="fecha2" readonly="readonly" id="check_out"
                    value="{{$ldate = date('Y-m-d')}}" class="form-control">
            </div>
        </div>
        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
            <label for="check_in">.. </label>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/ingreso/helper.js')}}"></script>
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

        $("#check_in").datepicker({
          onSelect: function(dateStr) {
              var minDate = $(this).datepicker('getDate');
              if (minDate) {
                  minDate.setDate(minDate.getDate() + 1);
              }
          /*     $('#check_out').datepicker('setDate', minDate).
              datepicker('option', 'minDate', minDate); */
          }
      });

      $('#check_out').datepicker().on("input click", function(e) {
          console.log("Fecha salida cambiada: ", e.target.value);
      });

      });
</script>
@endsection