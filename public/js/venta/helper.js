$(".alert-success").fadeTo(5000, 500).slideUp(500, function() {
    $(".alert-success").slideUp(500);
});

$(".alert-info").fadeTo(5000, 500).slideUp(500, function() {
    $(".alert-info").slideUp(500);
});

$("#bt_add").click(function () {
    agregar();
    $("#idarticulo").focus();
});

$(document).ready(function () {
    $("#guardar").hide();
});

$('#min').click(function () {
    if ($('#pcantidad').val() != 0)
        $('#pcantidad').val(parseInt($('#pcantidad').val()) - 1);
});

$('#plus').click(function () {
    $('#pcantidad').val(parseInt($('#pcantidad').val()) + 1);
});


function check() {
    event.preventDefault();
    idC = $("#idcliente").val() * 1;
    nC = $("#num_comprobante").val() * 1;


    if (idC > 0 && nC > 0) {
        $("#mf").submit(); 
        $('#btnt').attr("disabled", true);
    } else if (idC > 0 && (nC < 0 || nC === "")) {
        swal("Advertencia", " Verificar campo correlativo !!!", "warning");
    } else if (idC === "" && nC > 0) {
        swal("Error", "Campo cliente,  no selecionado o no registrado previamente!!!", "error");
    } else {
        swal("Advertencia", "Campo cliente, no selecionado o no registrado previamente  y campo correlativo!!!", "warning");
    }
}




 function check_cotizacion2() {
    event.preventDefault();
    tipo_movimiento = $("#id2").val() * 1; 
    idC = $("#idcliente").val() * 1;
    if (tipo_movimiento == 1) {
        tipo_comprobante =  $("#tipo_comprobante option:selected").text();
        swal({
            title: "Crear documento de venta tipo " + tipo_comprobante + " ? ",
            icon: "warning",
            buttons: true,
            dangerMode: false,
          })
          .then((willDelete) => {
            if (willDelete) {
                $("#mf").submit()
            } 
          });
    } else {
        if (idC > 0 ) {
            $("#mf").submit()
        } else {
            swal("Advertencia", "Campo cliente, no selecionado o no registrado previamente !!!", "warning");
        }  
    }        
} 


function check_cotizacion() {
    event.preventDefault();
    idC = $("#idcliente").val() * 1;
    total = $("#total_venta").val() * 1;
    
    if (idC > 0 && total > 0) {
        $("#mf").submit()
    } else if (idC == 0 && total == 0 ) {
        swal("Advertencia", "Campo cliente, no selecionado o no registrado previamente y agregue artículo!!!", "warning");
    } else if (total > 0 ) {
        swal("Advertencia", "Campo cliente, no selecionado o no registrado previamente!!!", "warning");
    } else {
        swal("Advertencia", "Agregue artículo!!!", "warning");
    }
}


$('#codigo_articulo').keyup(function () {
    var idtienda = $('#idtienda').val();
    var query = $(this).val();
    if (query != '') {
        delay(function () {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "../articulo_codigo",
                method: "POST",
                data: { query: query, _token: _token, idtienda: idtienda },
                success: function (data) {

                    var datosArticulo = data.split('      ');
                    var stockart = (datosArticulo[2]) != null ? stockart = datosArticulo[2] * 1 : stockart = 0; 
                    var idart = (datosArticulo[0] * 1);
                    var ct = contador(idart);
                    var stock = (stockart - ct)
                    $('#stock').val(stock)
                    comun(datosArticulo)

                    if (idart > 0) {
                        $('#articulo').val(datosArticulo[0] + "      " + datosArticulo[3] + "      " + datosArticulo[4] + "      " + datosArticulo[1]+ "      " + datosArticulo[5]);
                        $('#articulo').attr({ 'style': 'background-color: white; font-size: 20px;' });
                    } else {
                        $('#articulo').val("ARTICULO NO ENCONTRADO");
                        $('#articulo').attr({ 'style': 'color: white; background-color: red; font-size: 20px;' });
                    }

                    if (idart > 0 && stockart > 0) {
                        agregar();
                    }

                    imagen(datosArticulo)
                }
            });
        }, 400);
    }
});


$('#articulo').keyup(function () {
    var tmov = $('#tipomov').val();
    if (tmov == "1") {
        $('#gitarticulo').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    } else {
        $('#gitarticulo').html('Un momento, por favor ... <img src="./../img/loader.gif"/>');
    }
    var idtienda = $('#idtienda').val();
    var query = $(this).val();
    var s = $(this).val().length;
    if (s >= 3) {
        delay(function () {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "../articulos",
                method: "POST",
                data: { query: query, _token: _token, idtienda: idtienda },
                success: function (data) {
                    $('#ListaProductos').fadeIn();
                    $('#ListaProductos').html(data);
                    $('#gitarticulo').html('');

                }
            });
        }, 400);
    }else{
        $('#ListaProductos').fadeOut();
        $('#gitarticulo').html('');
    }
});



$('#articulo_index ').keyup(function () {
    var tmov = $('#tipomov').val();
    if (tmov == "1") {
        $('#gitarticulo').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    } else {
        $('#gitarticulo').html('Un momento, por favor ... <img src="./../img/loader.gif"/>');
    }
    var idtienda = 1
    var s = $(this).val().length;
    var query = $(this).val();
    if (s >= 3) {
        delay(function () {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "articulos_index",
                method: "POST",
                data: { query: query, _token: _token, idtienda: idtienda },
                success: function (data) {
                    $('#ListaProductos').fadeIn();
                    $('#ListaProductos').html(data);
                    $('#gitarticulo').html('');

                }
            });
        }, 100);
    }else{
        $('#ListaProductos').fadeOut();
        $('#gitarticulo').html('');
    }
});


$('#ListaProductos').on('click', 'li', function () {

    $('#ListaProductos').fadeOut(10);
    var datosArticulo = $(this).text().split('      ');
    var idart = (datosArticulo[0] * 1);
    var ct = contador(idart);
    $('#stock').val(datosArticulo[2] - ct)
    console.log(datosArticulo)
    imagen(datosArticulo)
    comun(datosArticulo)
    $('#articulo').val(datosArticulo[0] + "      " + datosArticulo[3] + "      " + datosArticulo[4] + "      " + datosArticulo[1]+ "      " + datosArticulo[5]);
    $('#articulo_index').val(datosArticulo[0]);
    $('#articulo').attr({ 'style': 'background-color: white; font-size: 20px;' });
    $('#codigo_articulo').val(datosArticulo[1])
    $('#formindex').submit(); 

});





$('#articulo_index_header').keyup(function () {
   
    var urlactual = window.location;
    var urltext = urlactual.toString();
    
    var urla = urltext.substring(0,16); 
    var urlb = ""


    console.log(urla );

    if(urla == 'http://localhost'){

        var contar = 0;
        var start = 0;
        while ((start = urltext.indexOf("/", start) + 1) > 0) {
            contar++;
        }
    
        if(contar == 5){
            urlb = 'articulos_index'; 
            $('#gitarticulo_header').html('<img src="./../img/loader.gif"/>');
        }else{
            var dif = contar - 5; 
          
            if(dif == 2){
                urlb = "./../../articulos_index";
                $('#gitarticulo_header').html('<img src="./../../img/loader.gif"/>');
            }else{
                urlb = "./../articulos_index";
                $('#gitarticulo_header').html('<img src="./../../img/loader.gif"/>');
            }
            
        }
    }else{
        urlb = 'https://mtech-sv.com/articulos_index'; 

        $('#gitarticulo_header').html('<img src="https://mtech-sv.com/img/loader.gif"/>');
    }
  


    var idtienda = 1
    var s = $(this).val().length;
    var query = $(this).val();
    if (s >= 3) {
        delay(function () {
            var _token = $('input[name="_token"]').val();

           

            $.ajax({
                url:  urlb,
                method: "POST",
                data: { query: query, _token: _token, idtienda: idtienda },
                
                success: function (data) {
                    $('#ListaProductos_header').fadeIn();
                    $('#ListaProductos_header').html(data);
                    $('#gitarticulo_header').html('');  
                },
            });
        }, 400);
    }else{
        $('#ListaProductos_header').fadeOut();
        $('#gitarticulo_header').html('');
    }
});


$('#ListaProductos_header').on('click', 'li', function () {

    $('#ListaProductos_header').fadeOut(10);
    var datosArticulo = $(this).text().split('      ');
    var idart = (datosArticulo[0] * 1);
    var ct = contador(idart);
    $('#stock').val(datosArticulo[2] - ct)
    console.log(datosArticulo)
    imagen(datosArticulo)
    comun(datosArticulo)
    $('#articulo').val(datosArticulo[0] + "      " + datosArticulo[3] + "      " + datosArticulo[4] + "      " + datosArticulo[1]+ "      " + datosArticulo[5]);
    $('#articulo_index_header').val(datosArticulo[0]);
    $('#articulo').attr({ 'style': 'background-color: white; font-size: 20px;' });
    $('#codigo_articulo').val(datosArticulo[1])
    $('#form_index_header').submit(); 

});


function contador(idart) {

    var iei = [];   // indices repetidos de articulos
    var can = [];   // array cantidades
    var ct = 0;    // total mismo elementos

    $("input[name='idarticulo[]']").each(function (indice, elemento) {
        if (idart == $(elemento).val() * 1) {
            iei.push(indice); //array de indice de elementos igual  al insertado 
        }
    });

    $("input[name='cantidad[]']").each(function (indice2, elemento2) {
        can.push($(elemento2).val() * 1); //array valor de la cantidades
    });

    jQuery.each(iei, function (i, val) { ct += can[val]; });

    return ct
}


function comun(datosArticulo) {

    var impuesto = (datosArticulo[7]) * 1;
    var impuesto2 = (datosArticulo[8]) * 1;
    var porcentaje = (datosArticulo[9]) * 1;
    var porcentaje2 = (datosArticulo[13]) * 1;
    var porcentaje3 = (datosArticulo[14]) * 1;
    var costoproducto = (datosArticulo[10]) * 1;
    var puntos = (datosArticulo[12]) * 1;
    var stockart = (datosArticulo[2] * 1) > 0 ? stockart = datosArticulo[2] * 1 : stockart = 0;
    var desc = datosArticulo[11];
    var cesc = $('#cesc').val() * 1;
    var iva = $('#iva').val() * 1;

    var pyc = ((porcentaje / 100) * costoproducto) + costoproducto;
    var pyc2 = ((porcentaje2 / 100) * costoproducto) + costoproducto;
    var pyc3 = ((porcentaje3 / 100) * costoproducto) + costoproducto;
    let precio = 0;
    //console.log(impuesto, impuesto2, porcentaje, costoproducto, cesc, iva);
    if (impuesto == 1 && impuesto2 == 1) {
        precio = (pyc * (cesc + iva)) + pyc;
        precio2 = (pyc2 * (cesc + iva)) + pyc2;
        precio3 = (pyc3 * (cesc + iva)) + pyc3;
    } else if (impuesto == 1 && impuesto2 == 0) {
        precio = (pyc * iva) + pyc;
        precio2 = (pyc2 * iva) + pyc2;
        precio3 = (pyc3 * iva) + pyc3;
    } else if (impuesto == 0 && impuesto2 == 1) {
        precio = (pyc * cesc) + pyc;
        precio2 = (pyc2 * cesc) + pyc2;
        precio3 = (pyc3 * cesc) + pyc3;
    } else {
        precio = pyc;
        precio2 = pyc2;
        precio3 = pyc3;
    }
    $('#precios').html('M1&nbsp=> ' + dosDecimales(precio2) + '&nbsp&nbsp&nbsp' + 'M2&nbsp=> '+ dosDecimales(precio3))
    $('#impuesto').val(datosArticulo[7])
    $('#impuestodos').val(datosArticulo[8])
    //$('#pprecio_venta').val(precio);
    $('#beneficio').val(porcentaje);
    $('#descuentou').val(desc)

    if( desc > 0 ){ 
        $('#descuentou').attr({ 'style': 'color: black; background-color: #ffff00; font-size: 20px;' });
    }

    if (stockart <= 0) {
        $('#ad2').text("SIN STOCK");
        $('#ad2').attr({ 'style': 'color: white; background-color: red; font-size: 14px;' });
    } else {
        $('#ad2').text("Stock");
        $('#ad2').removeAttr('style');
    }

    if (precio > 0) {
        $('#precio_lista').val(Math.round(precio * 100) / 100);
        $('#puntos').val(puntos);
  //      $('#precio_lista').attr({ 'style': 'color: #00FF00; background-color: black; font-size: 20px;' });
    } else {
        $('#precio_lista').val("");
      //  $('#precio_lista').removeAttr('style');
    }

    if (desc > 0) {
        var x = precio - (precio * (desc / 100))
        $('#precio_venta').val(Math.round(x * 100) / 100)
        $('#precio_venta').attr({ 'style': 'color: #00FF00; background-color: black; font-size: 20px;' });
    } else if (precio > 0) {
        $('#precio_venta').val(Math.round(precio * 100) / 100)
        $('#precio_venta').attr({ 'style': 'color: #00FF00; background-color: black; font-size: 20px;' });
    }
    // return precio
}

function imagen(datosArticulo) {
    var img = datosArticulo[6];
    var tmov = $('#tipomov').val();
    if (img) {
        if (tmov == "1") {
            $('#imagen').attr({
                'src': '../../imagenes/articulos/' + img,
                'WIDTH': "150", 'HEIGHT': '150'
            });
        } else {
            $('#imagen').attr({
                'src': '../imagenes/articulos/' + img,
                'WIDTH': "150", 'HEIGHT': '150'
            });
        }
    } else {
        $('#imagen').removeAttr('src');
        $('#imagen').removeAttr('WIDTH');
        $('#imagen').removeAttr('HEIGHT');
    }
}



$('#cliente').keyup(function () {
    var query = $(this).val();
    if (query != '') {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "../persona",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
                $('#ListaClientes').fadeIn();
                $('#ListaClientes').html(data);
            }
        });
    }
});


$('#empresa').keyup(function () {
    var tmov = $('#tipomov').val();
    if (tmov == "1") {
        $('#gitcliente').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    } else {
        $('#gitcliente').html('Un momento, por favor ... <img src="./../img/loader.gif"/>');
    }
   
    var query = $(this).val();
    if (query != '') {
    delay(function () {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "../empresa",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
               
                $('#ListaClientes').fadeIn();
                $('#ListaClientes').html(data);
                $('#gitcliente').html('');

            }
        });
    },500);
    }else{
        $('#gitcliente').html('');
    }

});

$('#ListaClientes').on('click', 'li', function () {
    $('#cliente').val($(this).text());
    $('#empresa').val($(this).text());
    $('#ListaClientes').fadeOut();
    var datosCliente = $(this).text().split('      ');
    $('#idcliente').val(datosCliente[0]);
    $("#bhis").submit()
    $("#bcliente").submit()
});


$('#proveedor').keyup(function () {
    var tmov = $('#tipomov').val();
    if (tmov == "1") {
        $('#gitcliente').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    } else {
        $('#gitcliente').html('Un momento, por favor ... <img src="./../img/loader.gif"/>');
    }
   
    var query = $(this).val();
    if (query != '') {
    delay(function () {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "../proveedor_ajax",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
               
                $('#ListaProveedores').fadeIn();
                $('#ListaProveedores').html(data);
                $('#gitcliente').html('');

            }
        });
    },500);
    }else{
        $('#gitcliente').html('');
    }

});




$('#ListaProveedores').on('click', 'li', function () {
    $('#proveedor').val($(this).text());
    $('#empresa').val($(this).text());
    $('#ListaProveedores').fadeOut();
    var datosCliente = $(this).text().split('      ');
    $('#idcliente').val(datosCliente[0]);
    $("#bpro").submit()
   
});


$('#nombre_municipio').keyup(function () {

    $('#gitmunicipios').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    var query = $(this).val();
    if (query != '') {
    delay(function () {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "../lista_municipios",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
                $('#ListaMunicipios').fadeIn();
                $('#ListaMunicipios').html(data);
                $('#gitmunicipios').html('');
            }
        });
    },500);
    }else{
        $('#gitmunicipios').html('');
    }

});

$('#ListaMunicipios').on('click', 'li', function () {
    $('#nombre_municipio').val($(this).text());
    $('#ListaMunicipios').fadeOut();
    var datosCliente = $(this).text().split('      ');
    $('#municipio').val(datosCliente[0]);
});

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

function evaluar() {
    if (total > 0 || total < 0 ) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}

$('#myTableVentas').DataTable({
    "order": [[0, "desc"]],
    "aLengthMenu": [[5, 15, 50, 75, -1], [5, 15, 50, 75, "All"]],
    "iDisplayLength": 5,
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
});


function limpia(elemento) {
    elemento.value = "";
    $('#articulo').removeAttr('style');
}

function verifica(elemento) {
    if (elemento.value == "")
        elemento.value = "";
}

$(function () {
    var defaults = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults(defaults);

    $("#check_in").datepicker({});

});


function limpiar() {
    $("#stock").val("");
    $("#articulo").val("");
    $("#cantidad").val("1");
    $("#codigo_articulo").val("");
    $('#precio_lista').val("");
   // $('#precio_lista').removeAttr('style');
    $('#descuentou').removeAttr('style');
    $('#imagen').removeAttr('src');
    $('#imagen').removeAttr('WIDTH');
    $('#imagen').removeAttr('HEIGHT');
    $("#descuentou").val("0");
    $("#precio_venta").val("0");
    $("#precio_venta").removeAttr('style');
    $('#ad2').removeAttr('style');
}

init_contadorTa("taComentario", "contadorTaComentario", 400);
init_contadorTa("taComentario2", "contadorTaComentario2", 180);

function init_contadorTa(idtextarea, idcontador, max) {
    $("#" + idtextarea).keyup(function () {
        updateContadorTa(idtextarea, idcontador, max);
    });

    $("#" + idtextarea).change(function () {
        updateContadorTa(idtextarea, idcontador, max);
    });

}

function updateContadorTa(idtextarea, idcontador, max) {
    var contador = $("#" + idcontador);
    var ta = $("#" + idtextarea);
    contador.html("0/" + max);

    contador.html(ta.val().length + "/" + max);
    if (parseInt(ta.val().length) > max) {
        ta.val(ta.val().substring(0, max - 1));
        contador.html(max + "/" + max);
    }

}

function dosDecimales(n) {
    let t = n.toString();
    let regex = /(\d*.\d{0,2})/;
    return t.match(regex)[0];
}


$('#efectivo').keyup(function () {
    var efectivo = $('#efectivo').val()*1;
    var total = $('#total').text()*1;

    var cambio = Math.round((efectivo-total) * 100) / 100
    $('#cambio').text(cambio)*1;
    
})
