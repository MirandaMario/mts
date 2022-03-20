
<!-- ticket de venta directo -->
<?php
use App\DetalleVenta;
use App\Item;
use App\Miscelanea;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

if (isset($reimpresion)) {
    $id = $reimpresion;
} else {
    $id = DB::table('venta')->select('idventa')->orderBy('idventa', 'desc')->first(); //y las misma tienda
    $id = $id->idventa;
}

$venta      = DetalleVenta::venta($id);
$detalles   = DetalleVenta::detalles($id);
$varios     = Miscelanea::first();

try {
    $connector = new NetworkPrintConnector("192.168.0.10", 9100);
} catch (Exception $e) {
    return $e;
}

$printer = new Printer($connector);
$printer->setFont(Printer::FONT_A);
$printer->setEmphasis(true);
$printer->setJustification(Printer::JUSTIFY_CENTER);

$printer->text($venta->nombreTienda . "\n");
$printer->text($varios->nombre . "\n");
$printer->text("NIT: " . $varios->nit . "\n");
$printer->text("NCR: " . $varios->ncr . "\n");
$printer->text("Giro: " . $varios->giro . "\n");
$printer->text("Fecha/hora: " . date("H:i d-m-Y", strtotime($venta->fecha_hora)) . "\n");
$printer->text("Ticket #: " . $venta->num_comprobante . "\n");
$printer->text("Cliente: " . $venta->nombre . "\n");
$printer->text("=========================================\n");
$printer->feed();

$printer->text("CANT   PRODUCTO               P.U. TOTAL.\n");

$i = 0;
$exento = 0;
$gravado = 0;
$cescf = 0;

foreach ($detalles as $value) {
    $precio = cpd2($value, $venta, $varios);
    $i += $precio[1];
    $exento += $precio[2];
    $gravado += $precio[3];
    $cescf += $precio[4];

    $value->impuesto == 1 ? $letra = "G" : $letra = "E";

    $items[] = new item($value->cantidad,
        $value->codigo . " " . strtoupper(substr($value->articulo, 0, 25)),
        $value->precio_lista,
        number_format($precio[1], 2) . $letra, -(number_format($precio[5], 2)));

}

foreach ($items as $item) {
    $printer->setFont(Printer::FONT_C);
    $printer->setEmphasis(true);
    $printer->text($item);
}

$printer->text("=========================================\n");

$printer->text("G = GRAVADO      E = EXENTO             \n");
$printer->setJustification(Printer::JUSTIFY_RIGHT);
$printer->text(str_pad("SUMAS  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($venta->total_venta, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("EXENTO  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($exento, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("GRAVADO  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($gravado, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("VENTAS NO SUJETAS  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format(0.00, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("CESC  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($cescf, 2) . "  \n", 12, ' ', STR_PAD_LEFT));

$printer->text(str_pad("TOTAL A PAGAR  $:    ", 20, ' ', STR_PAD_LEFT));
$printer->text(str_pad(number_format($venta->total_venta, 2) . "  \n", 12, ' ', STR_PAD_LEFT));
$printer->feed(2);

$printer->setFont(Printer::FONT_A);
$printer->setEmphasis(true);
$printer->setJustification(Printer::JUSTIFY_LEFT);

if ($venta->total_venta >= 200.00) {

    $printer->text("Nombre: _________________________________" . "\n");
    $printer->text("DUI/NIT:_________________________________" . "\n");
    $printer->feed(1);
}
$printer->setFont(Printer::FONT_A);
$printer->setEmphasis(true);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("-----------------------------------------\n");
$printer->text($venta->direccion . "\n");
$printer->text("N° de Res." . $venta->numero_resolucion . "\n");
$printer->text("Fecha de Resolución:" . date("d-m-Y", strtotime($venta->fecha_resolucion)) . "\n");
$printer->text("Serie Auto.:" . $venta->rango_desde .' - ' . $venta->rango_hasta. "\n");
$printer->text("Teléfono:" . $venta->tel_tienda . "\n");

$printer->text("Gracias por su compra" . "\n");
$printer->feed(5);
$connector->write(chr(27) . chr(109));
$printer->close();
