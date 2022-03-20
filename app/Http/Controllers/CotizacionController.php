<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\DetalleCotizacion;
use App\Venta;
use App\DetalleVenta;
use App\Tienda;
use App\Http\Requests\CotizacionFormRequest;
use App\Miscelanea;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CotizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
     
        $numero = $request->get('numero');
        $idcliente = $request->get('idcliente');
       
        if ($numero > 0 || $idcliente > 0) {
            $ventas = Cotizacion::ventas_historico($numero, $idcliente);
        } else {
            $idtienda = auth()->user()->id_tienda;
            if ($idtienda > 0) {
                $ventas = Cotizacion::ventas_tienda($idtienda);
            } else {
                $ventas = Cotizacion::ventas();
            }

        }
           
        $data = ["ventas" => $ventas];

        return view('cotizaciones.index', $data);
    }

    public function create()
    {
        $idtienda = auth()->user()->id_tienda;
        $varios = Miscelanea::first();
        $control = DB::table('tienda')->where('id', $idtienda)->first();
        $data = [
            "control" => $control,
            "varios" => $varios,
            "id2"   => 0
         ];
        return view('cotizaciones/cotizacion', $data);
    }

    public function store(Request $request)
    {   //dd($request);
        $id2 = $request->get('id2');
       
        if ($id2 == 1) { 
            try {
                DB::beginTransaction();
                $venta = new Venta;
    
                $tc = $request->get('tipo_comprobante');
                $idt = $request->get('idtienda');
                $venta->idtienda = $idt;
                $venta->tipo_comprobante = $tc;
    
             
             //dd( $id2); 
                if ($tc == 1) {
                    $tienda = Tienda::findOrFail($idt);
                    $nc = $tienda->ticket; 
                    $tienda->ticket = $nc + 1;
                    $tienda->update();
                } elseif ($tc == 2) {
                    $tienda = Tienda::findOrFail($idt);
                    $nc = $tienda->factura; 
                    $tienda->factura = $nc + 1;
                    $tienda->update();
                } elseif ($tc == 4) {
                    $tienda = Tienda::findOrFail($idt);
                    $nc = $tienda->venta_cotizacion; 
                    $tienda->venta_cotizacion = $nc + 1;
                    $tienda->update();
                }
                 else {
                    $tienda = Tienda::findOrFail($idt);
                    $nc = $tienda->ccf; 
                    $tienda->ccf = $nc + 1;
                    $tienda->update();
                }
               
              
                $venta->num_comprobante = $nc;
                $venta->idcliente = $request->get('idcliente');
                $venta->serie_comprobante = $request->get('serie_comprobante');
                $venta->total_venta = $request->get('total_venta');
                $venta->descuento = $request->get('descuento');
                $venta->fecha_hora = $request->get('check_in');
                $venta->impuesto = $request->get('iva');
                $venta->impuestodos = $request->get('cesc');
                $venta->envio_interno = $request->get('envio_interno');
                $venta->transporte = $request->get('transporte');
                $venta->forma_pago = $request->get('forma_pago');
                $venta->nguia = $request->get('nguia');
                $venta->notas = $request->get('notas');
                $venta->estado = 'Activo';
                $venta->envio = $request->get('envio');
                $venta->idusuario = auth()->user()->id; 
                $venta->idresolucion = $request->get('idresolucion');
                $venta->estado_pago = $request->get('estado_pago');
                $venta->save();
    
                $idarticulo = $request->get('idarticulo');
                $cantidad = $request->get('cantidad');
                $precio_lista = $request->get('precio_lista');
                $precio_venta = $request->get('precio_venta');
                $impuesto = $request->get('impuesto');
                $impuestodos = $request->get('impuesto2');
                $descuentou = $request->get('descuentou');
                $beneficio = $request->get('beneficio');
                $descripciondv = $request->get('descripciondc');
                $puntos = $request->get('puntos');
                $serie = $request->get('serie');
                $garantia = $request->get('garantiadc');
                $sobrenombre = $request->get('sobrenombre');
                
    
    
                $cont = 0;
                while ($cont < count($idarticulo)) {
                    $detalle = new DetalleVenta();
                    $detalle->idventa = $venta->idventa;
                    $detalle->idarticulo = $idarticulo[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->impuesto = $impuesto[$cont];
                    $detalle->impuestodos = $impuestodos[$cont];
                    $detalle->precio_lista = $precio_lista[$cont];
                    $detalle->precio_venta = $precio_venta[$cont];
                    $detalle->beneficio = $beneficio[$cont];
                    $detalle->descuento = $descuentou[$cont];
                    $detalle->descripciondv = $descripciondv[$cont];
                    $detalle->puntos = $puntos[$cont];
                    $detalle->serie = $serie[$cont];
                    $detalle->garantia = $garantia[$cont];
                    $detalle->sobrenombre = $sobrenombre[$cont];
                    $detalle->origen = $venta->idtienda;
                    $detalle->save();
    
                    $cont++;
                }
    
               
                DB::commit();
            } catch (Exception $ex) {
                DB::rollback();
            }
    
            if ($tc == 1) {
    
                if ($tienda->online == 0) {
                    include 'Ticket.php';
                    if (isset($e)) {
                        return Redirect::to('venta/create?id=1')->with('warning', 'Venta generada satisfactoriamente , Pero no se pudo imprimir el Ticket, verificar impesor este conectado y encendido !!! ');
                    } else {
                        return Redirect::to('venta/create?id=1')->with('success', 'Venta generada satisfactoriamente !!!');
                    }
    
                } else {
                    return Redirect::to('venta/create?id=1')->with(['success' => 'Venta generada satisfactoriamente !!!', 'venta->idventa' => $venta->idventa]);
                }
    
            } elseif ($tc == 2) {
                return Redirect::to('venta/create?id=2')->with(['success'=> 'Venta generada satisfactoriamente !!!',  'venta->idventa' => $venta->idventa]);
            } elseif ($tc == 4) {
                return Redirect::to('venta')->with(['success'=> 'Venta generada satisfactoriamente !!!',  'venta->idventa' => $venta->idventa]);
            } else {
                return Redirect::to('venta/create?id=3')->with(['success'=> 'Venta generada satisfactoriamente !!!',  'venta->idventa' => $venta->idventa]);
            }
        } else {
            try {
                DB::beginTransaction();
                $venta = new Cotizacion;
                $venta->idcliente = $request->get('idcliente');
                $venta->tipo_comprobante = $request->get('tipo_comprobante');
                $venta->idtienda = $request->get('idtienda');
                $venta->numeroComprobante = $request->get('num_comprobante');
                $venta->total_cotizacion = $request->get('total_venta');
                $venta->fecha_hora = $request->get('check_in');
                $venta->descripcion = $request->get('descripcion');
                $venta->entrega = $request->get('entrega');
                $venta->validez = $request->get('validez');
                $venta->dirigido = $request->get('dirigido');
                $venta->nota = $request->get('nota');
                $venta->pago = $request->get('pago');
                $venta->garantia = $request->get('garantia');
                $venta->estado = 'Activo';
                $venta->descuento = $request->get('descuento') == null ?  0 : $request->get('descuento');
                $venta->save();
    
                $descuentou = $request->get('descuentou');
                $idarticulo = $request->get('idarticulo');
                $cantidad = $request->get('cantidad');
                $precio_venta = $request->get('precio_venta');
                $precio_lista = $request->get('precio_lista');
                $beneficio = $request->get('beneficio');
                $descripciondc = $request->get('descripciondc');
                $garantiadc = $request->get('garantiadc');
    
                $cont = 0;
                while ($cont < count($idarticulo)) {
                    $detalle = new DetalleCotizacion();
                    $detalle->idCotizacion = $venta->idCotizacion;
                    $detalle->idArticulo = $idarticulo[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->precioVenta = $precio_venta[$cont];
                    $detalle->descuento = $descuentou[$cont];
                    $detalle->precio_lista = $precio_lista[$cont];
                    $detalle->beneficio = $beneficio[$cont];
                    $detalle->descripciondc = $descripciondc[$cont];
                    $detalle->garantiadc = $garantiadc[$cont];
                    $detalle->save();
                    $cont++;
                }
    
                DB::commit();
            } catch (Exception $ex) {
                DB::rollback();
            }
            return Redirect::to('cotizacion')->with('success', 'Cotozación generada satisfactoriamente !');
        }


        
        
    }
    public function update(Request $request, $id)
    {
        $venta = Cotizacion::findOrFail($id);
        try {
            DB::beginTransaction();
            $venta->idcliente = $request->get('idcliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->idtienda = $request->get('idtienda');
            $venta->numeroComprobante = $request->get('num_comprobante');
            $venta->total_cotizacion = $request->get('total_venta');
            $venta->fecha_hora = $request->get('check_in');
            $venta->descripcion = $request->get('descripcion');
            $venta->estado = $request->get('estado');
            $venta->entrega = $request->get('entrega');
            $venta->validez = $request->get('validez');
            $venta->dirigido = $request->get('dirigido');
            $venta->nota = $request->get('nota');
            $venta->pago = $request->get('pago');
            $venta->garantia = $request->get('garantia');
            $venta->descuento = $request->get('descuento') == null ?  0 : $request->get('descuento');
            $venta->estado = 'Activo';

            $venta->save();

            $descuentou = $request->get('descuentou');
            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $precio_lista = $request->get('precio_lista');
            $beneficio = $request->get('beneficio');
            $descripciondc = $request->get('descripciondc');
            $garantiadc = $request->get('garantiadc');
            DetalleCotizacion::where('idCotizacion', $id)->delete();

            if (isset($idarticulo)) {
                $cont = 0;
                while ($cont < count($idarticulo)) {
                    $detalle = new DetalleCotizacion();
                    $detalle->idCotizacion = $id;
                    $detalle->idArticulo = $idarticulo[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->precioVenta = $precio_venta[$cont];
                    $detalle->descuento = $descuentou[$cont];
                    $detalle->precio_lista = $precio_lista[$cont];
                    $detalle->beneficio = $beneficio[$cont];
                    $detalle->descripciondc = $descripciondc[$cont];
                    $detalle->garantiadc = $garantiadc[$cont];
                    $detalle->save();
                    $cont++;
                }
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('cotizacion')->with('success', 'Cotización actualizada satisfactoriamente !');
    }

    public function show($id)
    {
        $venta = DB::table('cotizacion as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_cotizacion as dv', 'v.idCotizacion', '=', 'dv.idCotizacion')
            ->join('tienda as t', 'v.idTienda', '=', 't.id')
            ->select('v.idCotizacion', 'v.fecha_hora', 'p.nombre', 'p.idpersona', 'v.tipo_comprobante', 'v.numeroComprobante', 'v.estado', 'v.nota', 'v.pago', 'v.dirigido', 'v.entrega', 'v.validez', 'v.nota', 'v.garantia', 'v.total_cotizacion', 'v.descripcion', 'p.direccion', 'p.contacto', 'p.tel', 'p.email', 'v.descuento')
            ->where('v.idCotizacion', '=', $id)
            ->first();

        $detalles = DB::table('detalle_cotizacion as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->select('a.codigo as codigo', 'a.nombre as articulo', 'd.cantidad', 'd.precioVenta', 'm.nombreMarca', 'md.nombreModelo', 'd.descuento', 'd.precio_lista', 'd.beneficio as porcentaje', 'd.descripciondc', 'd.garantiadc')
            ->where('d.idCotizacion', '=', $id)
            ->get();

        $varios = Miscelanea::first();

        $data = [
            "venta" => $venta,
            "detalles" => $detalles,
            "varios" => $varios,
        ];

        //return view('cotizaciones.show', $data);
        $data = PDF::loadView('cotizaciones.show', $data)->setPaper('letter');
        return $data->stream();

    }

    public function edit(Request $request, $id)
    {
        $idtienda = auth()->user()->id_tienda;
        $varios = Miscelanea::first();
        $id2 = $request->get('id2');

        $venta = DB::table('cotizacion as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_cotizacion as dv', 'v.idCotizacion', '=', 'dv.idCotizacion')
            ->select('v.idCotizacion', 'v.fecha_hora', 'p.nombre', 'p.idpersona', 'v.tipo_comprobante', 'v.descuento', 'v.numeroComprobante', 'v.estado', 'v.total_cotizacion', 'v.descripcion', 'v.entrega', 'v.validez', 'v.garantia', 'v.nota', 'v.pago', 'v.garantia', 'dirigido')
            ->where('v.idCotizacion', '=', $id)
            ->first();
        $detalles = DB::table('detalle_cotizacion as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->select('a.codigo as codigo', 'a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precioVenta', 'd.idArticulo', 'm.nombreMarca', 'md.nombreModelo', 'd.precio_lista', 'd.beneficio',  'd.descripciondc' ,  'd.garantiadc')
            ->where('d.idCotizacion', '=', $id)
            ->get();

        $data = [
            "venta" => $venta,
            "detalles" => $detalles,
            "varios" => $varios,
            "id2"    => $id2
        ];

        return view('cotizaciones/cotizacion', $data);
    }

}
/*277 */
