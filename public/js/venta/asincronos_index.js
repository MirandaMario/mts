$(".ve , .e_i , .e  , .ng").focus(function () {
    var trid = $(this).attr("fila"); 
    let columna = $(this).attr("class");
    $(this).keyup(function () {
        var valor = $(this).val(); 
        if (valor != '') {
            delay(function () {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "./update_index_venta",
                    method: "POST",
                    data: {
                        fila    : trid,
                        valor   : valor,
                        columna : columna,
                        _token  : _token
                    },
                    success: function (data) {
                        $(".fila" + trid).css("background-color", "#3eff3f");
                        {
                            delay(function () {
                                $(".fila" + trid).removeAttr('style');
                            }, 2000);
                        }
                    }
                });
            }, 2000);
        }
    });
});


$(".vd ").click(function () {
    var trid = $(this).attr("fila") *1; 
          if (trid > 0) {
            console.log(trid);
             delay(function () {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "./ver_detalle_venta",
                    method: "POST",
                    data: {
                        fila    : trid,
                        _token  : _token
                    },
                     success: function (detalles) {
                        $('#dv1').fadeIn();
                        $('#dv1').html(detalles);
                        delay(function () {
                            $('#dv1').empty();
                        }, 10000);
                    } 
                });
            }, 300); 
        }  
   
});



var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();


/*

  $('#' + columna + trid).keyup(function () {
        var valor = $('#' + columna + trid).val()
$(".envio_interno").focus(function() {
    var trid = $(this).attr("id_ie")
   console.log (trid)
    $('#ie'+trid).keyup(function(){
        var idtr = trid
        var valor = $('#ie'+trid).val()
      //   console.log (idtr)
      console.log (valor )

        if(valor != '')
        {delay(function()
    {
     var _token = $('input[name="_token"]').val();
     $.ajax({
      url:"./update_ie",
      method:"POST",
      data:{    query : idtr,
                query2 : valor,
                _token: _token},
      success:function(data){

            $(".fila"+trid).css("background-color", "orange");
            {delay(function() {
            $(".fila"+trid).removeAttr('style');

            },5000);}
      }
     });
    },700);   }
});
});
 //  $('#ListaClientes').fadeIn();   "{{ route('updateuser') }}",

*/

