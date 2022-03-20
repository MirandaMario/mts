; (function ($) {
    "use strict"


    var nav_offset_top = $('header').height() + 50;
    /*-------------------------------------------------------------------------------
	  Navbar 
	-------------------------------------------------------------------------------*/

    //* Navbar Fixed  
    function navbarFixed() {
        if ($('.header_area').length) {
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll >= nav_offset_top) {
                    $(".header_area").addClass("navbar_fixed");
                } else {
                    $(".header_area").removeClass("navbar_fixed");
                }
            });
        };
    };
    navbarFixed();




/*     $('select').niceSelect(); */

    /*----------------------------------------------------*/
    /*  Simple LightBox js
    /*----------------------------------------------------*/
    /*$('.imageGallery1 .light').simpleLightbox();*/

    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });




    /*----------------------------------------------------*/
    /*  Members Slider
    /*----------------------------------------------------*/
    function product_slider() {
        if ($('.feature_p_slider').length) {
            $('.feature_p_slider').owlCarousel({
                loop: true,
                margin: 30,
                items: 4,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots: true,
                //				navContainer: '.testimonials_area',
                //                navText: ['<i class="lnr lnr-arrow-up"></i>','<i class="lnr lnr-arrow-down"></i>'],
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    360: {
                        items: 2,
                    },
                    576: {
                        items: 3,
                    },
                    768: {
                        items: 4,
                    },
                }
            })
        }
    }
    product_slider();

    /*----------------------------------------------------*/
    /*  Clients Slider
    /*----------------------------------------------------*/
    function clients_slider() {
        if ($('.clients_slider').length) {
            $('.clients_slider').owlCarousel({
                loop: true,
                margin: 30,
                items: 5,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    400: {
                        items: 2,
                    },
                    575: {
                        items: 3,
                    },
                    768: {
                        items: 4,
                    },
                    992: {
                        items: 5,
                    }
                }
            })
        }
    }
    clients_slider();

    /*----------------------------------------------------*/
    /*  Jquery Ui slider js
    /*----------------------------------------------------*/
    if ($("#slider-range").length > 0) {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [10, 500],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " $" + ui.values[1]);
            }
        });
    }
    if ($("#amount").length > 0) {
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            "   $" + $("#slider-range").slider("values", 1));
    }

})(jQuery)


function dosDecimales(n) {
    let t = n.toString();
    let regex = /(\d*.\d{0,2})/;
    return t.match(regex)[0];
}

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

function enviar(id) {
    var idpr = id * 1;
    var cant = $('#cant' + id).val();
    var proc = $('#proc' + id).text();
    var prec = $('#prec' + id).val() * 1;
    var imgp = $('#imgp' + id).val();
    var desc = $('#desc' + id).val() * 1;
    var slug = $('#slug' + id).val();
    var _token = $('input[name="_token"]').val();
    $('#espere_agregar').removeAttr("style");

    $.ajax({
        url: "add",
        method: "GET",
        data: {
            idpr: idpr,
            cant: cant,
            proc: proc,
            prec: prec,
            imgp: imgp,
            desc: desc,
            slug: slug,
            _token: _token
        },
        success: function (data) {

            $('.cpa').text(data.cartTotalQuantity);
            $('#modalbody').text(data.item.name);
            $("#fff").removeAttr("style");


            let t = dosDecimales(data.total);
            $('.tota').text(t);

            var pj = data.item.attributes.image;
            var imagen_uri = "../imagenes/articulos/" + "/" + pj;
            $("#imagen").attr("src", imagen_uri);
            $(".loader").fadeOut("slow");
            $("#productoAgregado").modal("show");

        }
    });

}

$(document).on('click', '.number-spinner button', function () {
    var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0;
    idpr = btn.attr('name') * 1;

    if (btn.attr('data-dir') == 'up') {
        newVal = parseInt(oldValue) + 1;
    } else {
        if (oldValue > 1) {
            newVal = parseInt(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }


    var _token = $('input[name="_token"]').val();
    $('#mjs' + idpr).html('ACTUALIZANDO...  <img src="./../img/loader.gif" style="position: absolute;"/>');
    $.ajax({
        url: "update",
        method: "GET",
        data: {
            idpr: idpr,
            newVal: newVal,
            _token: _token
        },
        success: function (data) {
            $('.cpa').text(data.cartTotalQuantity);
            $('.tota').text(Math.round(data.total * 100) / 100);
            $('#subtotal' + idpr).text(Math.round(data.subtotal * 100) / 100);
            $('#' + idpr).val(data.item.quantity);
            $('#mjs' + idpr).html('');
        }
    });
});




$(document).ready(function () {

    var mjs = $('#mensaje').val();
   
    var mjs2 = $('#mensaje2').val();
    if (mjs == "Producto eliminado !!!") {
        swal('Hecho !!!', mjs, 'success')
    } else if (mjs == "Su mensaje fue enviado correctatamente !!!") {
        swal('Hecho!!!', mjs, 'success')
    }else if (mjs == "Sus datos fueron registrados correctamente, se envio un correo a la direccion de email proporcionada para que pueda validar su cuenta!!!") {
        swal('Hecho!!!', mjs, 'warning')
    }else if (mjs == "Has confirmado correctamente tu correo!") {
        swal('Hecho!!!', mjs, 'success')
    }else if (mjs == "Se envio un correo para resetear su contraseña!!!") {
        swal('Hecho!!!', mjs, 'success')
    }else if (mjs == "Se cambio correctamente su contraseña !!!") {
        swal('Hecho!!!', mjs, 'success')
    }
     else if (mjs != null) {
        swal('Pedido ingresado !!!', mjs, 'success')
    }

    var mjsn = $('#mjsn').val();
   
    if (mjsn == "El correo ingresado no se encuentra registrado en nuestro sistema ...") {
        swal('Alerta!!!', mjsn)
    }

    var cant = $('.cpa').text() * 1;
    if (cant > 0) {
        $("#fff").removeAttr("style");
    }

}); 


$('#contactForm').submit(function () {
    $('#boton_mjs').attr("disabled", true);
    delay(function () {
       $('#boton_mjs').attr("disabled", false);
             }, 3000);
    
});


var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})(); 
 


$('#findheader').keyup(function () {
    var tmov = $('#tipomov').val();
        $('#gitarticuloheader').html('<img src="./../img/loader.gif"/>');
       
    var query = $(this).val();
    var cc =   query.length; 
    
    if (query != '' &&  cc > 2) {
        delay(function () { 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "articulos_header",
                method: "GET",
                data: { query: query },
                success: function (data) {
               
                    $('#ListaProductosHeader').fadeIn();
                    $('#ListaProductosHeader').html(data);
                    $('#gitarticuloheader').html('');
                }
            });
        }, 400);
    }else{
        $('#ListaProductosHeader').fadeOut();
        $('#gitarticuloheader').html('');
    } 
});


/* 

$('#findheadermovil').keyup(function( event ) {
    var tmov = $('#tipomov').val();
     
        $('#gitarticuloheadermovil').html('<img src="./../img/loader.gif"/>');
    var query = $(this).val();
    var cc =   query.length; 
    
    if (query != '' &&  cc > 2) {
        delay(function () { 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "articulos_header",
                method: "GET",
                data: { query: query },
                success: function (data) {
        
                    $('#ListaProductosHeadermodal').fadeIn();
                    $('#ListaProductosHeadermodal').html(data);
                    $('#gitarticuloheadermovil').html('');
                
                }
            });
        }, 400);
    }else{

        $('#ListaProductosHeadermodal').fadeOut();
        $('#gitarticuloheadermovil').html('');
    }
});
 */

$( "#midocumeto" ).click(function() {
     $('#ListaProductosHeader').fadeOut();
    //alert( "Handler for .click() called." );
  });


  $( "#bmovil" ).click(function() {
    $("#modalart").modal("show");
   //alert( "Handler for .click() called." );
 });


 $('#findheadermovil').keyup(function( event ) {
    var tmov = $('#tipomov').val();
     
        $('#gitarticuloheadermovil').html('<img src="./../img/loader.gif"/>');
    var query = $(this).val();
    var cc =   query.length; 
    
    if (query != '' &&  cc > 2) {
        delay(function () { 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "articulos_header",
                method: "GET",
                data: { query: query },
                success: function (data) {
        
                    $('#ListaProductosHeadermodal').fadeIn();
                    $('#ListaProductosHeadermodal').html(data);
                    $('#gitarticuloheadermovil').html('');
                
                }
            });
        }, 400);
    }else{

        $('#ListaProductosHeadermodal').fadeOut();
        $('#gitarticuloheadermovil').html('');
    }
});



$('#myDiv').floatingWhatsApp({
    phone: '50377793876',
    popupMessage: 'Hola, Como podemos ayudarte?',
    showPopup: false,
    position : 'right'

  });