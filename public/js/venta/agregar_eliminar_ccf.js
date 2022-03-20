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

    if(idarticulo!="" && cantidad!="" && cantidad>0  && precio_venta!=""){
        if(cantidad<=stock){
        
            tp1 =  precio_lista- (precio_lista * (descuentou/100))    
            tp = tp1 /1.13
            subtotal1  = (cantidad*tp);
            subtotal[cont] = Math.round(subtotal1*100)/100
            total = total+subtotal[cont];

            var fila = '<tr class="selected" id="fila'+cont
            +'"><td class="text-center"><button type="button" class="btn btn-warning btn-xs"  onclick="eliminar('+cont
            +');">x</button></td><td><input type="hidden" name="idarticulo[]"  value="'+idarticulo
            +'"><input type="hidden" name="impuesto[]" value="'+impuesto+'"><input type="hidden" name="beneficio[]" value="'+beneficio
            +'"><input type="hidden" name="precio_venta[]" value="'+tp1
            +'"><input type="hidden" name="precio_lista[]" value="'+precio_lista
            +'"><input type="hidden" name="impuesto2[]" value="'+impuesto2
            +'"><input type="text" class="outlinenone"   style="width: 59%" value="'+articulo
            +'" readonly><input type="text" style="width: 40%" name="descripciondv[]"><input type="text" style="width: 20%"  placeholder="Serie" name="serie[]"><input type="text" placeholder="Garantia" style="width: 20%" name="garantia[]"></td><td class="text-center"><input size="5"  class="outlinenone"  name="cantidad[]" value="'+cantidad
            +'" readonly></td><td class="text-center"><input size="5"  class="outlinenone"  name="descuentou[]" value="'+descuentou
            +'" readonly></td><td class="text-right"><input  size="5" class="outlinenone"   value="'+Math.round(tp*100)/100
            +'" readonly></td><td class="text-right">'+subtotal[cont]+ ' ' +exento+'</td></tr>';
            cont++;

        
            $("#sumas").text(Math.round(total*100)/100);

            sumas = ($("#sumas").text()*1);
        
            ivav = sumas * 0.13;
            $("#ivav").text(dosDecimales(ivav));
            $("#totalf").html(dosDecimales(sumas+ivav)); 
            $("#total_venta").val(dosDecimales(sumas+ivav));
            $("#total").html(dosDecimales(sumas+ivav));
                
            if($("#empresa").val() == " "){
                swal("Info", "Ingrese cliente, el campo cliente  no puede estar vacío!!!", "warning");
            }
            limpiar();
            evaluar();
            $('#detalles').append(fila);

            }else{   swal("Advertencia", "La cantidad a vender supera el stock!!!", "warning");}

    }else{swal("Error", "Error al ingresar el detalle de la venta, revise los datos del artículo!!!", "error");  }
}

function eliminar(index){
    
    total = total-subtotal[index];
    $("#sumas").html(Math.round(total*100)/100);
    $("#fila"+index).remove();
    sumas = ($("#sumas").text()*1);
    ivar = sumas*0.13;
    iva = Math.round(ivar*100)/100
    $("#ivav").html(iva);
    $("#total").text(Math.round((sumas+iva)*100)/100);
    $("#total_venta").val(sumas+iva);

    evaluar();
}


function dosDecimales(n) {
    let t = n.toString();
    let regex = /(\d*.\d{0,2})/;
    return t.match(regex)[0];
}

