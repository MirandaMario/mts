@extends('layouts.admin')
@section('title','REPORTE REMESAS')
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}" media="print" />
<style type="text/css">
  .pa {
    padding-left: 5px;
    padding-right: 5px;
  }
</style>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
    <div class="panel panel-primary">
      <div class="panel-heading">
        SELECCIONE RANGO DE FECHA A CONSULTAR
      </div>
      <div class="panel-body">
        {!! Form::open(array('url'=>'transaccion/reporte','method'=>'get','autocomplete'=>'off','role'=>'search',
        'target'=>'_blank')) !!}
        {{Form::token()}}
        <div>
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <label>Cuenta</label>
            <select name="idBanco" id="idBanco" class="form-control" required>
              <option value="%">Todas las cuentas</option>
                @foreach($cuentas as $cuenta)
                <option value="{{$cuenta->id}}">
                    {{$cuenta->nombreCuenta}}
                </option>
                @endforeach
            </select>
          </div>
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
            <label>&nbsp;</label>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                Buscar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
@endsection