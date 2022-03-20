<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Http\Requests\IngresoFormEditRequest;
use App\Ingreso;
use App\Articulo;
use App\DetalleIngreso;
use DB;
use Barryvdh\DomPDF\Facade as PDF;


use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoTiendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
 //dd($request); 
            $ingresos = DB::table('ingreso as i')
                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                ->leftjoin('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                ->select('i.idingreso', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
                ->orderBy('i.idingreso', 'desc')
                ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
                ->get();

            $data = [
                "ingresos" => $ingresos
                ];

            return view('ingresotienda.index', $data);
    }



    public function create()
    {


        $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
        $ingresos = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->leftjoin('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'p.nombre', 'p.tel', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('tipo_comprobante', '=', 'CCF')
            ->orderBy('i.idingreso', 'desc')
            ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
            ->get();


        /* $data = [
            "categorias" => $categorias,
            "ingresos" => $ingresos

        ]; */
        return view('ingresotienda.create'/* , $data */);


    }




    /* public function create2()
    {


        $ingresos = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->leftjoin('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'p.nombre', 'p.tel', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('tipo_comprobante', '=', 'Factura')
            ->orderBy('i.idingreso', 'desc')
            ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
            ->get();

        $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
        $marcas = DB::table('marca')->orderBy('nombreMarca')->get();


        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
            "ingresos" => $ingresos,
            //  "control" => $control
        ];
        return view('compras/ingreso/create2', $data);

        //   return view('compras/ingreso/create2');  //->with('articulos', $articulos);
    }

 */




    public function store(IngresoFormRequest $request)
    {
        //  dd($request);


        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
           // $ingreso->idproveedor = $request->get('idP');
           // $ingreso->total_ingreso = $request->get('total_compra');
          //  $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
          //  $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            //$mytime = Carbon::now('America/El_Salvador');
            $ingreso->fecha_hora = $request->get('check_in');
            $ingreso->estado = 'Activo';


            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;
            while ($cont < count($idarticulo)) {
                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();

                $cont++;
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('ingreso')->with('success', 'Venta generada satisfactoriamente !');
    }

    public function update(IngresoFormEditRequest $request, $id)
    {
        // dd($request);
        $ingreso = Ingreso::findOrFail($id);

        try {
            DB::beginTransaction();
            //$ingreso = new Ingreso;
            $ingreso->idproveedor = $request->get('idP');
            $ingreso->total_ingreso = $request->get('total_compra');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            //$mytime = Carbon::now('America/El_Salvador');
            $ingreso->fecha_hora = $request->get('check_in');
            //$ingreso->estado = 'Activo';


            $ingreso->update();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            // $precio_venta = $request->get('precio_venta');

            $idingreso = $request->get('idingreso');
            $deletedRows = DetalleIngreso::where('idingreso', $idingreso)->delete();


            if (isset($idarticulo)) {
                $cont = 0;
                while ($cont < count($idarticulo)) {
                    $detalle = new DetalleIngreso();
                    $detalle->idingreso = $ingreso->idingreso;
                    $detalle->idarticulo = $idarticulo[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->precio_compra = $precio_compra[$cont];
                    //  $detalle->precio_venta = $precio_venta[$cont];
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

            ->select('i.idingreso', 'i.fecha_hora as fecha', 'p.idpersona', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))

            /*->select('i.idingreso','i.fecha_hora as fecha','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado')*/
            ->where('i.idingreso', '=', $id)
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'precio_venta', 'd.idarticulo')
            ->where('d.idingreso', '=', $id)
            ->get();

       /*  $data = [
            "ingreso" => $ingreso,
            "detalles" => $detalles
        ]; */

        //  dump($data);
        return view('ingresotienda.edit'/* , $data */);
    }
    
   /*  public function edit2($id)
    {

        $ingreso = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')

            ->select('i.idingreso', 'i.fecha_hora as fecha', 'p.idpersona', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))

          
            ->where('i.idingreso', '=', $id)
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'precio_venta', 'd.idarticulo')
            ->where('d.idingreso', '=', $id)
            ->get();

        $data = [
            "ingreso" => $ingreso,
            "detalles" => $detalles
        ];

        //dump($data);
        return view('compras.ingreso.edit2', $data);
    }

 */




    public function show($id)
    {

        $ingreso = DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')

            ->select('i.idingreso', 'i.fecha_hora as fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))

            /*->select('i.idingreso','i.fecha_hora as fecha','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado')*/
            ->where('i.idingreso', '=', $id)
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'precio_venta')
            ->where('d.idingreso', '=', $id)
            ->get();

        $data = [
            "ingreso" => $ingreso,
            "detalles" => $detalles
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


    //Proveedor AJAX


    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('persona')

                ->where('tipo_persona', '=', 'Proveedor')
                //->orwhere('tipo_persona','=','Ambos')

                ->where('nombre', 'LIKE', "%{$query}%")
                //->orwhere('idpersona', 'LIKE', "%{$query}%")



                //->orwhere('tipo_persona','=','Ambos')
                ->take(10)
                ->get();
            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {
                    $output .= '
       <li><a href="#">' . $row->idpersona . ' ' . $row->nombre . ' </a></li>
       ';
                }
                $output .= '</ul>';
                echo $output;
            } else {
                // echo $output = //'<div style="display:block; position:absolute">NO HAY CONINCIDENCIAS REGISTRADAS </div>';
                echo $output = '<a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
            }
        }
    }





    function fetch2(Request $request)
    {
        dd($request); 
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                ->select('a.idarticulo', 'a.codigo', 'a.nombre', 'm.nombreMarca', 'a.descripcion as adesc')
                //    ->select('a.idarticulo','a.codigo','a.nombre',DB::raw('m.nombre as mnombre'))

                ->where('a.codigo', 'LIKE', "{$query}%")
                ->orwhere('a.nombre', 'LIKE', "%{$query}%")
                ->take(10)
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absoluted">';
                foreach ($data as $row) {
                    $output .= '
       <li><a href="#">' . $row->idarticulo . '    ' . $row->codigo . ' ' . $row->nombre . ' ' . $row->nombreMarca . ' ' . $row->adesc . ' </a></li>
       ';
                }
                $output .= '</ul>';
                echo $output;
            } else {
                // echo $output = //'<div style="display:block; position:absolute">NO HAY CONINCIDENCIAS REGISTRADAS </div>';
                echo $output = '<a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
            }
        }
    }



    public function reporte(Request $request)
    {


        return view('compras.ingreso.reportes.reporte');
    }


    public function rapdf(Request $request)
    {
        //  dump($request);
        if ($request) {
            $query = trim($request->get('fecha'));
            $query2 = trim($request->get('fecha2'));
            $query3 = trim($request->get('texto'));

            $ingresos = DB::table('ingreso as i')
                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                ->select('i.idingreso', 'p.nombre', 'p.tel', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.total_ingreso', 'i.fecha_hora', 'i.estado',  DB::raw('sum(di.cantidad*precio_compra) as total'))
                ->where('i.estado', '=', 'Activo')
                // ->where('p.nombre','LIKE','%'.$query3.'%')
                ->whereBetween('fecha_hora', [$query . '%', $query2 . '%'])
                ->orderBy('i.idingreso', 'desc')
                ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado', 'p.tel')
                ->get();

            $data = [
                "ingresos" => $ingresos,
                "searchText" => $query,
                "request" => $request
            ];

            return view('compras.ingreso.reportes.rapdf', $data);

            // $data = PDF::loadView('compras.ingreso.reportes.rapdf', $data);

            //   return $data->stream();
        }
    }
}
