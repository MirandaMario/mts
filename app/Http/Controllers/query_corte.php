<?php
//dd($query3); 

use App\Miscelanea; 
$varios = Miscelanea::first();
$ventas = DB::table('venta as v')
    ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
    ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
    ->select('v.fecha_hora', 'p.nombre',  'p.iva', 'v.tipo_comprobante', 'v.estado', 'v.num_comprobante', 'v.idtienda', 'v.envio', 'v.envio_interno', 'v.forma_pago', 
        DB::raw('SUM(dv.precio_venta * dv.cantidad) as  total_venta'))
    ->where('v.idtienda', $idtienda)
    ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
    ->where('v.idusuario', 'LIKE', '%' . $vendedor . '%')
    ->whereBetween('fecha_hora', [$query, $query2])
    ->groupBy('v.idventa')
    ->orderBy('num_comprobante', 'desc')
    ->get();



$ventas_dias = DB::table('venta as v')
    ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
    ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
    ->select('v.fecha_hora', 'p.iva', 'v.tipo_comprobante', 'v.estado',  'v.idtienda',
        DB::raw('SUM(dv.precio_venta * dv.cantidad) as  total_venta'))
    ->where('v.idtienda', $idtienda)
    ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
    ->where('v.idusuario', 'LIKE', '%' . $vendedor . '%')
    ->whereBetween('fecha_hora', [$query, $query2])
    ->groupBy('fecha_hora')
    ->orderBy('num_comprobante', 'desc')
    ->get();    

$resumen = DB::table('venta as v')
    ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
    ->select(DB::raw('MAX(num_comprobante) as mayor'), DB::raw('MIN(num_comprobante) as menor'),
        DB::raw('SUM(((dv.precio_venta * dv.cantidad) - ((dv.precio_venta * dv.cantidad) * (dv.descuento / 100)))) as  total_venta'))
    ->where('v.idtienda', $idtienda)
    ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
    ->whereBetween('fecha_hora', [$query, $query2])
    ->first();

$exenta = DB::table('venta as v')
    ->join('detalle_venta as dv', 'v.idventa', 'dv.idventa')
    ->select(DB::raw('SUM(((dv.precio_venta * dv.cantidad) - ((dv.precio_venta * dv.cantidad) * (dv.descuento / 100)))) as exentas'))
    ->where('v.idtienda', $idtienda)
    ->where('dv.impuesto', 0)
    ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
    ->whereBetween('fecha_hora', [$query, $query2])
    ->first(); 
$devolucion = DB::table('venta as v')
    ->join('detalle_venta as dv', 'v.idventa', 'dv.idventa')
    ->select(DB::raw('SUM(((dv.precio_venta * dv.cantidad) - ((dv.precio_venta * dv.cantidad) * (dv.descuento / 100)))) as devolucion'),
        DB::raw('COUNT(num_comprobante) as cantidad_devoluciones'))
    ->where('v.idtienda', $idtienda)
    ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
    ->where('dv.cantidad', '<', 0)
    ->whereBetween('fecha_hora', [$query, $query2])
    ->first(); 

$gravadas = $resumen->total_venta - $exenta->exentas;

$data = [
    "ventas" => $ventas,
    "ventas_dias" => $ventas_dias,
    "request" => $request,
    "resumen" => $resumen,
    "exenta" => $exenta,
    "devolucion" => $devolucion,
    "gravadas" => $gravadas, 
    "varios" => $varios
]; 