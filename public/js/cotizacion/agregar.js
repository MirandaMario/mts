$("#total_venta").val(total);
$("#total").html(total);


function agregar() {
    datosArticulo = $("#articulo").val().split('      ');
    idarticulo = datosArticulo[0] * 1;
    articulo = datosArticulo[0] + " " + datosArticulo[4] + " " +datosArticulo[2] + " " + datosArticulo[1]; 
    cantidad = $("#cantidad").val() * 1;
    precio_lista = Math.round($("#precio_lista").val() * 100) / 100;
    impuesto = $("#impuesto").val() * 1;
    impuesto2 = $("#impuestodos").val() * 1;
    descuentou = $("#descuentou").val() * 1;
    beneficio = $("#beneficio").val() * 1;
    stock = $("#stock").val() * 1;

    exento = impuesto === 1 ? exento = "G" : exento = "E";

    if (idarticulo != "" && cantidad != "" && precio_venta != "") {
        if (cantidad <= stock) {

            tp = cantidad * precio_lista;
            des = descuentou / 100;
            p_venta = precio_lista -(precio_lista * des); 
            subtotal1 = (tp - (tp * des));
            subtotal[cont] = Math.round(subtotal1 * 100) / 100
            total = total + subtotal[cont];

            var fila = '<tr class="selected" id="fila' + cont
                + '"><td class="text-center"><button type="button" class="btn btn-warning btn-xs"  onclick="eliminar(' + cont
                + ');">x</button></td><td><input type="hidden" name="idarticulo[]" value="' + idarticulo
                + '"><input type="hidden" name="impuesto[]" value="' + impuesto + '"><input type="hidden" name="beneficio[]" value="' + beneficio
                + '"><input type="hidden" name="precio_venta[]" value="' +  p_venta
                + '"><input type="hidden" name="impuesto2[]" value="' + impuesto2
                + '"><input type="text"  style="width: 55%" name="des[]" class="outlinenone" value="' + articulo
                + '" readonly><input type="text"  style="width: 44%" name="descripciondc[]" placeholder="Apartado suprime marca y modelo, es orientado a servicio"><input type="text"  style="width: 50%" name="garantiadc[]" placeholder="Apartado para garantia"></td><td class="text-center"><input  style="width: 100%"  class="outlinenone"  name="cantidad[]" value="' + cantidad
                + '" readonly></td><td class="text-center"><input  style="width: 100%"  class="outlinenone"             name="descuentou[]" value="' + descuentou
                + '" readonly></td><td class="text-right"><input   style="width: 100%"  class="outlinenone text-right"  name="precio_lista[]" value="' + precio_lista
                + '" readonly></td><td class="text-right" >' + subtotal[cont] + ' ' + exento + '</td></tr>';
            cont++;


            total = Math.round(total * 100) / 100
            $("#total_venta").val(total);
            $("#total").text(total);
            $("#descuentou").text(descuentou);
            $("#codigo_articulo").focus();

            limpiar();
            evaluar();
            $('#detalles').prepend(fila);
        } else {
            swal("Advertencia", "La cantidad a vender supera el stock!!!", "warning");
        }

    } else {    
        swal("Error", "Error al ingresar el detalle de la venta, revise los datos del artículo!!!", "error");
    }
}


function eliminar(index) {
    total = total - subtotal[index];
    total = Math.round(total * 100) / 100
    $("#total").html("$ " + total);
    $("#total_venta").val(total);
    $("#fila" + index).remove();
    evaluar();
}


