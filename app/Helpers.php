<?php

function monoActual()
{
    return auth()->user();
}

function sumar($a, $b)
{
    $c = $a * $b;
    return $c;
}

function precio($art, $varios)
{

    $cyp = (($art->porcentaje / 100) * $art->costoProducto) + $art->costoProducto;
   
    if ($art->impuesto == 0 && $art->impuestodos == 0) {
        $precio = $cyp;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 1) {
        $precio = (($cyp * $varios->iva) + ($cyp * $varios->cesc)) + $cyp;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 0) {
        $precio = ($cyp * $varios->iva) + $cyp;

    } else {
        $precio = ($cyp * $varios->impuestodos) + $cyp;
    }
    $preciosd = $precio;


    if ($art->descuento_art != null && $art->descuento_art > 0) {
        $p = $precio * ($art->descuento_art / 100);
        $preciocd = $precio - $p;
    } else {
        $preciocd = $precio;
    }


    $utilidad = 0; 
    if ($art->impuesto == 0 && $art->impuestodos == 0) {
        $utilidad = $preciocd - $art->costoProducto;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 1) {
        $utilidad =   ($preciocd/($varios->iva + $varios->cesc + 1)) -$art->costoProducto ;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 0) {
        $utilidad =   ($preciocd/($varios->iva+ 1)) - $art->costoProducto ;

    } else {
        $utilidad =  ($preciocd/($varios->cesc + 1))- $art->costoProducto  ;
    }



    $cyp2 = (($art->porcentaje2 / 100) * $art->costoProducto) + $art->costoProducto;
    
    if ($art->impuesto == 0 && $art->impuestodos == 0) {
        $precio2 = $cyp2;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 1) {
        $precio2 = (($cyp2 * $varios->iva) + ($cyp2 * $varios->cesc)) + $cyp;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 0) {
        $precio2 = ($cyp2 * $varios->iva) + $cyp2;

    } else {
        $precio2 = ($cyp2 * $varios->impuestodos) + $cyp2;
    }
    $preciosd2 = $precio2;



    $utilidad2 = 0; 
    if ($art->impuesto == 0 && $art->impuestodos == 0) {
        $utilidad2 = $precio2 - $art->costoProducto;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 1) {
        $utilidad2 =   ($precio2/($varios->iva + $varios->cesc + 1)) -$art->costoProducto;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 0) {
        $utilidad2 =   ($precio2/($varios->iva+ 1)) - $art->costoProducto;

    } else {
        $utilidad2 =  ($precio2/($varios->cesc + 1))- $art->costoProducto;
    }
    /*MAYOREO 2 */
    $cyp3 = (($art->porcentaje3 / 100) * $art->costoProducto) + $art->costoProducto;
    
    if ($art->impuesto == 0 && $art->impuestodos == 0) {
        $precio3 = $cyp3;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 1) {
        $precio3 = (($cyp3 * $varios->iva) + ($cyp3 * $varios->cesc)) + $cyp;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 0) {
        $precio3 = ($cyp3 * $varios->iva) + $cyp3;

    } else {
        $precio3 = ($cyp3 * $varios->impuestodos) + $cyp3;
    }
    $preciosd3 = $precio3;



    $utilidad3 = 0; 
    if ($art->impuesto == 0 && $art->impuestodos == 0) {
        $utilidad3 = $precio3 - $art->costoProducto;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 1) {
        $utilidad3 =   ($precio3/($varios->iva + $varios->cesc + 1)) -$art->costoProducto;

    } elseif ($art->impuesto == 1 && $art->impuestodos == 0) {
        $utilidad3 =   ($precio3/($varios->iva+ 1)) - $art->costoProducto;

    } else {
        $utilidad3 =  ($precio3/($varios->cesc + 1))- $art->costoProducto;
    }
    

    $preciosd = $precio;


    return array($preciosd, $preciocd, $utilidad, $utilidad2, $preciosd2, $utilidad3 ,  $preciosd3);

}

/*APARTADO COTIZACIONES */



function cpd($det, $venta)  //calculo precio para documentos
{
    if($venta->tipo_comprobante == "Factura" || $venta->tipo_comprobante == 1  || $venta->tipo_comprobante == 2 || $venta->tipo_comprobante == 4){
        $precio_lista = $det->precio_lista; 
        $sub_total =  ($det->precio_lista - ($det->precio_lista * ($det->descuento / 100))) * $det->cantidad; 
    }elseif ($venta->tipo_comprobante == "CCF" || $venta->tipo_comprobante == 3 ){
        $precio_lista = $det->precio_lista/1.13; 
        $sub_total = ($precio_lista - ($precio_lista * ($det->descuento / 100))) * $det->cantidad;
    }

    return array($precio_lista, $sub_total);
}



function cpd2($det, $venta, $varios)  //calculo precio ticket
{
   
        $precio_lista = $det->precio_lista; 
        $sub_total =  ($det->precio_lista - ($det->precio_lista * ($det->descuento / 100))) * $det->cantidad; 
        $desc = ($det->precio_lista * ($det->descuento / 100)) * $det->cantidad; 

        if ($det->impuesto == 0  && $det->impuestodos == 0){
            $excento =  $sub_total ; 
            $cesc =  0 ; 
            $gravado = 0; 
        }elseif ($det->impuesto == 1  && $det->impuestodos == 1){
            $excento = 0;
            $cesc =  ($sub_total/($varios->iva + $varios->cesc + 1)) * $varios->cesc ; 
            $gravado =  $sub_total - $cesc ;  
        }elseif ($det->impuesto == 1  && $det->impuestodos == 0){ //GRABADO
            $cesc = 0; 
            $excento = 0;
            $gravado = $sub_total;  
        }else{
            $cesc =  0 ; 
            $excento = 0;
            $gravado = 0; 
        }

    return array($precio_lista, $sub_total, $excento, $gravado, $cesc, $desc);
}




function fechaCastellano($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "MiÉrcoles", "Jueves", "Viernes", "SÁbado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    // return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    return $numeroDia . " de " . $nombreMes . " de " . $anio;
}

function fechaMes($fecha)
{
    $fecha = substr($fecha, 0, 10);

    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));

    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombreMes . " " . $anio;
}
