@extends('layouts.admin')
@section('title','Nueva asignación')
@section('contenido')
{{-- @include('modals.addArticuloModal') --}}
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<style>
    .fixed-panel {
        height: 545px;
        overflow-y: scroll;

    }

    .fixed-panel2 {
        height: 500px;
    }

    .fixed-panel3 {
        height: 500px;
    }
</style>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<div class="row" style=" {{ config('constantes.FONT') }}">
    {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocomplete'=>'off' , 'id' => 'miform' ))!!}
    {{Form::token()}}
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary ">
            <div class="panel-heading" style="height: 45px;">
                <div style="font-size: 20px;"> 
                    Nueva Asignación
                </div>
            </div>

            <div class="panel-body fixed-panel3">

                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label for="check_in" class="apa">Fecha </label>
                            <input type="text" class="form-control text-center pa" placeholder="Seleccione fecha"
                                name="check_in" readonly="readonly" value="{{$ldate = date('Y-m-d')}}" id="check_in"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="num_comprobante" class="apa">N° orden</label>
                            <input type="number" name="num_comprobante" value="{{old('num_comprobante')}}"
                                class="form-control"  placeholder="Número..." autofocus  />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <input type="hidden" name="idP" value="1">
                    <input type="hidden" id="tipo_comprobante" name="tipo_comprobante" value="Produccion">
                  {{--   <input type="hidden" id="nompresentacion">
                    <input type="hidden" id="nomproducto"> --}}
                    <input type="hidden" id="contador">

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                        <div class="form-group">
                            <label for="articulo" class="apa">Artículo</label>
                            <input type="text" name="pidproducto" id="pidproducto" class="form-control"
                                placeholder="Código producto ..."/>
                            <input type="hidden" id="idA" name="idA">

                            <div id="ListaProductos">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label for="cantidad" class="apa">Cantidad</label>
                            <input type="number" name="pcantidad" id="pcantidad" class="form-control"
                                placeholder="Cantidad"  />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label for="precio_compra" class="apa">Precio (Adquisición))</label>
                            <input type="number" {{-- onchange="setTwoNumberDecimal" --}} min="0"  step="0.01"
                                name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="P. Unit."  />
                        </div>
                    </div>
                    <div class="col-lg-3  col-sm-3 col-md-3 col-xs-12 pa">
                        <label for="agregar" class="apa">&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        <div class="form-group">
                            <button type="button" name="bt_add" id="bt_add" class="btn btn-primary pa">
                                AGREGAR
                            </button>
                        </div>
                    </div>           
                </div>
        </div>
    </div>
</div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary ">
            <div class="panel-body fixed-panel pa">
                <div>
                    <div class="table-responsive">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"
                            style="font-size:100%; width: 100%;">
                            <thead style="background-color: #A9D0F5;">
                                <th class="text-center" width="5%"><b>Opciones</b></th>
                                {{-- <th class="text-center" width="15%">Presentación</th> --}}
                                <th class="text-left" width="35%">Producto</th>
                                <th class="text-center" width="10%">Cantidad</th>
                                <th class="text-right" width="10%">P unit.</th>
                                <th class="text-right" width="10%">Costo</th>
                            </thead>

                        </table>
                    </div>

                    <input type="hidden" id="total_compra" name="total_compra">                   
                </div>

                <div class="row" id="divbotones" style="display: none">
                    <div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
                            <div class="form-group">
                                <input name="_token" value="{{csrf_token()}}" type="hidden" />
                                <button class="btn btn-success btn-sm m-t-10 pa"  onclick="javascript:check();">GUARDAR</button>

                                <a href="{{ url('/ingreso') }}"><button class="btn btn-primary btn-sm m-t-10" type="button">CANCELAR</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!!Form::close()!!}
</div>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
       $("#bt_add").click(function(){
            agregar();
            $( "#pidproducto" ).focus();

       });
    });


function check() {
    event.preventDefault();

    if ( total > 0 && total != null) {
        $("#miform").submit()
    } else {
        swal("Advertencia", "No se han agregado productos para ser guardados!!!", "warning");
    }

}

    var cont=0;
    var total=0;
    var subtotal1=0;
    var subtotal=[];

   // $("#guardar").hide();


 function setTwoNumberDecimal(event) {
 this.value = parseFloat(this.value).toFixed(2);
}


    function agregar(){

    var idarticulo = $("#idA").val();
        articulo = $("#pidproducto").val();
        cantidad = $("#pcantidad").val();
        precio_compra = $("#pprecio_compra").val();
        precio_venta = $("#pprecio_venta").val();
      /*   idpresentacion = $("#nom_presentacion").val();
        nom_presentacion =$("#nompresentacion").val(); */

        if(idarticulo!="" &&  cantidad!="" && cantidad>0 && precio_compra>0 ){
          subtotal1 = (cantidad*precio_compra);
          subtotal[cont] = Math.round(subtotal1*100)/100
            total = total+subtotal[cont];


            var fila = '<tr class="selected" id="fila'+cont
            +'"><td class="text-center"><button type="button" class="btn btn-warning btn-sm m-t-10" onclick="eliminar('+cont
            +');">x</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo
            +'">'+articulo+'</td><td class="text-center"><input  style="border:none" size="5" name="cantidad[]" value="'+cantidad
            +'"readonly></td><td class="text-right"><input size="5" style="border:none" name="precio_compra[]" value="'+precio_compra
            +'"readonly></td><td class="text-right">'+subtotal[cont]
            +'</td></tr>';

            cont++;

            limpiar();

            total = Math.round(total*100)/100
            $("#total").html("$ "+total);
            $("#total_compra").val(total);

            ivar = total*0.13;
            iva = Math.round(ivar*100)/100
            $("#iva").html("$ "+iva);

            totalr= total+(total*0.13);
            totalf = Math.round(totalr*100)/100
            $("#totalf").html("$ "+totalf);
            evaluar();
            $('#detalles').append(fila);
            $('#contador').val(cont);

        }else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
        }
    }




    function limpiar(){
        $("#pidproducto").val("");
        $("#pcantidad").val("");
        $("#pprecio_compra").val("");
        $("#pprecio_venta").val("");

    }



function evaluar() {
    if (total > 0) {
        $('#divbotones').removeAttr('style');
    } else {
        $("#divbotones").hide();
    }
}



    function eliminar(index){
        total = total-subtotal[index];
        $("#total").html("$ "+total);
         $("#total_compra").val(total);
        $("#fila"+index).remove();
        evaluar();
    }


    var delay = (function(){
    var timer = 0;
    return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();



    $('#pidproducto').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {delay(function(){
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('compras.fetch2') }}",
          method:"POST",
          data:{query:query, _token: _token},
          success:function(data){
           $('#ListaProductos').fadeIn();
                    $('#ListaProductos').html(data);
          }
         });
      },500);     }
       });

    $('#ListaProductos').on('click', 'li', function(){
        $('#pidproducto').val($(this).text());
        $('#ListaProductos').fadeOut();


        var idA = $(this).text().split('      ');
        $('#idA').val(idA[0]);
        $('#nompresentacion').val(idA[3]);
        $('#nomproducto').val(idA[2]);

        console.log(idA[0]);

    });




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
                  minDate.setDate(minDate.getDate());
              }

          }
      });

      $('#check_in').datepicker().on("input click", function(e) {

      });
  });

</script>



@endsection
