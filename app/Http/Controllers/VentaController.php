<?php

namespace App\Http\Controllers;

use App\DetalleVenta;
use App\Http\Requests\VentaFormRequest;
use App\Miscelanea;
use App\Tienda;
use App\Venta;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VentaController extends Controller
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
            $ventas = Venta::ventas_historico($numero, $idcliente);
        } else {
            $idtienda = auth()->user()->id_tienda;
            if ($idtienda > 0) {
                $ventas = Venta::ventas_tienda($idtienda);
            } else {
                $ventas = Venta::ventas();
            }

        }
        

       
        $data = ["ventas" => $ventas];

        return view('ventas.venta.index', $data);
    }

    public function create(Request $request)
    { //dd($request);
        $id = $request->get('id');
        $idtienda = auth()->user()->id_tienda;

        /* $ventas = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->leftjoin('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante', 'v.estado', 'v.total_venta')
            ->where('v.idtienda', $idtienda)
            ->orderBy('v.idventa', 'desc')
            ->groupBy('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante', 'v.estado', 'v.total_venta')
            ->take(50)
            ->get(); */

        $correlativo = "";
        $tienda = DB::table('tienda as t')
        ->join('resolucion as r', 't.id', '=', 'r.tienda_res')
        ->where('r.tienda_res', $idtienda)  
        ->where('r.tipo_documento', $id)        
        ->where('r.estado_res', 1) 
        ->first();

        //dd($tienda); 

        if ($id == 2) {
            $correlativo = $tienda->factura;
        } elseif ($id == 3) {
            $correlativo = $tienda->ccf;
        }

        // dd($tienda, $idtienda, $id);
        $varios = Miscelanea::first();

        $data = [
            "tienda" => $tienda,
         //   "ventas" => $ventas,
            "varios" => $varios,
            "correlativo" => $correlativo
        ];
       // dd($correlativo); 
        if ($id == 1) {
            return view('ventas/venta/ticket/create', $data);
        } elseif (($id == 2)) {
            return view('ventas/venta/factura/create2', $data);
        } elseif (($id == 3)) {
            return view('ventas/venta/ccf/create3', $data);
        } else {
            return view('ventas/venta/create', $data);
        }
    }

    public function edit($id)
    {
        $idtienda = auth()->user()->id_tienda;
        $venta = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'p.idpersona', 'v.estado_pago', 'v.tipo_comprobante', 'v.envio', 'v.envio_interno', 'v.notas', 'v.transporte',
                     'v.serie_comprobante', 'v.num_comprobante', 'v.estado', 'v.total_venta', 'p.direccion' , 'v.forma_pago', 'v.nguia')
            ->where('v.idventa', '=', $id)
            ->first();

        $detalles = DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->select('a.codigo as codigo', 'a.nombre as articulo',   'sobrenombre', 'd.cantidad', 'd.descuento', 'd.precio_venta','d.serie', 'd.garantia','a.idarticulo', 'md.nombreModelo', 'm.nombreMarca', 'd.impuesto', 'd.impuestodos', 'd.beneficio', 'd.precio_lista', 'd.descripciondv')
            ->where('d.idventa', '=', $id)
            ->get();

        $tienda = DB::table('tienda')->where('id', $idtienda)->first();
        $varios = Miscelanea::first();
        $data = [
            "venta" => $venta,
            "detalles" => $detalles,
            "varios" => $varios,
            "tienda" => $tienda,
        ];
        //dd($venta->tipo_comprobante);
        if ($venta->tipo_comprobante == 1) {
            return view('ventas.venta.ticket.edit', $data);
        } elseif ($venta->tipo_comprobante == 2) {
            return view('ventas.venta.factura.edit2', $data);
        } else {
            return view('ventas.venta.ccf.edit3', $data);
        }
    }

    public function update(Request $request, $id)
    { 
        try {
            DB::beginTransaction();
            $venta = Venta::findOrFail($id);
            $venta->idcliente = $request->get('idcliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->serie_comprobante = $request->get('serie_comprobante');
            $venta->num_comprobante = $request->get('num_comprobante');
            $venta->total_venta = $request->get('total_venta');
            $venta->descuento = $request->get('descuento');
            $venta->fecha_hora = $request->get('check_in');
            $venta->envio = $request->get('envio');
            $venta->envio_interno = $request->get('envio_interno');
            $venta->transporte = $request->get('transporte');
            $venta->forma_pago = $request->get('forma_pago');
            $venta->nguia = $request->get('nguia');
            $venta->notas = $request->get('notas');
            $venta->estado_pago = $request->get('estado_pago');
            $venta->estado = 'Activo';
            $venta->update();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $precio_lista = $request->get('precio_lista');
            $impuesto = $request->get('impuesto');
            $impuestodos = $request->get('impuesto2');
            $descuentou = $request->get('descuentou');
            $beneficio = $request->get('beneficio');
            $descripciondv = $request->get('descripciondv');
            $serie = $request->get('serie');
            $garantia = $request->get('garantia');
            $sobrenombre = $request->get('sobrenombre');

            $deletedRows = DetalleVenta::where('idventa', $venta->idventa)->delete();

            if (isset($idarticulo)) {
                $cont = 0;
                while ($cont < count($idarticulo)) {
                    $detalle = new DetalleVenta();
                    $detalle->idventa = $venta->idventa;
                    $detalle->origen = $venta->idtienda;
                    $detalle->idarticulo = $idarticulo[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->impuesto = $impuesto[$cont];
                    $detalle->impuestodos = $impuestodos[$cont];
                    $detalle->precio_venta = $precio_venta[$cont];
                    $detalle->precio_lista = $precio_lista[$cont];
                    $detalle->beneficio = $beneficio[$cont];
                    $detalle->descuento = $descuentou[$cont];
                    $detalle->descripciondv = $descripciondv[$cont];
                    $detalle->serie = $serie[$cont];
                    $detalle->garantia = $garantia[$cont];
                    $detalle->sobrenombre = $sobrenombre[$cont];
                    $detalle->save();
                    $cont++;
                }
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('venta')->with('success', 'Registro actualizado correctamente !!!');
    }

    public function store(VentaFormRequest $request)
    { //dd($request); 
        try {
            DB::beginTransaction();
            $venta = new Venta;

            $tc = $request->get('tipo_comprobante');
            //$nc = $request->get('num_comprobante');
            $idt = $request->get('id_tienda');
            $venta->idtienda = $idt;
            $venta->tipo_comprobante = $tc;


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
            } else {
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
            $descripciondv = $request->get('descripciondv');
            $puntos = $request->get('puntos');
            $serie = $request->get('serie');
            $garantia = $request->get('garantia');
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
            return Redirect::to('venta/create?id=2')->with(['success'=> 'Venta generada satisfactoriamente !!!',  'venta->idventa' => $venta->idventa]);
        } else {
            return Redirect::to('venta/create?id=3')->with(['success'=> 'Venta generada satisfactoriamente !!!',  'venta->idventa' => $venta->idventa]);
        }
    }

    public function show($id)
    { 
        $varios = Miscelanea::first();
        $venta = DetalleVenta::venta($id);
        $detalles = DetalleVenta::detalles($id);
       
        $data = [
            "venta" => $venta,
            "detalles" => $detalles,
            "varios" => $varios
        ];

        if ($venta->tipo_comprobante == 1) {
            return view('ventas.venta.ticket.show', $data);$venta->estado_pago = $request->get('estado_pago');
        } elseif ($venta->tipo_comprobante == 2) {

            $data = PDF::loadView('ventas.venta.factura.show2', $data)->setPaper('letter');
            return $data->stream();
        } elseif ($venta->tipo_comprobante == 4) {

            $data = PDF::loadView('ventas.venta.venta_cot.show4', $data)->setPaper('letter');
            return $data->stream();
        } else {
            //return view('ventas.venta.ccf.show3', $data);
            $data = PDF::loadView('ventas.venta.ccf.show3', $data)->setPaper('letter');
            return $data->stream();
        }
    }

    public function ver_detalle_venta(Request $request)
    { 
        $idventa = $request->get('fila');
        //$varios = Miscelanea::first();
        //$venta = DetalleVenta::venta($idventa);
        $detalles = DetalleVenta::detalles($idventa);
       //
    
        if (!$detalles->isEmpty()) {
            $output = '<ul class="dropdown-menu"  style="display:block; position:absolute; width: 500%;">';
            foreach ($detalles as $row) {
                $output .= '<li>' . $row->articulo . '     ' . $row->nombreModelo . ' ' . $row->nombreMarca . ' ' . $row->precio_venta . '</li>';
            }
            $output .= '</ul>';
            echo $output;
           
        }

         
    }

    public function reimpresion($id)
    {
        $reimpresion = $id;
        include 'Ticket.php';
        return Redirect::to('venta/create?id=1')->with('success', 'Ticket reimpreso satisfactoriamente !');
    }

    public function show4($id)
    {
        $venta = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'p.idpersona', 'p.grado', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.estado', 'v.total_venta')
            ->where('v.idventa', '=', $id)
            ->first();

        $detalles = DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.codigo as codigo', 'a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precio_venta')
            ->where('d.idventa', '=', $id)
            ->get();

        $data = [
            "venta" => $venta,
            "detalles" => $detalles,
        ];

        $data = PDF::loadView('ventas.venta.show4', $data)->setPaper('letter');

        return $data->stream();

    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->estado = 'Cancelado';
        $venta->update();
        return Redirect::to('venta')->with('warning', 'Registro dado de baja !!!');
    }


    function update_index_venta(Request $request) {
    
        $idventa = $request->get('fila');    //id transaccion
        $valor = $request->get('valor');     //monto
        $columna = $request->get('columna');   

        if ($columna == "ve") {
            DB::table('venta')->where('idventa',  $idventa )->update(['idusuario' => $valor]);
        } elseif ($columna == "e") {
            DB::table('venta')->where('idventa',  $idventa )->update(['envio' => $valor]);
        } elseif ($columna == "ng") {
            DB::table('venta')->where('idventa',  $idventa )->update(['nguia' => $valor]);
        }else {
            DB::table('venta')->where('idventa',  $idventa )->update(['envio_interno' => $valor]);
        }
          
    }

    
    public function vineta($id)
    {   
        $venta = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('munsv as mp', 'p.municipio', '=', 'mp.ID')
            ->join('depsv as dep', 'mp.DEPSV_ID', '=', 'dep.ID')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'p.tel',  'p.direccion', 'p.idpersona', 'v.tipo_comprobante', 'v.serie_comprobante', 
            'dep.DepName as departamento', 'mp.MunName as municipio', 'v.num_comprobante', 'v.estado', 'v.total_venta', 'v.envio')
            ->where('v.idventa', '=', $id)
            ->first();

            $data = [
                "venta" => $venta
            ];
        return view('ventas.venta.vineta', $data);
    }
}