<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\DetallePedido;
use DB;
use Illuminate\Support\Facades\Redirect;

class PedidoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pedidos = DB::table('pedido as p')
        ->join('persona as pe', 'p.id_cliente', '=', 'pe.idpersona')
        ->join('munsv as mu' , 'pe.municipio', '=' , 'mu.ID')
        ->join('depsv as de' , 'mu.DEPSV_ID', '=', 'de.ID')
        ->get(); 

        $pedidosl = DB::table('pedido as p')
        ->join('munsv as mu' , 'p.pidmunicipio', '=' , 'mu.ID')
        ->join('depsv as de' , 'mu.DEPSV_ID', '=', 'de.ID')
        ->get();
        //return view('pedido.index', compact('pedidos')) ; 
        $data = ["pedidos" => $pedidos,
        "pedidosl" => $pedidosl
        ];
        return view('pedido.index', $data) ; 
    }

    public function edit($id)
    {
        $estados = DB::table('estado')->get();
        $pedido = DB::table('pedido as p')
        ->join('persona as pe', 'p.id_cliente', '=', 'pe.idpersona')
        ->join('munsv as mu' , 'pe.municipio', '=' , 'mu.ID')
        ->join('depsv as de' , 'mu.DEPSV_ID', '=', 'de.ID')
        ->where('id_pedido', $id)
        ->first();

        $detalle = DetallePedido::join('articulo as a', 'id_articulo', '=', 'a.idarticulo')
        ->join('categoria as cat', 'a.idcategoria', '=', 'cat.idcategoria')
        ->join('modelo as mo', 'a.idModelo', '=', 'mo.idModelo')
        ->join('marca as mar', 'mo.idMarca', '=', 'mar.idMarca')
        ->where('id_pedido', $id)->get(['nombreMarca', 'nombreCategoria', 'nombreModelo', 'a.nombre', 'cantidad_items','precio', 'descuento','id_articulo']); 

        $data = ["pedido" => $pedido,
                 "detalle" => $detalle,
                 "estados" => $estados
                 ];
        return view('pedido.edit', $data); 
       
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $pedido = Pedido::findOrFail($id);
            $pedido->notas = $request->get('notas');
            $pedido->notasint = $request->get('notasint');
            $pedido->estado = $request->get('estado');
            $pedido->update();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('pedido')->with('success', 'Pedido actualizado correctamente !!!');
    }
}
