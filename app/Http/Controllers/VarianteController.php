<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Http\Requests\ArticuloEditFormRequest;
use App\Http\Requests\ArticuloFormRequest;
use App\Miscelanea;
use App\Stocktienda;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Picqer;
use Validator;

class VarianteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function variante(Request $request)
    { 
        $articulo = Articulo::articulo($request->get('id'));
        $varios = Miscelanea::first();
        $datostienda = StockTienda::stock_articulo_tienda($request->get('id'));
        $categorias = DB::table('categoria')->where('condicion', '=', 'Activo')->get();
        $marcas = DB::table('marca')->get(); 


        $variantes = Articulo::variantes($articulo->idarticulo);

       // dd($variantes); 

        $data = [
            "articulo" => $articulo, 
            "varios" => $varios, 
            "datostienda" => $datostienda, 
            "categorias" => $categorias,
            "marcas" => $marcas,
            "variantes" => $variantes
        ];
        return view('almacen.articulo.variante', $data);
    }


    public function create_variante(Request $request)
    { 
        $a_o = Articulo::articulo($request->get('idarticulo'));
        $idarticulo  = $request->get('codigo'); 
        $color       = $request->get('color'); 
        $tamano      = $request->get('tamano'); 
        $idioma      = $request->get('idioma'); 
        $codbar      = $request->get('codbar'); 
        

        $c = count($idarticulo); 
        //dd($c, $idarticulo , $color , $tamano , $codbar); 


        for ($i = 0; $i < $c; $i++){       

            try {
                DB::beginTransaction();
                $articulo = new Articulo;
                $articulo->idcategoria  = $a_o->idcategoria;
                $articulo->idModelo     = $a_o->idModelo;

                $codigo = $idarticulo[$i];

                $slug = Str::slug($a_o->slug.'-'.$tamano[$i].'-'.$color[$i].'-'.$idioma[$i], '-');

                $ver_cod = DB::table('articulo')
                ->where('codigo', $codigo)
                ->orwhere('slug', $slug)
                ->first();

                
                if ($ver_cod != null) {
                    return Redirect::to('articulo')->with('error', 'Error se esta intentando guardar un codigo o slug ya registrado!');
                }

                $articulo->codigo       = $idarticulo[$i];
                $articulo->tamano       = $tamano[$i];
                $articulo->color        = $color [$i];
                $articulo->idioma       = $idioma[$i];
                $articulo->codbar       = $codbar[$i];

                $articulo->nombre       = $request->get('nombre');
                
                $articulo->slug = $slug;
                

                $articulo->descripcion   = $a_o->descripcion;
                $articulo->detalles      = $a_o->detalles;
                $articulo->estado        = 'Activo';
                $articulo->impuesto      = $a_o->impuesto;
                $articulo->impuestodos   = $a_o->impuestodos;
                $articulo->porcentaje    = $a_o->porcentaje;
                $articulo->costoProducto = $a_o->costoProducto;
                $articulo->descuento_art = $a_o->descuento_art;
              //  $articulo->imagen1        = $a_o->imagen1;
                $articulo->variantede    = $a_o->idarticulo;

        
                $articulo->publicado       = $a_o->publicado;
                $articulo->ver_precio      = $a_o->ver_precio;

                
           
                $articulo->save();

                $cont = 1;
                while ($cont < 11) {
                    $stocktienda = new Stocktienda();

                    $stocktienda->idTienda = $cont;
                    $stocktienda->idArticulo = $articulo->idarticulo;
                    $stocktienda->stock = 0;
                    $stocktienda->min = 2;
                    $stocktienda->max = 10;
                    $stocktienda->estadost = 1;
                    $stocktienda->save();
                    $cont++;
                }

                DB::commit();
            } catch (Exception $ex) {
                DB::rollback();
                return Redirect::to('articulo')->with('error', 'Error!');
            }

        }
        return Redirect::to('articulo')->with('success', 'Variantes registradas satisfactoriamente !');
    }
}
/*572 */