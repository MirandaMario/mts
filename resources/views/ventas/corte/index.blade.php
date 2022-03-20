@extends('layouts.admin')
@section('title','RPT VENTAS')
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
        {!! Form::open(array('url'=>'corte/create','method'=>'get','autocomplete'=>'off','role'=>'search',
        'target'=>'_blank')) !!}

        <div class="form-check form-check-inline">
            <label class="checkbox-inline-lg">
                <input type="radio" class="form-check-input" value="1" name="optradio"
                    checked>&nbsp;&nbsp;Comprobantes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" value="2" name="optradio">&nbsp;&nbsp;Artículos
            </label>
        </div>
        <div >
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">

                    <label for="check_in">Desde: </label>
                    <input type="text" placeholder="Seleccione fecha" name="fecha" readonly="readonly" id="check_in"
                        value="{{$ldate = date('Y-m-d')}}" class="form-control">

                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">

                    <label for="check_in">Hasta: </label>
                    <input type="text" placeholder="Seleccione fecha" name="fecha2" readonly="readonly" id="check_out"
                value="{{$ldate = date('Y-m-d')}}" class="form-control">
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">

                    <label>Comprobante</label>
                    <select name="tipo_comprobante" class="form-control">
                        <option value="1">Ticket</option>
                        <option value="3">CCF</option>
                        <option value="2">Factura</option>
                        <option value="FC" selected>Fac CCF</option>
                        <option value="%" >Cualquiera</option>
                        
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                <div class="form-group">
                    <label class="apa">Categoría</label>
                    <select name="idcategoria" id="idCategoria" class="form-control">
                        <option value="%" selected>N/A</option>
                        @foreach($categorias as $cat)
                        <option value="{{$cat->idcategoria}}">
                            {{$cat->nombreCategoria}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">

                    <label>Agrupación</label>
                    <select name="agrupacion" class="form-control">
                        <option value="no">No</option>
                        <option value="si">Si</option>

                    </select>
                </div>
            </div> --}}
            @if (auth()->user()->rol == 1)
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">
                    <label>Tienda</label>
                    <select name="tienda" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">
                    <label>Vendedor</label>
                    <select name="vendedor" class="form-control">
                        <option value="%">NA</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            @else
        <input type="hidden" name="tienda" value="{{auth()->user()->id_tienda}}">
            @endif
            {{-- <div class="col-lg-1 col-sm-1 col-md-1 col-xs-6">
                <div class="form-group">
                    <label>CESC</label>
                    <select name="cesc" class="form-control">
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 ">
                <div class="form-group">
                    <label class="apa">Tipo &nbsp;</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="%" selected> NA </option>
                        <option value="0" selected> Articulo Comun </option>
                        <option value="1" > Articulo Externo </option>
                        <option value="2" > Servicio </option>
                        <option value="3" > Servicio Interno</option>
                    </select>
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
    **TIPO APLICA SOLO PARA ARTICULOS <BR>
    **CATEGORIA APLICA SOLO PARA ARTICULOS <BR>
    **SI EL ARTICULO NO POSEE UN INGRESO "COMPRA" NO SERA MOSTRADO EN EL REPORTE POR ARTICULOS
</div>
</div></div>

<div id="muestra">
    <div class="row pa" >
        <div class="panel panel-primary pa">

            <p class="text-center"> HISTORIAL DE CORTES </p>
            <br>
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%">
                <thead>
                    <tr>
                        <th HEIGHT="25" class="text-left"  width="3%"># </th>
                        <th class="text-center" width="5%">Tienda</th>
                        <th class="text-center" width="5%">Fecha </th>
                        <th class="text-center" width="8%">T. Corte </th>
                        <th class="text-center" width="8%">Correlativo</th>
                        <th class="text-center" width="8%">Desde T.</th>
                        <th class="text-center" width="8%">Hasta T.</th>
                        <th class="text-center" width="8%">V. Exen.</th>
                        <th class="text-center" width="8%">V. N/S</th>
                        <th class="text-center" width="8%">V. Grav.</th>
                        <th class="text-center" width="8%">V. Dev.</th>                           
                        <th class="text-center" width="8%">T. Ventas</th>
                        <th class="text-center" width="10%">Opc.</th>
                    </tr>

                </thead>
                <tbody>
                    @php $i2 = 0; $i = 1; @endphp
                    @foreach($cortes as $cor)
                    <tr>
                        <td class="text-left" width="3%">{{$cor->id_corte}}</td>
                        <td class="text-center" width="5%">{{$cor->id_tienda}}</td>
                        <td class="text-center" width="5%">{{date('d/m/y' , strtotime($cor->fecha_ejec))}}</td>
                        <td class="text-center"   width="8%">
                            @if ($cor->tipo_corte == 1)
                                DIARIO
                            @elseif ($cor->tipo_corte == 2)
                                PARCIAL
                            @else
                                MENSUAL 
    
                            @endif </td>
                        <td class="text-center" width="8%">{{$cor->correlativo}}</td>
                        <td class="text-center" width="8%">{{$cor->ticket_desde}}</td>
                        <td class="text-center" width="8%">{{$cor->ticket_hasta}}</td>
                        <td class="text-right"  width="8%">{{$cor->exentas}}</td>
                        <td class="text-right"  width="8%">{{$cor->no_sujetas}}</td>
                        <td class="text-right"  width="8%">{{$cor->gravadas}}</td>
                        <td class="text-right"  width="8%">{{$cor->devolucion}}</td>
                        <td class="text-right"  width="8%">{{number_format($cor->total_venta, 2, '.', ',')}}</td>
                        @php $i2 += $cor->total_venta @endphp
                        <th class="text-center"  width="10%"> <a href="{{URL::action('CorteController@show', $cor->id_corte)}}" target="_blank" >

                            <span aria-hidden="true" class="fa fa-print" aria-hidden="true">
                            </span>
                        </a></th>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
            <br>
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

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>

@endsection