$(".stock ,  .cdc").focus(function () {
    var trid = $(this).attr("fila"); 
    let columna = $(this).attr("class");
    $(this).keyup(function () {
        var valor = $(this).val(); 
        if (valor != '') {
            delay(function () {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "./update_index_articulo",
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
            }, 700);
        }
    });
});



var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();
