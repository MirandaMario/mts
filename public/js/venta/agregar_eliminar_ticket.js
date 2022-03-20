function agregar(){
    datosArticulo = $("#articulo").val().split('      ');
    idarticulo = datosArticulo[0];
    articulo = datosArticulo[0]+" "+datosArticulo[4] +" "+datosArticulo[2] +" "+datosArticulo[1];
    cantidad = $("#cantidad").val() * 1;
    precio_lista = Math.round($("#precio_lista").val()*100)/100;
    impuesto = $("#impuesto").val()*1;
    impuesto2 = $("#impuestodos").val()*1;
    descuentou = $("#descuentou").val()*1  
    beneficio = $("#beneficio").val()*1;
    stock = $("#stock").val() * 1;
    
    exento = impuesto === 1 ? exento = "G" : exento = "E"; 
    
    if(idarticulo!="" && cantidad!=""  && precio_lista!=""){
        if(cantidad<=stock){

            tp =  precio_lista- (precio_lista * (descuentou/100))                
            subtotal[cont] = Math.round((tp*cantidad)*100)/100
            total = total+subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont
            +'"><td class="text-center"><button type="button" class="btn btn-warning btn-xs"  onclick="eliminar('+cont
            +');">x</button></td><td><input type="hidden" name="idarticulo[]"  value="'+idarticulo
            +'"><input type="hidden" name="impuesto[]" value="'+impuesto+'"><input type="hidden" name="beneficio[]" value="'+beneficio
            +'"><input type="hidden" name="precio_venta[]" value="'+tp
            +'"><input type="hidden" name="impuesto2[]" value="'+impuesto2
            +'"><input type="text" style="width: 100%"  class="outlinenone"  value="'+articulo
            +'"></td><td class="text-center"><input style="width: 100%" size="1"  class="outlinenone"  name="cantidad[]" value="'+cantidad
            +'" readonly></td><td class="text-center"><input style="width: 100%" size="1"  class="outlinenone"  name="descuentou[]" value="'+descuentou
            +'" readonly></td><td class="text-right"><input  style="width: 100%"  size="1"   class="outlinenone"  name="precio_lista[]" value="'+precio_lista
            +'" readonly></td><td class="text-right">'+subtotal[cont]+ ' ' +exento+'</td></tr>';
            cont++;

            total = Math.round(total*100)/100
            $("#sumas").html(total);
            $("#total_venta").val(total);
            $("#codigo_articulo").focus();

            sumas = ($("#sumas").text()*1);
        
            $('#total').text(Math.round(sumas * 100) / 100);
            limpiar();
            evaluar(); 
            $('#detalles').prepend(fila);
        }else {
            swal("Advertencia", "La cantidad a vender supera el stock!!!", "warning");
        }

    } else {    
        swal("Error", "Error al ingresar el detalle de la venta, revise los datos del artículo!!!", "error");
    }
}


function eliminar(index){
    total = total-subtotal[index];
    $("#sumas").html(Math.round(total*100)/100);
    $("#fila"+index).remove()
    $('#total').text(Math.round(total*100)/100);
    $("#total_venta").val(total);
    evaluar();
}