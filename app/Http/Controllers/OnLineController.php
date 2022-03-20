<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Categoria;
use App\DetallePedido;
use App\Http\Requests\PedidoFormRequest;
use App\Http\Requests\PersonaFormRequest;
use App\Mail\NotificacionDePedido;
use App\Mail\NotificacionDePedidoMTECH;
use App\Mail\NotificacionDeValidacionMMSOFT;
use App\Marca;
use App\Mensaje;
use App\Miscelanea;
use App\Pedido;
use App\Persona;
use App\Configuracion;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class OnLineController extends Controller
{
    
    public function index()
    {   
        return Redirect::to('login');
        $varios = Miscelanea::first();
    
       /*  $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.codigo', 'articulo.idcategoria','articulo.impuesto', 'articulo.impuestodos', 'articulo.slug',
            'articulo.porcentaje', 'articulo.costoProducto', 'articulo.imagen1',  'articulo.imagen5','articulo.estado', 'articulo.descuento_art',
            'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria',  'c.cslug', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            ->where('publicado', 1)
            ->orderBy('idarticulo', 'desc')
            ->groupby('articulo.codigo')
            ->take(6)->get(); */
        //dd($productos); 
        /* $productos2 = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.codigo', 'articulo.idcategoria', 'articulo.impuesto', 'articulo.impuestodos', 'articulo.slug',
            'articulo.porcentaje', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5','articulo.estado', 'articulo.descuento_art',
            'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'c.cslug', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            ->where('descuento_art', '>', 1)
            ->where('publicado', 1)
            ->inRandomOrder()
            ->groupby('articulo.codigo')
            ->take(6)->get(); */


        $destacados = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.codigo', 'articulo.idcategoria', 'articulo.impuesto', 'articulo.impuestodos', 'articulo.slug',
            'articulo.porcentaje', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5','articulo.estado', 'articulo.descuento_art',
            'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'c.cslug', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            //->where('descuento_art', '>', 1)
            ->where('destacado', 1)
            ->where('publicado', 1)
            ->inRandomOrder()
            ->groupby('articulo.codigo')
            ->take(12)->get();    
    

        /* $top = DB::table('venta as v')
            ->join('detalle_venta as dv', 'v.idventa', 'dv.idventa')
            ->join('articulo as a', 'a.idarticulo', 'dv.idarticulo')
            ->join('categoria as c', 'a.idCategoria', '=', 'c.idCategoria')
            ->join('modelo as md', 'a.idModelo', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select( 'v.idtienda', 'a.nombre as nombrearticulo', 'a.idarticulo',  'a.porcentaje',  'a.impuesto', 'c.cslug', 'a.impuestodos',  'a.descuento_art', 'a.slug', 'a.imagen1', 'a.imagen5',
                'a.nombre',  'm.nombreMarca','a.idcategoria', 'c.nombreCategoria', 
                'a.costoProducto', 'dv.precio_venta', 'md.nombreModelo',  DB::raw('SUM(dv.cantidad) as cantidadav'),  DB::raw('SUM(stock) as stock'))
            
            ->where('stock', '>',  0)
            ->where('publicado', 1)
            ->groupBy('a.idarticulo')
            ->orderBy('cantidadav', 'desc')
            ->take(6)
            ->get(); */    


        $catwel  = DB::table('categoria')
        ->where(function ($query2) {
            $query2->orwhere('idcategoria', 14);
            $query2->orwhere('idcategoria', 4); 
            $query2->orwhere('idcategoria', 5); 
            $query2->orwhere('idcategoria', 7); 
            $query2->orwhere('idcategoria', 2); 
            $query2->orwhere('idcategoria', 13); 
            $query2->orwhere('idcategoria', 6);
            $query2->orwhere('idcategoria', 20);
        })
        ->take(8)->get();  


            $marcas = Marca::where ('logo', '!=', null)
            ->inRandomOrder()
            ->get();
            $categorias = Categoria::categorias();
         
        $data = [
            //"top" => $top,
            //"productos" => $productos,
            //"productos2" => $productos2,
            "destacados" => $destacados,
            "categorias" => $categorias,
            "marcas" => $marcas,
            "varios" => $varios,
            "catwel" => $catwel

        ];
        if (isset(auth('clients')->user()->confirmed)) {
            if (auth('clients')->user()->confirmed == 1) {
                return view('welcome', $data);
            } else {

                $mensaje = "Sus credenciales son correctas, pero aun no validad su cuenta de correo !!!";
                return Redirect::to('./client/logout')->with('mensaje', $mensaje);
            }
        } else {

            return view('welcome', $data);
        }

        //return view('welcome', $data);
    }

    public function index2(Request $request)
    {
        $varios = Miscelanea::first();

        $idmarca = $request->get('idmarca');
        $idcat = $request->get('id');

        if($idcat != 5 ){ 
            if ($idmarca != null) {
                $productos = Articulo::busqueda_marca($idmarca);
            } else {
                //busqueda por las tres categorias iniciales en  del index
                $productos = Articulo::busqueda_categoria($idcat);
            }

            $categorias = Categoria::categorias();
            $marcas = Marca::orderby('nombreMarca', 'asc')->get();
           // $categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();
            $idmar = "%";
        

            $data = [
                "productos" => $productos,
                "categorias" => $categorias,
            //    "categorias2" => $categorias2,
                "marcas" => $marcas,
                "idcat" => $idcat,
                "idmar" => $idmar,
                "varios" => $varios,
            ];

            return view('online.index', $data);

            }else{
            $productos = Articulo::busqueda_palabra($idcat);
            $productos2 = Articulo::busqueda_reguladores($idcat);
            $productos3 = Articulo::busqueda_ups($idcat);
            $productos4 = Articulo::busqueda_mini_ups($idcat);
            $categorias = Categoria::categorias();
            $marcas = Marca::orderby('nombreMarca', 'asc')->get();
          //  $categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();
            $idcat = Categoria::where('idcategoria', $idcat )->first();
            $idmar = "%";
            $slug = " ";  

            $data = [
                "productos" => $productos,
                "productos2" => $productos2,
                "productos3" => $productos3,
                "productos4" => $productos4,
                "categorias" => $categorias,
            //    "categorias2" => $categorias2,
                "marcas" => $marcas,
                "idcat" => $idcat,
                "idmar" => $idmar,
                "varios" => $varios,
                "slug" => $slug
            ];

            return view('online.blog.protecion_energia', $data);
        }    
    }

    public function oferta(Request $request)
    {
        $varios = Miscelanea::first();
        $idcat = $request->get('id'); //busqueda por las tres categorias iniciales en  del index

        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select(
                'articulo.idarticulo',
                'articulo.nombre',
                'articulo.codigo',
                'articulo.impuesto',
                'articulo.impuestodos',
                'articulo.slug',
                'articulo.porcentaje',
                'articulo.costoProducto',
                'articulo.imagen1',
                'articulo.estado',
                'articulo.descuento_art',
                'st.min',
                'st.max',
                'm.nombreMarca',
                'md.nombreModelo',
                'c.nombreCategoria',
                'articulo.publicado',
                DB::raw('SUM(stock) as stock')
            )
            //->where('c.idCategoria', $idcat)
            ->where('stock', '>',  0)
            ->where('articulo.publicado', 1)
            ->where('articulo.descuento_art', '>', 1)
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(18);

        $categorias = Categoria::categorias();
        $marcas = Marca::orderby('nombreMarca', 'asc')->get();
       // $categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();
        $idmar = "%";

        $data = [
            "productos" => $productos,
            "categorias" => $categorias,
        //    "categorias2" => $categorias2,
            "marcas" => $marcas,
            "idcat" => $idcat,
            "idmar" => $idmar,
            "varios" => $varios,
        ];
        //dd($productos);

        return view('online.oferta', $data);
    }

    public function premio(Request $request)
    {
        $varios = Miscelanea::first();
        $idcat = $request->get('id'); //busqueda por las tres categorias iniciales en  del index

        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select(
                'articulo.idarticulo',
                'articulo.nombre',
                'articulo.codigo',
                'articulo.impuesto',
                'articulo.impuestodos',
                'articulo.slug',
                'articulo.porcentaje',
                'articulo.costoProducto',
                'articulo.imagen1',
                'articulo.estado',
                'articulo.descuento_art',
                'articulo.premio',
                'st.min',
                'st.max',
                'm.nombreMarca',
                'md.nombreModelo',
                'c.nombreCategoria',
                'articulo.publicado',
                DB::raw('SUM(stock) as stock')
            )
            //->where('c.idCategoria', $idcat)
            ->where('articulo.publicado', 1)
            ->where('stock', '>',  0)
            ->where('articulo.premio', '>', 1)
            ->groupby('articulo.codigo')
            ->paginate(16);

        $categorias = Categoria::categorias();
        $marcas = Marca::orderby('nombreMarca', 'asc')->get();
        //$categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();
        $idmar = "%";

        $data = [
            "productos" => $productos,
            "categorias" => $categorias,
        //    "categorias2" => $categorias2,
            "marcas" => $marcas,
            "idcat" => $idcat,
            "idmar" => $idmar,
            "varios" => $varios,
        ];
        //dd($productos);

        return view('online.premio', $data);
    }

    public function buscar(Request $request)
    { //dd($request);
        $varios = Miscelanea::first();
        $idcat = $request->get('id');
        $idmar = $request->get('id2');

        if ($idcat > 0 && $idmar > 0) {
            $productos = Articulo::busqueda_marca_categoria($idcat, $idmar);
        } elseif ($idcat == "%" && $idmar > 0) {
            $productos = Articulo::busqueda_marca($idmar);
        } elseif (($idcat > 0 && $idmar == "%")) {
            $productos = Articulo::busqueda_categoria($idcat);
        } else {
            $productos = Articulo::busqueda();
        }

        $categorias = Categoria::categorias();
        //$marcas = Marca::orderby('nombreMarca', 'asc')->get();

        $marcas = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select( 'm.nombreMarca', 'md.nombreModelo', 'm.idMarca',   'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            ->where('publicado', 1)                  
            ->orderby('m.nombreMarca', 'asc')
            ->groupby('m.idMarca')
            ->get();
       // $categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();

        $data = [
            "productos" => $productos,
            "categorias" => $categorias,
        //    "categorias2" => $categorias2,
            "marcas" => $marcas,
            "idcat" => $idcat,
            "idmar" => $idmar,
            "varios" => $varios,
        ];
        //dd($productos);
        return view('online.index', $data);
    }

    public function busqueda(Request $request)
    { //dd($request);
        $varios = Miscelanea::first();
        $str = $request->get('str');

        $productos = Articulo::busquedastr($str);
        $categorias = Categoria::categorias();
        //$marcas = Marca::orderby('nombreMarca', 'asc')->get();
        $marcas = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select( 'm.nombreMarca', 'md.nombreModelo', 'm.idMarca',   'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            ->where('publicado', 1)                  
            ->orderby('m.nombreMarca', 'asc')
            ->groupby('m.idMarca')
            ->get();
       // $categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();
        $idcat = 0;
        $idmar = 0;
        $data = [
            "productos" => $productos,
            "categorias" => $categorias,
        //    "categorias2" => $categorias2,
            "marcas" => $marcas,
            "idcat" => $idcat,
            "idmar" => $idmar,
            "varios" => $varios,
            "str" => $str,
        ];
        //dd($productos);
        return view('online.index', $data);
    }

    public function show2(Request $request)
    {
        $varios = Miscelanea::first();
        $marcas = Marca::get();
        $categorias = Categoria::categorias();

        $producto = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select(
                'articulo.idarticulo',
                'articulo.nombre',
                'articulo.codigo',
                'articulo.impuesto',
                'articulo.impuestodos',
                'articulo.hoja_tecnica',
                'articulo.porcentaje',
                'articulo.costoProducto',
                'articulo.imagen1',
                'articulo.imagen2',
                'articulo.imagen3',
                'articulo.imagen4',
                'articulo.estado',
                'articulo.descuento_art',
                'articulo.idCategoria',
                'articulo.slug as slug',
                'st.min',
                'st.max',
                'm.nombreMarca',
                'md.idMarca',
                'md.nombreModelo',
                'c.nombreCategoria',
                'articulo.publicado',
                'articulo.descripcion',
                'articulo.premio',
                'articulo.detalles',
                'c.cslug',
                DB::raw('SUM(stock) as stock')
            )
            ->where('articulo.idarticulo', $request->get('id'))
            //   ->groupby('articulo.codigo')
            ->first();

        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->where('c.idCategoria', $producto->idCategoria)
            ->where('articulo.publicado', 1)
            ->inRandomOrder()->take(8)->get();

        $data = [
            "producto" => $producto,
            "productos" => $productos,
            "categorias" => $categorias,
            "marcas" => $marcas,
            "varios" => $varios,
        ];

        return view('online.show', $data);
    }

    public function slug($slug)
    { //dd($slug);
        $varios = Miscelanea::first();
        //$marcas = Marca::get();
        $marcas = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select( 'm.nombreMarca', 'md.nombreModelo', 'm.idMarca',   'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            ->where('publicado', 1)                  
            ->orderby('m.nombreMarca', 'asc')
            ->groupby('m.idMarca')
            ->get();

        $categorias = Categoria::categorias();

        $producto = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select(
                'articulo.idarticulo',
                'articulo.nombre',
                'articulo.codigo',
                'articulo.impuesto',
                'articulo.impuestodos',
                'articulo.urivideo',
                'articulo.porcentaje',
                'articulo.costoProducto',
                'articulo.imagen1',
                'articulo.imagen2',
                'articulo.imagen3',
                'articulo.hoja_tecnica',
                'articulo.imagen4',
                'articulo.estado',
                'articulo.descuento_art',
                'articulo.idCategoria as idCategoria',
                'articulo.slug as slug',
                'st.min',
                'st.max',
                'm.nombreMarca',
                'md.idMarca',
                'md.nombreModelo',
                'c.nombreCategoria',
                'articulo.publicado',
                'articulo.descripcion',
                'articulo.puntos',
                'articulo.detalles',
                'c.cslug',
                'articulo.des_sf',
                'articulo.cdc',
                DB::raw('SUM(stock) as stock')
            )
            ->where('articulo.slug', $slug)
            //   ->groupby('articulo.codigo')
            ->first();
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select(
                'articulo.idarticulo',
                'articulo.nombre',
                'articulo.codigo',
                'articulo.impuesto',
                'articulo.impuestodos',
                'articulo.slug',
                'articulo.porcentaje',
                'articulo.costoProducto',
                'articulo.imagen1',
                'articulo.estado',
                'articulo.descuento_art',
                'st.min',
                'st.max',
                'm.nombreMarca',
                'md.nombreModelo',
                'c.nombreCategoria',
                'articulo.publicado',
                DB::raw('SUM(stock) as stock')
            )
            ->where('stock', '>',  0)
            ->where('c.idCategoria', $producto->idCategoria)
            ->where('articulo.publicado', 1)
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->inRandomOrder()->take(18)->get();

            $catwel  = DB::table('categoria')
            ->where(function ($query2) {
                $query2->orwhere('idcategoria', 14);
                $query2->orwhere('idcategoria', 4); 
                $query2->orwhere('idcategoria', 5); 
                $query2->orwhere('idcategoria', 7); 
                $query2->orwhere('idcategoria', 2); 
                $query2->orwhere('idcategoria', 13); 
                $query2->orwhere('idcategoria', 6);
                $query2->orwhere('idcategoria', 18); 
                $query2->orwhere('idcategoria', 20); 
                $query2->orwhere('idcategoria', 12);
            })
            ->take(10)->get();    
    
        $data = [
            "producto" => $producto,
            "productos" => $productos,
            "categorias" => $categorias,
            "marcas" => $marcas,
            "varios" => $varios,
            "catwel" => $catwel 
        ];
    
        if ($producto->idarticulo == null) {        
            $idcat = Categoria::where('cslug', $slug )->first();
            $datos_categoria =  $idcat; 
            if(isset($idcat->idcategoria)) {
               /*  if ($idcat->idcategoria == 5 ){    
                    $productos = Articulo::busqueda_palabra($idcat->idcategoria);
                    $productos2 = Articulo::busqueda_reguladores($idcat->idcategoria);
                    $productos3 = Articulo::busqueda_ups($idcat->idcategoria);
                    $productos4 = Articulo::busqueda_mini_ups($idcat->idcategoria);
                    $categorias = Categoria::categorias();
                    $marcas = Marca::orderby('nombreMarca', 'asc')->get();
              
                    $idmar = "%";

                    $data = [
                        "productos" => $productos,
                        "productos2" => $productos2,
                        "productos3" => $productos3,
                        "productos4" => $productos4,
                        "categorias" => $categorias,
                  
                        "marcas" => $marcas,
                        "idcat" => $idcat,
                        "idmar" => $idmar,
                        "varios" => $varios,
                        "slug" => $slug
                    ];
                
                    return view('online.blog.protecion_energia', $data);
                }else{ */

                    $categorias = Categoria::categorias();


                    //$marcas = Marca::orderby('nombreMarca', 'desc')->get();

                    



                   // $categorias2 = Categoria::orderby('nombreCategoria', 'asc')->get();
                    $idmar = "%";
                    $idcat = "%";
                    $productos = Articulo::busqueda_categoria_slug($slug );
        
                    $data = [
                        "productos" => $productos,
                        "categorias" => $categorias,
                       // "categorias2" => $categorias2,
                       "datos_categoria"=>$datos_categoria,
                        "marcas" => $marcas,
                        "idcat" => $idcat,
                        "idmar" => $idmar,
                        "varios" => $varios,
                    ];
        
                    //dd($data); 
                    return view('online.index', $data);
                   
               /*  } */

            }else{  return Redirect::to('/');}
           
        } else {
         return view('online.show', $data);
        }
    }

    public function cart()
    {

        $categorias = Categoria::categorias();

        try {
            $cartCollection = Cart::session(auth('clients')->user()->idpersona)->getContent();
        } catch (\Throwable $th) {
            $cartCollection = Cart::getContent();
        }
        
        $marcas = Marca::get();
        $data = [
            "categorias" => $categorias,
            "cartCollection" => $cartCollection,
            "marcas" => $marcas,
        ];

        return view('online.cart', $data);
    }

    public function checkout()
    {
        $marcas = Marca::get();
        $departamentos = DB::table('depsv')->get();
        $categorias = Categoria::categorias();


        try {
            $cartCollection = Cart::session(auth('clients')->user()->idpersona)->getContent();

        } catch (\Throwable $th) {
            $cartCollection = Cart::getContent();
        } 


        $data = [
            "categorias" => $categorias,
            "cartCollection" => $cartCollection,
            "departamentos" => $departamentos,
            "marcas" => $marcas,

        ];
        return view('online.checkout', $data);
    }

    public function seguimiento(Request $request)
    {
        $id = $request->get('id');
        $mail = $request->get('email');

        if ($id != null) {
            /*PEDIDO SIN REGISTRO */
            $pedido = Pedido::join('munsv as mp', 'pidmunicipio', '=', 'mp.ID')
                ->join('depsv as dep', 'mp.DEPSV_ID', '=', 'dep.ID')
                ->join('estado as es', 'pedido.estado', '=', 'es.id')
                ->select('id_pedido', 'pnombre as nombre' , 'ptel as telefono', 'pdireccion as direccion', 
                'estado_nombre','MunName', 'DepName' , 'tipo_pago', 'monto_compra' , 'fecha')
                ->where('id_pedido', $id)
                ->where('pemail', $mail)
                ->first();

            
            
            if($pedido == null){
                $pedido = Pedido::join('persona as p', 'pedido.id_cliente', '=', 'p.idpersona')
                
                ->join('estado as es', 'pedido.estado', '=', 'es.id')
                ->join('munsv as mp', 'p.municipio', '=', 'mp.ID')
                ->join('depsv as dep', 'mp.DEPSV_ID', '=', 'dep.ID')
                ->select('id_pedido', 'nombre' , 'tel as telefono', 'direccion', 
                        'estado_nombre','MunName', 'DepName' , 'tipo_pago', 'monto_compra' , 'fecha')
                ->where('id_pedido', $id)
                ->where('p.email', $mail)
                ->first();

                //dd($pedido); 
            }

            if ($pedido != null) {
                $categorias = Categoria::categorias();
                $cartCollection = Cart::getContent();

                $data = [
                    "categorias" => $categorias,
                    "cartCollection" => $cartCollection,
                    "pedido" => $pedido,
                ];
                return view('online.seguimiento', $data);
            } else {
                $categorias = Categoria::categorias();
                $cartCollection = Cart::getContent();
                $mjs = "Pedido no encontrando, pruebe ingresar sus datos nuevamente,  ID y Correo con el que se registro su pedido ...";
                $data = [
                    "categorias" => $categorias,
                    "cartCollection" => $cartCollection,
                    "mjs" => $mjs,
                ];

                return view('online.seguimiento', $data);
            }
        } else {
            $categorias = Categoria::categorias();
            $cartCollection = Cart::getContent();
            $data = [
                "categorias" => $categorias,
                "cartCollection" => $cartCollection,
            ];

            return view('online.seguimiento', $data);
        }
    }

    //public function save(PedidoFormRequest $request)
    public function save(Request $request)
    {   //dd($request); 
        
        try {
            $userID = auth('clients')->user()->idpersona;
        } catch (\Throwable $th) {
            
        }
        $correo = [];

        if(isset($userID)){
            try {
                DB::beginTransaction();
                $pedido = new Pedido;
                $email = $request->get('email');
                $pedido->id_cliente = $request->get('id_cliente');
                $pedido->tipo_pago = $request->get('tipo_pago');
                $pedido->nume_transaccion = $request->get('nume_transaccion');
                $pedido->fecha_transaccion = date("Y-m-d", strtotime($request->get('fecha_transaccion')));
                $pedido->valor_transaccion = $request->get('valor_transaccion');
                $pedido->id_banco = $request->get('id_banco');
                $pedido->fecha = date("Y-m-d H:i");
                $pedido->notas = $request->get('notas');
                $pedido->notasint = $request->get('notasint');
                $pedido->estado = 1;
                $pedido->monto_compra = $request->get('total');
    
                $pedido->save();
    
                $cartCollection = Cart::session($userID)->getContent();
                foreach ($cartCollection as $item) {
                    $detalle = new DetallePedido();
                    $detalle->id_pedido = $pedido->id_pedido;
                    $detalle->cantidad_items = $item->quantity;
                    $detalle->precio = $item->price;
                    $detalle->id_articulo = $item->id;
                    $detalle->descuento = $item->attributes->desc;
                    $detalle->save();
                }
    
                Cart::session($userID)->clear();
                DB::commit();
    
                $correo[0] = "mirandasdm20@gmail.com";
                $correo[1] = "ernesto3d@gmail.com";
    
                $pedido = DB::table('pedido as p')
                    ->join('persona as pe', 'p.id_cliente', '=', 'pe.idpersona')
                    ->join('munsv as mp', 'pe.municipio', '=', 'mp.ID')
                    ->join('depsv as dep', 'mp.DEPSV_ID', '=', 'dep.ID')
                    ->where('id_pedido', $pedido->id_pedido)
                    ->first();
    
                $detalle = DetallePedido::join('articulo as a', 'id_articulo', '=', 'a.idarticulo')
                    ->join('categoria as cat', 'a.idcategoria', '=', 'cat.idcategoria')
                    ->join('modelo as mo', 'a.idModelo', '=', 'mo.idModelo')
                    ->join('marca as mar', 'mo.idMarca', '=', 'mar.idMarca')
                    ->where('id_pedido', $pedido->id_pedido)->get(['nombreMarca', 'nombreCategoria', 'nombreModelo', 'a.nombre', 'cantidad_items', 'precio', 'descuento', 'id_articulo']);
    
                Mail::to($email)
                    ->bcc($correo)
                    ->send(new NotificacionDePedido($pedido, $detalle));
    
                return Redirect::to('/')->with('success', "Se envio un e-mail al correo registrado con los datos de su pedido, Su numero de referencia es :  $pedido->id_pedido");
            } catch (Exception $ex) {
                DB::rollback();
            }
        }else{

           /*  try { */
                DB::beginTransaction();
                $pedido = new Pedido;
                $email = $request->get('email');
                $pedido->pnombre = $request->get('nombre');
                $pedido->pemail = $request->get('email');
                $pedido->ptel = $request->get('telefono');
                $pedido->pidmunicipio = $request->get('id_municipio');
                $pedido->pdireccion = $request->get('direccion');
                $pedido->tipo_pago = $request->get('tipo_pago');
                $pedido->nume_transaccion = $request->get('nume_transaccion');
                $pedido->fecha_transaccion = date("Y-m-d", strtotime($request->get('fecha_transaccion')));
                $pedido->valor_transaccion = $request->get('valor_transaccion');
                $pedido->id_banco = $request->get('id_banco');
                $pedido->fecha = date("Y-m-d H:i");
                $pedido->notas = $request->get('notas');
                $pedido->notasint = $request->get('notasint');
                $pedido->estado = 1;
                $pedido->monto_compra = $request->get('total');
    
                $pedido->save();
    
                $cartCollection = Cart::getContent();
                foreach ($cartCollection as $item) {
                    $detalle = new DetallePedido();
                    $detalle->id_pedido = $pedido->id_pedido;
                    $detalle->cantidad_items = $item->quantity;
                    $detalle->precio = $item->price;
                    $detalle->id_articulo = $item->id;
                    $detalle->descuento = $item->attributes->desc;
                    $detalle->save();
                }
    
                Cart::clear();
                DB::commit();
    
                $correo[0] = "mirandasdm20@gmail.com";
                $correo[1] = "ernesto3d@gmail.com";
    
                $pedido = DB::table('pedido as p')
                    ->join('munsv as mp', 'p.pidmunicipio', '=', 'mp.ID')
                    ->join('depsv as dep', 'mp.DEPSV_ID', '=', 'dep.ID')
                    ->where('id_pedido', $pedido->id_pedido)
                    ->first();
    
                $detalle = DetallePedido::join('articulo as a', 'id_articulo', '=', 'a.idarticulo')
                    ->join('categoria as cat', 'a.idcategoria', '=', 'cat.idcategoria')
                    ->join('modelo as mo', 'a.idModelo', '=', 'mo.idModelo')
                    ->join('marca as mar', 'mo.idMarca', '=', 'mar.idMarca')
                    ->where('id_pedido', $pedido->id_pedido)->get(['nombreMarca', 'nombreCategoria', 'nombreModelo', 'a.nombre', 'cantidad_items', 'precio', 'descuento', 'id_articulo']);
    
                Mail::to($email)
                    ->bcc($correo)
                    ->send(new NotificacionDePedidoMTECH($pedido, $detalle));
    
                return Redirect::to('/')->with('success', "Se envio un e-mail al correo registrado con los datos de su pedido, Su numero de referencia es :  $pedido->id_pedido");
            /* } catch (Exception $ex) {
                DB::rollback();
            }
 */
        }
       
        
    }

    public function municipio(Request $request)
    {
        // dd($request);
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('munsv')->where('DEPSV_ID', $query)->get();
            return $data;
        }
    }

    public function lista_municipios(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('munsv')->where('MunName', 'LIKE',  '%' . $query . '%')->get();
            //dd($data); 
            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {
                    $output .= '
           <li><a href="#"> ' . $row->ID . '      ' . $row->MunName . '</a></li>
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

    public function politicas()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $confonline = DB::table('configuracion')->first();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
            "confonline" => $confonline
        ];
       
        return view('online.politicas', $data);
    }

    public function envios()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $confonline = DB::table('configuracion')->first();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
            "confonline" => $confonline
        ];
        return view('online.envios', $data);
    }

    public function contactanos()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.contactanos', $data);
    }

    public function mjs_save(Request $request)
    {
        try {
            DB::beginTransaction();
            $mensaje = new Mensaje;
            $mensaje->mjs = $request->get('message');
            $mensaje->nombre = $request->get('name');
            $mensaje->email = $request->get('email');
            $mensaje->telefono = $request->get('number');
            $mensaje->asunto = $request->get('subject');
            $mensaje->suscrito = ($request->get('check') != null ? 1 : 0);
            $mensaje->save();
            DB::commit();
            return Redirect::to('/')->with('success', "Su mensaje fue enviado correctatamente !!!");
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public function facturacion()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.facturacion', $data);
    }

    public function tienda()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.tienda', $data);
    }

    public function ingresar()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.ingresar', $data);
    }

    public function arrendamiento()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.arrendamiento', $data);
    }

    public function registrarse()
    {
        $categorias = Categoria::categorias();
        $departamentos = DB::table('depsv')->get();

        $data = [
            "departamentos" => $departamentos,
            "categorias" => $categorias
        ];

        return view('online.registro', $data);
    }

    public function historial(Request $request)
    {
        if (isset(auth('clients')->user()->idpersona)) {
            $userID = auth('clients')->user()->idpersona;
            $id = $request->get('id') * 1;
            if ($id == $userID) {


                $compras = DB::table('venta as v')
                    ->join('detalle_venta  as dv', 'v.idventa', '=', 'dv.idventa')
                    ->select('num_comprobante', 'fecha_hora', 'total_venta', DB::raw('SUM(puntos) as puntos'))
                    ->where('idcliente', $id)
                    ->groupby('num_comprobante')
                    ->get();



                $categorias = Categoria::categorias();
                $data = [
                    "categorias" => $categorias,
                    "compras" => $compras
                ];
                return view('online.historico', $data);
            } else {

                $categorias = Categoria::categorias();
                $data = [
                    "categorias" => $categorias,
                ];
                return Redirect::to('./');
            }
        } else {
            $categorias = Categoria::categorias();
            $data = [
                "categorias" => $categorias,
            ];
            return Redirect::to('./');
        }
    }

    public function sol_reg(PersonaFormRequest $request)
    {
        $suscribete = $request->get('suscribete');
        $data['confirmation_code'] = str_random(25);
        $persona = new Persona;
        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->get('nombre');
        $persona->direccion = $request->get('direccion');
        $persona->giro = $request->get('giro');
        $persona->nit = $request->get('nit');
        $persona->iva = $request->get('iva');
        $persona->municipio = $request->get('id_municipio');
        $persona->contacto = $request->get('contacto');
        $persona->tel = $request->get('tel');
        $email = $request->get('email');
        $persona->email = $email;
        $persona->password = Hash::make($request->get('password'));
        $persona->confirmation_code = str_random(40);
        $persona->confirmed = 0;
        $persona->estado = 'Pendiente';
        if ($suscribete != null) {
            $persona->suscribete = 1;
        }

        $persona->save();

        Mail::to($email)
            //->subject('Verify Email Address Rquimica')
            //->bcc($correo)
            ->send(new NotificacionDeValidacionMMSOFT($persona));

        return Redirect::to('./')->with('success', 'Sus datos fueron registrados correctamente, se envio un correo a la direccion de email proporcionada para que pueda validar su cuenta!!!');
    }


    public function marcas()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.marcas', $data);
    }
    
    public function servicios()
    {
        $marcas = Marca::get();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            "marcas" => $marcas,
        ];
        return view('online.servicios', $data);
    }


    public function articulos_header(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $idtienda = 1; 
            $data = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                ->join('tienda as t', 'st.idTienda', '=', 't.id')
                ->select('a.idarticulo', 'a.codigo', 'a.nombre', 'st.stock', 'm.nombreMarca', 'md.nombreModelo',
                    'a.imagen1', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.costoProducto','a.slug', 'a.descuento_art', 'a.puntos')
                ->where('st.idTienda', $idtienda)
                //->where('st.stock' ,'>', 0)
                ->where(function ($query2)  {
                    $query2->orwhere('stock',  '>',  0);   
                    $query2->orwhere('cdc',   1);                  
                })
                ->where('a.publicado' , 1)
                ->where(function ($query2) use ($query) {
                    $query2->orwhere('md.nombreModelo', 'LIKE', "%{$query}%");
                    $query2->orwhere('m.nombreMarca', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codigo', $query);
                    $query2->orwhere('a.nombre', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.etiqueta', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codbar', $query);
                })
                ->take(30)
                ->get();

            if (!$data->isEmpty()) {
                $output = '';
                    foreach ($data as $row) {
                        $output .= '<tr  style ="background-color: rgba(0,0,0,0.8);"><td><a  style="color: white;" href="./' . $row->slug . '"><br/> ' . $row->idarticulo . '           ' . $row->nombre
                        . '      ' . $row->nombreModelo . '      ' . $row->nombreMarca . ' </a> </td>  <td> <a  style="color: white;" href="./' . $row->slug . '">  <img src="./../imagenes/articulos/'.$row->imagen1.'" height = "50">  ' . '</a></td></tr>';
                    }
                   
               
                echo $output;
            } else {
                echo $output = '<a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
            }
        }
    }
}
/*258*/
