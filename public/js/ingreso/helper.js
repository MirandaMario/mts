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
        yearSuffix: '', 
        changeMonth: true,
        changeYear: true
    };
    $.datepicker.setDefaults(defaults);

    $("#check_in").datepicker({});
    $("#fecha_fac").datepicker({});
    $("#fecha_ven").datepicker({ yearRange: "-2:+25"});
});


$('#idproveedor').keyup(function () {
    var query = $(this).val();
    var tmov = $('#tipomov').val();
    if (tmov == "1") {
        $('#gitempresa').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    } else {
        $('#gitempresa').html('Un momento, por favor ... <img src="./../img/loader.gif"/>');
    }
    if (query != '') {
        delay(function () {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "../proveedor_ajax",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
                $('#gitempresa').html('');
                $('#ListaProveedores').fadeIn();
                $('#ListaProveedores').html(data);
            }
        });
    }, 1000);
    }else{
        $('#gitempresa').html(''); 
    }
});


$('#articulo_ingreso').keyup(function () {
    var query = $(this).val();
    var tmov = $('#tipomov').val();
    if (tmov == "1") {
        $('#gitarticulo').html('Un momento, por favor ... <img src="../../img/loader.gif"/>');
    } else {
        $('#gitarticulo').html('Un momento, por favor ... <img src="./../img/loader.gif"/>');
    }
    if (query != '') {
        delay(function () {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "../articulos_compras",
                method: "POST",
                data: { query: query, _token: _token },
                success: function (data) {
                    $('#gitarticulo').html('');
                    $('#ListaProductos').fadeIn();
                    $('#ListaProductos').html(data);
                }
            });
        }, 500);
    }else{
        $('#gitarticulo').html(''); 
    }
});

$('#ListaProductos').on('click', 'li', function () {
    $('#articulo_ingreso').val($(this).text());
    $('#ListaProductos').fadeOut();
    var idA = $(this).text().split('      ');
    $('#idA').val(idA[0]) * 1;
    imagen_ingreso(idA)
});


$('#ListaProveedores').on('click', 'li', function () {
    $('#idproveedor').val($(this).text());
    $('#ListaProveedores').fadeOut();
    var idP = $(this).text().split(' ');
    $('#idP').val(idP[0]);
});


var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();


function evaluar_ingreso() {
    if (total > 0) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}


function limpiar_ingreso() {
   
    $("#pcantidad").val("");
    $("#pprecio_compra").val("");
    $("#articulo_ingreso").val("");
    $("#lote").val("");
    $("#fecha_fac").val("");
    $("#fecha_ven").val("");

}


$("#bt_add_ingreso").click(function () {
    agregar_ingreso();
    $("#pidproducto").focus();

});

function setTwoNumberDecimal(event) {
    this.value = parseFloat(this.value).toFixed(2);
}

function check_ingreso() {
    event.preventDefault();
    idP = $("#idP").val() * 1;
    nC = $("#num_comprobante").val();

    //console.log(idP, nC);
    
    if (idP > 0 && nC != undefined) {
        $("#mf").submit()
        $('#btnt').attr("disabled", true);
    } else if (idP <= 0  && nC != undefined ) {         
        swal("Error", "Campo proveedor, no selecionado o no registrado previamente  y N° de Comprobante!!!", "error");
    } else if ( idP <= 0 ) {
        swal("Error", "Campo proveedor,  no selecionado o no registrado previamente!!!", "error");
    }  else {
        swal("Error", "Verificar N° de comprobante!!!", "error");       
    }
}

function imagen_ingreso(datosArticulo) {
    var img = datosArticulo[10];
    var tmov = $('#tipomov').val();
    if (img) {
        if (tmov == "1") {
            $('#imagen_ingreso').attr({
                'src': '../../imagenes/articulos/' + img,
                'WIDTH': "150", 'HEIGHT': '150'
            });
        } else {
            $('#imagen_ingreso').attr({
                'src': '../imagenes/articulos/' + img,
                'WIDTH': "150", 'HEIGHT': '150'
            });
        }
    } else {
        $('#imagen_ingreso').removeAttr('src');
        $('#imagen_ingreso').removeAttr('WIDTH');
        $('#imagen_ingreso').removeAttr('HEIGHT');
    }
}

