<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Http\Requests\IngresoFormEditRequest;
use App\Ingreso;
use App\Articulo;
use App\DetalleIngreso;
use App\Miscelanea; 
use DB;
use Barryvdh\DomPDF\Facade as PDF;


use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $numero = $request->get('numero');
        $idcliente = $request->get('idcliente');
       //
        if ($numero > 0 || $idcliente > 0) {
            $numero == null ? $numero = 'AAAA' : ''; 
            $ingresos = DB::table('ingreso as i')
                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                ->leftjoin('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                ->select('i.idingreso', 'p.nombre', 'p.tel', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.retencion' ,  'i.documento' ,'i.fuente' , 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
                ->where('i.idproveedor' , $idcliente)
                ->orwhere('i.num_comprobante','LIKE' , '%' . $numero . '%')
                ->orderBy('i.idingreso', 'desc')
                ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
                ->get();
        }else{
            $ingresos = DB::table('ingreso as i')
                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                ->leftjoin('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                ->select('i.idingreso', 'p.nombre', 'p.tel', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.retencion' ,  'i.documento' ,'i.fuente' , 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
                //->where('i.num_comprobante', 'LIKE', '%' . $query . '%')
                ->orderBy('i.idingreso', 'desc')
                ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
                ->take(25)
                ->get();
        }
            $data = [
                "ingresos" => $ingresos
           //     "searchText" => $query
            ];

            return view('compras.ingreso.index', $data);
        
    }

    public function create(Request $request)
    {  $id =  $request->get('id');

        $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
        $marcas = DB::table('marca')->orderBy('nombreMarca')->get();


        $ingresos = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->leftjoin('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'p.nombre', 'p.tel', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('tipo_comprobante', '=', 'CCF')
            ->orderBy('i.idingreso', 'desc')
            ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
            ->get();

        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
            "ingresos" => $ingresos,

        ];

        

         if($id == 1) {
            return view('compras/ingreso/factura', $data);
        }else{
            return view('compras/ingreso/ccf', $data);
        } 
    }

    public function store(IngresoFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->idproveedor = $request->get('idP');
            $ingreso->total_ingreso = $request->get('total_compra');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->retencion = $request->get('retencion');
            //$mytime = Carbon::now('America/El_Salvador');
            $ingreso->fecha_hora = $request->get('check_in');
            $ingreso->fuente = $request->get('fuente');
            $ingreso->estado = 'Activo';


            $file = Input::file('documento');

            if ($file == null){

            }else{
                $file->move(public_path() . '/facccf', time() . $file->getClientOriginalName());
                $ingreso->documento = time() . $file->getClientOriginalName();
            }

            

            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');
            $fecha_fac = $request->get('fecha_fac');
            $fecha_ven = $request->get('fecha_ven');
            $lote = $request->get('lote');

            $cont = 0;
            while ($cont < count($idarticulo)) {
                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->fecha_fac = $fecha_fac[$cont];
                $detalle->fecha_ven = $fecha_ven[$cont];
                $detalle->lote = $lote[$cont];
                $detalle->save();

                $cont++;
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('ingreso')->with('success', 'COMPRA INGRESADA CORRECTAMENTE !');
    }

    public function update(IngresoFormEditRequest $request, $id)
    {//dd($request,  $idingreso = $request->get('idingreso'), $id); 
        $ingreso = Ingreso::findOrFail($id);

        try {
            DB::beginTransaction();
            $ingreso->idproveedor = $request->get('idP');
            $ingreso->total_ingreso = $request->get('total_compra');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->fecha_hora = $request->get('check_in');
            $ingreso->retencion = $request->get('retencion');
            $ingreso->fuente = $request->get('fuente');

            $hoja_original = $request->get('hoja_original');

            

        if (Input::hasFile('documento')) {
            
            if ($hoja_original != null) {
                $mi_hoja = public_path() . '/facccf/' . $hoja_original;
                //dd($mi_hoja ); 
                if (file_exists($mi_hoja)) {
                    $image_path = public_path() . '/facccf/' . $hoja_original;
                    unlink($image_path);
                }

                $file = Input::file('documento');
                $file->move(public_path() . '/facccf/', $file->getClientOriginalName());
                $ingreso->documento = $file->getClientOriginalName();

            } else {
               
                $file = Input::file('documento');
                $file->move(public_path() . '/facccf/', $file->getClientOriginalName());
                $ingreso->documento = $file->getClientOriginalName();
            }

        }


            $ingreso->update();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');

            $fecha_fac = $request->get('fecha_fac');
            $fecha_ven = $request->get('fecha_ven');
            $lote = $request->get('lote');

            DetalleIngreso::where('idingreso', $id)->delete();
            
            if (isset($idarticulo)) {
                $cont = 0;
                while ($cont < count($idarticulo)) {
                    $detalle = new DetalleIngreso();
                    $detalle->idingreso = $ingreso->idingreso;
                    $detalle->idarticulo = $idarticulo[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->precio_compra = $precio_compra[$cont];
                    $detalle->fecha_fac = $fecha_fac[$cont];
                    $detalle->fecha_ven = $fecha_ven[$cont];
                    $detalle->lote = $lote[$cont];
                    $detalle->save();

                    $cont++;
                }
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('ingreso')->with('success', 'Ingreso actualizado correctamente !');
    }


    public function edit($id)
    {
        $ingreso = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'i.fecha_hora as fecha', 'p.idpersona', 'p.nombre', 'i.tipo_comprobante', 'i.documento',  'i.fuente', 'i.retencion', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.idingreso', '=', $id)
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'precio_venta', 'd.idarticulo', 'd.fecha_fac', 'd.fecha_ven', 'd.lote')
            ->where('d.idingreso', '=', $id)
            ->get();

        $data = [
            "ingreso" => $ingreso,
            "detalles" => $detalles
        ];

        $tc = $ingreso->tipo_comprobante; 
        if($tc == 'FACTURA'){
            return view('compras.ingreso.factura', $data);
        }else{
            return view('compras.ingreso.ccf', $data);
        }
        
    }


    public function show($id)
    {

        $ingreso = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'i.fecha_hora as fecha', 'p.nombre', 'i.tipo_comprobante',  'i.retencion', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))            
            ->where('i.idingreso', '=', $id)
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->join('modelo as md', 'a.idmodelo', '=', 'md.idModelo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'precio_venta', 'nombreModelo', 'fecha_fac', 'fecha_ven', 'lote')
            ->where('d.idingreso', '=', $id)
            ->get();
        $varios = Miscelanea::first();
        $data = [
            "ingreso" => $ingreso,
            "detalles" => $detalles, 
            "varios" => $varios
        ];

        return view('compras.ingreso.show', $data);
    }

    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->estado = 'Cancelado';
        $ingreso->update();
        return Redirect::to('ingreso')->with('warning', 'Registro dado de baja !!!');
    }


    public function reporte(Request $request)
    {
        return view('compras.ingreso.reportes.reporte');
    }


    public function rapdf(Request $request)
    {   //  dd($request);
        if ($request) {
            $query = trim($request->get('fecha'));
            $query2 = trim($request->get('fecha2'));
            $query3 = trim($request->get('texto'));
            $idproveedor = $request->get('idP'); 
           // dd($idproveedor); 
            if ($idproveedor == null){
                $idproveedor = '%'; 
            }

            $ingresos = DB::table('ingreso as i')
                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                ->select('i.idingreso', 'p.nombre', 'p.iva',   'i.tipo_comprobante', 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado',   'i.retencion',DB::raw('sum(di.cantidad*precio_compra) as total'))
                ->where('i.estado', '=', 'Activo')
                ->where('i.idproveedor', 'LIKE', $idproveedor)
                ->whereBetween('fecha_hora', [$query . '%', $query2 . '%'])
                ->orderBy('i.idingreso', 'desc')
                ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
                ->get();

            $ingresos2 = DB::table('salida as s')
                ->join('persona as p', 's.id_proveedor', '=', 'p.idpersona')
                ->select('s.id_salida', 'p.nombre', 'p.iva as ncr',   's.tipo', 's.numero', 's.valor', 's.fecha', 's.retencion' , 's.iva', 's.imp1', 's.imp2')
                ->where('tipo', 3)
                ->whereBetween('fecha', [$query, $query2])
                ->orderBy('fecha', 'desc')
                ->get();


            $ingresos3 = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'p.nombre', 'p.iva', 'p.nit',   'i.tipo_comprobante',  'i.serie_comprobante',  'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado',   'i.retencion',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.retencion', '>', 0.01)
            ->where('i.estado', '=', 'Activo')
            ->where('i.idproveedor', 'LIKE', $idproveedor)
            ->whereBetween('fecha_hora', [$query . '%', $query2 . '%'])
            ->orderBy('i.idingreso', 'desc')
            ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
            ->get();    

            //dd($ingresos2); 
            $varios = Miscelanea::first();
            $data = [
                "ingresos" => $ingresos,
                "ingresos2" => $ingresos2,
                "ingresos3" => $ingresos3,
                "searchText" => $query,
                "request" => $request, 
                "varios" => $varios
            ];

          return view('compras.ingreso.reportes.rapdf', $data);
        }
    }
}
/*435 */