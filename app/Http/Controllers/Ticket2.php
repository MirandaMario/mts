<!-- ticket de cortes -->
<?php
use App\Item2;
use App\Miscelanea;
use App\Corte;
use App\Tienda;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

if (isset($reimpresion)) {
    $id = $reimpresion;
    $corte = Corte::findOrFail($id);
} else {
    $corte = DB::table('corte')->orderBy('id_corte', 'desc')->first(); //y las misma tienda
}

$idtienda = auth()->user()->id_tienda;   
$query = $corte->fecha_inicio;
$fecha =  date(('Y-m-d'),strtotime($corte->fecha_fin));
$query2 = $fecha . (' 23:59'); 
$query3 = '1';
$tienda = Tienda::findOrFail($idtienda);
$varios = Miscelanea::first();

include 'query_corte.php';

try {
    $connector = new NetworkPrintConnector("192.168.0.10", 9100);
} catch (Exception $e) {
    return $e;
}

$printer = new Printer($connector);
$printer->setFont(Printer::FONT_A);
$printer->setEmphasis(true);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text($tienda->nombreTienda . "\n");
$printer->text($varios->nombre . "\n");
$printer->text("NIT  : " . $varios->nit . "\n");
$printer->text("NCR  : " . $varios->ncr . "\n");
$printer->text("Giro  : " . $varios->giro . "\n");
$printer->text("Fecha/hora  : " . date("H:i d-m-Y", strtotime($corte->fecha_ejec)) . "\n");
$printer->text("Ticket #:" . $corte->correlativo . "\n");
$printer->text("=========================================\n");
$printer->feed();

    if ($corte->tipo_corte == 1)
                $printer->text("CORTE DIARIO" . ".\n");
                
        elseif ($corte->tipo_corte == 2)
                $printer->text("CORTE PARCIAL" . ".\n"); 
        else
                $printer->text("CORTE MENSUAL" . ".\n"); 


    if ($corte->fecha_inicio == $corte->fecha_fin ){
           
                $printer->text("Fecha de corte:" . date("d-m-Y", strtotime($corte->fecha_inicio)). "\n"); 
        }else{
            
                $printer->text("F. Desde:" . date("d-m-Y", strtotime($corte->fecha_inicio)). "\n"); 
                $printer->text("F. Hasta:" . date("d-m-Y", strtotime($corte->fecha_fin)). "\n"); 
            }

$printer->text("=========================================\n"); 
$printer->text("Fecha         Número                Total\n");

foreach ($ventas as $value) {
   
    $items[] = new item2(date('d-m H:i',strtotime($value->fecha_hora)), $value->num_comprobante, $value->estado == 'Reporte' ? 'RPT'  : number_format($value->total_venta, 2, '.', ',')  );
}

foreach ($items as $item) {

    $printer->setFont(Printer::FONT_C);
    $printer->setEmphasis(true);
    $printer->text($item);
}

$printer->text("=========================================\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad("Ticket Inicio  :    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad($resumen->menor. "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("Ticket Fin  :    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad($resumen->mayor. "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("V. Exentas  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($exenta->exentas, 2, '.', ',') . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("V. N/S  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($exenta->exentas, 2, '.', ',') . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("V. Gravadas  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($resumen->total_venta - $exenta->exentas, 2, '.', ',') . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("Devoluciones  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($devolucion->devolucion, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("Total  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($resumen->total_venta, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text("-----------------------------------------\n");

$printer->feed(2);
$printer->setEmphasis(true);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text($tienda->direccion. "\n");
$printer->text("N° de Res.:" . $tienda->resolucion . "\n");
$printer->text("Fecha de Resolución:" . date("d-m-Y", strtotime($tienda->fecharesolucion)). "\n");
$printer->text("Serie Auto.:" . $venta->rango_desde .' - ' . $venta->rango_hasta. "\n");
$printer->text("Gracias por su compra"."\n");
$printer->feed(5); 
$connector->write(chr(27) . chr(109));
$printer->close();
