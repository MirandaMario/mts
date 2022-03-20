function agregar_ingreso() {

    var idarticulo = $("#idA").val();
    //articulo = $("#articulo_ingreso").val();
    articulo = $("#articulo_ingreso").val().split('      ');
    cantidad = $("#pcantidad").val();
    precio_compra = $("#pprecio_compra").val();
    lote = $("#lote").val();
    fecha_fac = document.getElementById("fecha_fac").value;
    fecha_ven = document.getElementById("fecha_ven").value;
    precio_venta = $("#pprecio_venta").val();
  
    if (idarticulo != "" && cantidad != "" && cantidad > 0 && precio_compra > 0) {
        cantidad = cantidad * 1;

        precio_compra = precio_compra * 1;

        subtotal1 = (cantidad * precio_compra);
        subtotal[cont] = Math.round(subtotal1 * 100) / 100
        total = total + subtotal[cont];

        var fila = '<tr class="selected" id="fila' + cont
            + '"><td class="text-center"><button type="button" class="btn btn-warning btn-xs"" onclick="eliminar(' + cont
            + ');">x</button></td><td><input type="hidden" name="idarticulo[]" value="' + idarticulo
            + '"><input type="hidden" name="lote[]" value="' + lote
            + '"><input type="hidden" name="fecha_ven[]" value="' + fecha_ven
            + '"><input type="hidden" name="fecha_fac[]" value="' + fecha_fac
            + '">'  + articulo[2] + articulo[3] + articulo[4] + " "+ fecha_fac + " "+ fecha_ven +" "+ lote  +  '</td><td class="text-center"><input  style="border:none" size="5" name="cantidad[]" value="' + cantidad
            + '"readonly></td><td class="text-right"><input size="5" name="precio_compra[]" style="border:none" value="' + precio_compra
            + '"readonly></td><td class="text-right">' + subtotal[cont]
            + '</td></tr>';

        cont++;

        total = Math.round(total * 100) / 100
        $("#total").html("$ " + total);
        $("#total_compra").val(total);
        limpiar_ingreso();
        evaluar_ingreso();
        $('#detalles').append(fila);
    } else {
       
        swal("Error", "Error al ingresar el detalle de la venta, revise los datos del artículo!!!", "error");
    }
}

function eliminar(index) {
    total = total - subtotal[index];
    $("#total").html("$ " + total);
    $("#total_compra").val(total);
    $("#fila" + index).remove();
    evaluar_ingreso();
}