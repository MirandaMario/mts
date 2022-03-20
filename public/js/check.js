
init_contadorTa("taComentario", "contadorTaComentario", 400);

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


/* $(document).ready(guion);
function guion() {
    $(document).on('keypress', '[id=telefono]', function () {
        if ($(this).val().length == 4) {
            $(this).val($(this).val() + "-");

        }
    });
}
 */


$('#enviar').click(function () {
    check();
});

function check() {
    var ter = $('input:checkbox[name=terms]:checked').val();
    var rseleciondo = $('input:radio[name=tipo_pago]:checked').val();
/*     var municipio = $('input:radio[name=tipo_pago]:checked').val(); */


    if (rseleciondo == null) {
        swal("Advertencia", "Seleccione método de pago","warning");
        event.preventDefault();

    } else if (rseleciondo == "r2") {

        var valortran = $("#valor_transaccion").val() * 1;
        var numetran = $("#nume_transaccion").val();

      //  console.log(valortran, numetran);

        if ((valortran <= 0 || valortran == null)/*  && numetran == "" */) {
            swal("Error", "Verificar campo Monto ", "error");
            event.preventDefault();
        } /* else if (numetran == "") {
            swal("Error", "Ingrese N° de Comprobante válido", "error");
            event.preventDefault();
            swal("Error", "Ingrese campo Monto y N° de Comprobante válidos", "error");
        } */ else if (valortran <= 0 || valortran == null) {
            swal("Error", "Ingrese Monto válido","error");
            event.preventDefault();
        } else {
            if (typeof (ter) != "undefined" && ter !== null) {

            } else {
               
                swal("Advertencia", "Aceptar términos y condiciones","warning");
                event.preventDefault();
            }
        }
    } else {
        if (typeof (ter) != "undefined" && ter !== null) {
        } else {
            swal("Advertencia", "Aceptar términos y condiciones","warning");
            event.preventDefault();
        }
    }
};



function check2() {
    var ter = $('input:checkbox[name=terms]:checked').val();
        if (typeof (ter) != "undefined" && ter !== null) {
            $('#espere_agregar').removeAttr("style");   
        } else {
            swal("Advertencia", "Aceptar términos y condiciones","warning");
            event.preventDefault();
        }
    };

/* function check() {
    var ter = $('input:checkbox[name=terms]:checked').val();
    var rseleciondo = $('input:radio[name=tipo_pago]:checked').val();


    if (rseleciondo == null) {
        swal("Advertencia", "Seleccione método de pago","warning");
        event.preventDefault();

    } else if (rseleciondo == "r2") {

        var valortran = $("#valor_transaccion").val() * 1;
        var numetran = $("#nume_transaccion").val();

      //  console.log(valortran, numetran);

        if ((valortran <= 0 || valortran == null) && numetran == "") {
            swal("Error", "Ingrese campo Monto y N° de Comprobante válidos", "error");
            event.preventDefault();
        } else if (numetran == "") {
            swal("Error", "Ingrese N° de Comprobante válido", "error");
            event.preventDefault();

        } else if (valortran <= 0 || valortran == null) {
            swal("Error", "Ingrese Monto válido","error");
            event.preventDefault();
        } else {
            if (typeof (ter) != "undefined" && ter !== null) {

            } else {
               
                swal("Advertencia", "Aceptar términos y condiciones","warning");
                event.preventDefault();
            }
        }
    } else {
        if (typeof (ter) != "undefined" && ter !== null) {
        } else {
            swal("Advertencia", "Aceptar términos y condiciones","warning");
            event.preventDefault();
        }
    }
}; */



$.datepicker.regional['es'] = {
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
    dateFormat: 'dd-mm-yy',
    firstDay: 7,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };
  
  $.datepicker.setDefaults($.datepicker.regional['es']);
  $("#fecha").datepicker({
     
  });
