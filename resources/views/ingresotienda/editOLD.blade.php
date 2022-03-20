@extends('layouts.admin')
@section('title','Editar Ingreso')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<style>
    .fixed-panel {
        height: 540px;
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
    {!!Form::model($ingreso,['method'=>'PATCH','route'=>['ingreso.update',$ingreso->idingreso],'files'=>'true',
    'autocomplete' => 'off', 'id' => 'miform' ])!!}
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 45px;">
                <div style="font-size: 20px;"> 
                Editar ingreso
                </div>
            </div>
            <div class="panel-body fixed-panel2">


                {{Form::token()}}
                <div class="row">
                    <div class="col-lg-3 col-sm- col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label for="check_in" class="apa">Fecha</label>
                            <input type="text" class="form-control text-center" placeholder="Seleccione fecha"
                                name="check_in" readonly="readonly" value="{{$ingreso->fecha}}" id="check_in"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="num_comprobante" class="apa">N° orden</label>
                            <input type="number" name="num_comprobante" value="{{$ingreso->num_comprobante}}"
                                class="form-control text-center
                                " placeholder="Número de comprobante..." />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                        <div class="form-group">
                            <label for="articulo" class="apa">Artículo</label>
                            <input type="text" name="pidproducto" id="pidproducto" class="form-control"
                                placeholder="Código producto ..." />
                            <input type="hidden" id="idA" name="idA">
                            <input type="hidden" id="tipo_comprobante" name="tipo_comprobante" value="{{$ingreso->tipo_comprobante}}">
                            <input type="hidden" id="idP" name="idP" value="{{$ingreso->idpersona}}">
                            <input type="hidden" id="nom_presentacion" >
                            <input type="hidden" id="nom_articulo" >
                            <input type="hidden" name="idingreso"  value="{{$ingreso->idingreso}}">

                            <div id="ListaProductos">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label for="cantidad" class="apa">Cantidad</label>
                            <input type="number" name="pcantidad" id="pcantidad" class="form-control pa"
                                placeholder="Cantidad" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div class="form-group">
                            <label for="precio_compra" class="apa">P unit.</label>
                            <input type="number" onchange="setTwoNumberDecimal" min="0" step="0.01"
                                name="pprecio_compra" id="pprecio_compra" class="form-control"
                                placeholder="Precio" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1  col-sm-1 col-md-1 col-xs-12 pa">
                        <label for="agregar" class="apa">
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
            <div class="panel-body fixed-panel">
                
                    <div class="table-responsive">
                            <table id="detalles" class="table table-striped nowrap compact" 
                                    style="font-size:100%;">
                                    <thead style="background-color: #96dff6;">
                                        <th class="text-center" width="5%">Opciones</th>
                                        <th class="text-center" width="15%">Presentación</th>
                                        <th class="text-left" width="35%">Producto</th>
                                        <th class="text-center" width="10%">Cantidad</th>
                                        <th class="text-right" width="10%">P unit</th>
                                        <th class="text-right" width="10%">Costo</th>
                                    </thead>
                                    @php $con = 0; $t = 0; $sutotal = array(); @endphp
                                    @foreach ($detalles as $det)

                                    <tr class="selected" id="fila{{$con}}">
                                        <td class="text-center"><button type="button" class="btn btn-warning btn-xs"
                                                onclick="eliminar({{$con}});">x</button></td>
                                        <td class="text-center">{{$det->nom_presentacion}}</td>
                                        <td><input class="outlinenone" type="hidden" name="idarticulo[]"
                                                value="{{$det->idarticulo}}">{{$det->articulo}}</td>
                                        <td class="text-center"><input class="outlinenone" size="5" name="cantidad[]"
                                                value="{{$det->cantidad}}" readonly></td>
                                        <td class="text-right"><input class="outlinenone" size="5"
                                                name="precio_compra[]" value="{{$det->precio_compra}}" readonly></td>
                                        <td class="text-right">{{number_format($det->cantidad*$det->precio_compra,2)}}
                                        </td>
                                        @php
                                        $t += $det->cantidad*$det->precio_compra;
                                        $sutotal[]= $det->cantidad*$det->precio_compra;

                                        @endphp
                                    </tr>
                                    @php $con++; @endphp
                                    @endforeach
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h5 class="text-right"> TOTAL</h5>
                                        </th>
                                        <th>
                                            <h5 class="text-right" id="total">$ 0.00</h5>
                                        </th>
                                    </tfoot>
                                </table>
                            </div>
                            
                                   
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa" id="guardar">
                                    <div class="form-group">
                                        <input name="_token" value="{{csrf_token()}}" type="hidden" />
                                        <button class="btn btn-warning btn-sm m-t-10" type="submit">
                                            ACTUALIZAR
                                        </button>
                                        <a href="{{ url('/ingreso') }}"><button class="btn btn-primary btn-sm m-t-10"
                                                type="button">CANCELAR</button></a>
                                    </div>
                                </div>
                            </div>
                        
                        <input type="hidden" id="total_compra" name="total_compra">
                    </div>

                
            </div>

        </div>
    </div>
</div>
    {!!Form::close()!!}


    @push('scripts')
    <script type="text/javascript">
        //boton agregar detalle

    $(document).ready(function(){
       $("#bt_add").click(function(){
            agregar();
            $( "#pidproducto" ).focus();

       });
    });


/*     
function check() {
    event.preventDefault();

    if ( total > 0 && total != null) {
        $("#miform").submit()
    } else {
        swal("Advertencia", "No se han agregado productos para ser guardados!!!", "warning");
    }

} */

    var cont='<?php echo $con;?>';
    var tota='<?php echo $t;?>';
    var total =  Math.round(tota*100)/100


    var subtotal1=0;
    var subtotal=<?php echo json_encode($sutotal);?>;

    $("#total").html("$ "+'<?php echo $t;?>');
    $("#total_compra").val(total);


 function setTwoNumberDecimal(event) {
 this.value = parseFloat(this.value).toFixed(2);
}


    function agregar(){

        var idarticulo = $("#idA").val();
        articulo = $("#nom_articulo").val();
        cantidad = $("#pcantidad").val();
        precio_compra = $("#pprecio_compra").val();
        precio_venta = $("#pprecio_venta").val();
        nom_presentacion = $("#nom_presentacion").val();

        if(idarticulo!="" &&  cantidad!="" && cantidad>0 && precio_compra>0 ){
           cantidad = cantidad * 1 ;

           precio_compra = precio_compra * 1;

          subtotal1 = (cantidad*precio_compra);
          subtotal[cont] = Math.round(subtotal1*100)/100
          total = total+subtotal[cont];


            var fila = '<tr class="selected" id="fila'+cont
            +'"><td class="text-center"><button type="button" class="btn btn-warning btn-xs"" onclick="eliminar('+cont
            +');">x</button><td class="text-center">'+nom_presentacion+'</td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo
            +'">'+articulo+'</td><td class="text-center"><input  style="border:none" size="5" name="cantidad[]" value="'+cantidad
            +'"readonly></td><td class="text-right"><input size="5" name="precio_compra[]" style="border:none" value="'+precio_compra
            +'"readonly></td><td class="text-right">'+subtotal[cont]
            +'</td></tr>';


            cont++;

           limpiar();

            total = Math.round(total*100)/100
            $("#total").html("$ "+total);
            $("#total_compra").val(total);


            evaluar();
            $('#detalles').append(fila);
        }else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
        }
    }


    function limpiar(){
        $("#pidproducto").val("");
        $("#pcantidad").val("");
        $("#pprecio_compra").val("");
        $("#pprecio_venta").val("");
        $("#idpresentacion").val("");

    }


    function evaluar(){
        if(total>0){
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
    }


    function eliminar(index){
        total = total-subtotal[index];
        $("#total").html("$ "+total);
         $("#total_compra").val(total);
        $("#fila"+index).remove();
      //  evaluar();
    }

    </script>

    @endpush

    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

    <script>
        $(document).ready(function(){

 $('#idproveedor').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('compras.fetch') }}",
          method:"POST",
          data:{query:query, _token: _token},
          success:function(data){
           $('#ListaProveedores').fadeIn();
                    $('#ListaProveedores').html(data);
          }
         });
        }
    });


    $('#ListaProveedores').on('click', 'li', function(){
        $('#idproveedor').val($(this).text());
        $('#ListaProveedores').fadeOut();


        var idP = $(this).text().split(' ');
        $('#idP').val(idP[0]);


    });

});
    </script>


    <script>
        var delay = (function(){
    var timer = 0;
    return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

    $(document).ready(function(){

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


        var idA = $(this).text().split('    ');
        $('#idA').val(idA[0]);
        $('#nom_articulo').val(idA[2]);
        $('#nom_presentacion').val(idA[3]);

        console.log(idA[0]);

    });


});

    </script>

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
                  minDate.setDate(minDate.getDate());
              }

          }
      });

      $('#check_in').datepicker().on("input click", function(e) {
          console.log("Fecha salida cambiada: ", e.target.value);
      });
  });
    </script>

    @endsection
