<?php

namespace App\Http\Controllers;

use App\Corte;
use App\Miscelanea;
use App\Tienda;
use App\Venta;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CorteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rol = auth()->user()->rol;
        if ($rol == 1) {

            $cortes = Corte::orderby('id_corte', 'desc')->take(30)->get();
            $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();

        } else {
            $idtienda = auth()->user()->id_tienda;
            $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
            $cortes = Corte::orderby('id_corte', 'desc')
                ->where('id_tienda', $idtienda)
                ->take(30)->get();
        }
        $data = ["cortes" => $cortes, 
                 "categorias" => $categorias];
        return view('ventas/corte/index', $data);
    }

    public function show(Request $request, $id)
    {    
        $corte = DB::table('corte as c')
        ->join('resolucion as r', 'c.idres', 'r.id_resolucion')
        ->where('c.id_corte', $id)
        ->first(); 


        $idtienda = auth()->user()->id_tienda;
        $tienda = Tienda::findOrFail($idtienda);
        //$varios = Miscelanea::first();
        $query = $corte->fecha_inicio;
        $fecha = date(('Y-m-d'), strtotime($corte->fecha_fin));
        $query2 = $fecha . (' 23:59');
        $query3 = '1';
        $vendedor = '%'; 

        include 'query_corte.php';
        $data2 = [
            "varios" => $varios,
            "tienda" => $tienda,
            "corte" => $corte,
        ];

        return view('ventas/corte/show', $data, $data2);
    }

    public function reimpresion(Request $request, $id)
    {
        $vendedor = '%'; 
        $reimpresion = $id;
        include 'Ticket2.php';
        return Redirect::to('corte')->with('success', 'Ticket reimpreso satisfactoriamente !');
    }

    public function create(Request $request)
    {    
        $query = $request->get('fecha');
        $query2 = $request->get('fecha2') . (' 23:59');
        $query3 = $request->get('tipo_comprobante');
        $idtienda = $request->get('tienda');
        $cesc = $request->get('cesc');
        $tipo = $request->get('tipo');
        
        $idcategoria = $request->get('idcategoria');

        $vendedor = $request->get('vendedor');

        if($vendedor != null){
           $vendedor = $vendedor; 
        }else{
            $vendedor = '%'; 
        }


        $foa = $request->get('optradio'); //por documentos o articulos
        if ($foa == 2) {
            include 'beneficio.php';
            return view('ventas.corte.beneficio', $data);
        } else {

            if ($query3 == 1) {
                
                include 'query_corte.php';
                return view('ventas.corte.create', $data);
            } else if ($query3 == "FC"){
               
                include 'reporfacccf.php';
                return view('ventas.corte.create2', $data);
            }else{
                //dd($request); 
                include 'query_corte.php';
                return view('ventas.corte.create2', $data);
            }
        }

    }

    public function store(Request $request)
    {
        $idtienda = auth()->user()->id_tienda;
       
        $fecha = date('Y-m-d H:i');


        $tienda = DB::table('tienda as t')
        ->join('resolucion as r', 't.id', '=', 'r.tienda_res')
        ->where('r.tienda_res', $idtienda)  
        ->where('r.tipo_documento', 1)        
        ->where('r.estado_res', 1) 
        ->first();

        try {
            DB::beginTransaction();
            $corte = new Corte;
            $corte->id_tienda = $idtienda;
            $corte->correlativo = $tienda->ticket;
            $corte->fecha_ejec = $fecha;
            $corte->tipo_corte = $request->get('optradio');
            $corte->fecha_inicio = $request->get('fecha_desde');
            $corte->fecha_fin = $request->get('fecha_hasta');
            $corte->ticket_desde = $request->get('desde');
            $corte->ticket_hasta = $request->get('hasta');
            $corte->exentas = $request->get('exentas');
            $corte->no_sujetas = 0;
            $corte->gravadas = $request->get('gravadas');
            $corte->devolucion = $request->get('devolucion');
            $corte->cantidad_devoluciones = $request->get('cantidad_devoluciones');
            $corte->total_venta = $request->get('total_venta');
            $corte->cantidad_transacciones = $request->get('cantidad_transacciones');
            $corte->idres = $tienda->id_resolucion;
            $corte->save();

            $venta = new Venta;
            $venta->idtienda = $idtienda;
            $venta->num_comprobante = $tienda->ticket;
            $venta->total_venta = $request->get('total_venta');
            $venta->estado = 'Reporte';
            $venta->fecha_hora = $fecha;
            $venta->tipo_comprobante = 1;
            $venta->idcliente = 1;
            $venta->idresolucion = $tienda->id_resolucion;
            $venta->idusuario = auth()->user()->id; 
            $venta->save();


            $tienda = Tienda::findOrFail($idtienda);
            $nc = $tienda->ticket; 
            $tienda->ticket = $nc + 1;
            $tienda->update();
            DB::commit();

        } catch (Exception $ex) {
            DB::rollback();
        }


        $vendedor = '%'; 
        include 'Ticket2.php';
        return Redirect::to('corte')->with('success', 'Corte guardado satisfactoriamente !');
    }
}
