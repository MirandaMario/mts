<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Miscelanea;

class BusquedaAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function persona(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('persona')
                ->where('nombre', 'LIKE', "%{$query}%")
                ->where('tipo_persona', '=', 'Cliente')
                ->orwhere('tipo_persona', '=', 'Ambos')
                ->take(10)
                ->get();

                if (!$data->isEmpty()) {   
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            foreach ($data as $row) {
                $output .= '
       <li><a href="#"> ' . $row->idpersona . '      ' . $row->nombre . '</a></li>
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

    public function articulo_codigo(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $idtienda = $request->get('idtienda');
            $row = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                ->join('tienda as t', 'st.idTienda', '=', 't.id')
                ->select('a.idarticulo', 'a.codigo', 'a.nombre', 'st.stock', 'm.nombreMarca', 'md.nombreModelo',
                    'a.imagen1', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.costoProducto', 'a.descuento_art')
                ->where('st.idTienda', $idtienda)
                ->where(function ($query2) use ($query) {
                    $query2->orwhere('a.codigo', $query);
                    $query2->orwhere('a.codbar', $query);
                })
                ->first();

            if ($row != "") {


                $output  = $row->idarticulo . '      ' . $row->codigo . '      ' . $row->stock . '      ' . $row->nombre
                . '      ' . $row->nombreModelo . '      ' . $row->nombreMarca . '      ' . $row->imagen1 . '      ' . $row->impuesto
                . '      ' . $row->impuestodos . '      ' . $row->porcentaje . '      ' . $row->costoProducto . '      ' . $row->descuento_art ;

                echo $output;

            } else {

                echo $output = 'NO HAY CONINCIDENCIAS REGISTRADAS';
            }
        }
    }

    public function articulos(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $idtienda = $request->get('idtienda');
            $data = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                ->join('tienda as t', 'st.idTienda', '=', 't.id')
                ->select('a.idarticulo', 'a.codigo', 'a.nombre', 'st.stock', 'm.nombreMarca', 'md.nombreModelo',
                    'a.imagen1', 'a.imagen5', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.porcentaje2', 'a.porcentaje3', 'a.costoProducto', 'a.descuento_art', 'a.puntos', 'a.idioma', 'a.tamano', 'a.color')
                ->where('st.idTienda', $idtienda)
                ->where(function ($query2) use ($query) {
                    $query2->orwhere('md.nombreModelo', 'LIKE', "%{$query}%");
                    $query2->orwhere('m.nombreMarca', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codigo', $query);
                    $query2->orwhere('a.nombre', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.etiqueta', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codbar', $query);
                })
                ->orderby('st.stock' , 'desc')
                ->take(30)
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute; overflow-y: scroll; height: 400px;">';
                foreach ($data as $row) {
                    $nombre  = ""; 
                    $imagen  = ""; 
                    $var =  strlen($row->nombre); 
                    if( $var >= 20) {
                        $nombre =  substr($row->nombre, 0, 20)  ; 
                    }else{
                        $nombre = $row->nombre; 
                    }

                    if($row->imagen5 != null){
                        $imagen = $row->imagen5; 
                    }elseif($row->imagen1 != null)
                    {
                        $imagen = $row->imagen1; 
                    }else{
                        $imagen = 'ni.png'; 
                    }

                    $output .= '<li><a href="#"><spam style="display:none">' . $row->idarticulo . '      ' . $row->codigo . '</spam>      <spam style="color:red">' . $row->stock . '</spam>      ' . $nombre 
                    .' '. $row->color .' '.$row->tamano  .' '. $row->idioma. '      <spam style="color:blue">' . $row->nombreModelo . '</spam>       ' . $row->nombreMarca 
                    . '      <spam style="display:none">' . ($row->imagen5 != null ? $row->imagen5 : $row->imagen1) . '      ' . $row->impuesto
                    . '      ' . $row->impuestodos . '      ' . $row->porcentaje . '      ' . $row->costoProducto . '      ' . $row->descuento_art . '      ' . $row->puntos 
                    . '      ' . $row->porcentaje2 . '      ' . $row->porcentaje3 
                    . '</spam> <img src="'. url('imagenes/articulos/'.($row->imagen5 != null ? $row->imagen5 : $row->imagen1)) .'" height = "50"></a></li>';
                }
                $output .= '</ul>';
                echo $output;
            } else {
                echo $output = '<a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS</a>';
            }
        }
    }

    public function articulos_index(Request $request)
    {
        $varios = Miscelanea::first();
        if ($request->get('query')) {
            $query = $request->get('query');
            $idtienda = $request->get('idtienda');
            $data = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                ->join('tienda as t', 'st.idTienda', '=', 't.id')
                ->select('a.idarticulo', 'a.codigo', 'a.nombre',  'm.nombreMarca', 'md.nombreModelo',
                    'a.imagen1',  'a.imagen5', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.porcentaje2','a.porcentaje3','a.costoProducto', 'a.color' , 'a.descuento_art', 'a.puntos', DB::raw('SUM(stock) as stock'))
                //->where('st.idTienda', $idtienda)
                ->where(function ($query2) use ($query) {
                    $query2->orwhere('md.nombreModelo', 'LIKE', "%{$query}%");
                    $query2->orwhere('m.nombreMarca', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codigo', $query);
                    $query2->orwhere('a.nombre', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.etiqueta', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codbar', $query);
                })
                ->groupby('a.codigo')
                ->orderby('st.stock' , 'desc')
                ->take(30)
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute;  overflow-y: scroll; height: 400px;">';
                foreach ($data as $row) {

                    $nombre  = ""; 
                    $imagen  = ""; 
                    $var =  strlen($row->nombre); 
                    if( $var >= 20) {
                        $nombre =  strtoupper(substr($row->nombre, 0, 20))  ; 
                    }else{
                        $nombre = strtoupper($row->nombre); 
                    }

                    if($row->imagen5 != null){
                        $imagen = $row->imagen5; 
                    }elseif($row->imagen1 != null)
                    {
                        $imagen = $row->imagen1; 
                    }else{
                        $imagen = 'ni.png'; 
                    }

                    $precio = precio($row , $varios); 
                    $output .= '<li style = "font-size: 110%;" ><a href="#" style = "font-size: 110%; "> ' .$row->codigo .'      ' .$nombre .' ' .$row->color 
                    .'      <spam style="color:blue">' . $row->nombreModelo . '</spam>        ' . $row->nombreMarca . '     <spam style="color:red">' . $row->stock 
                    .  '</spam>    ' . number_format($precio[0], 2) . '    <spam style="color:red"> ' .number_format( $precio[1], 2) 
                    . '</spam> <img src="'. url('imagenes/articulos/'.$imagen) .'" height = "50"> </a></li></hr>';
                }
                $output .= '</ul>'; 
                echo $output;
            } else {
                echo $output = '<ul class="dropdown-menu" style="display:block; position:absolute;  overflow-y: scroll; height: 60px;"><li><a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS </a></li></ul>';
            }
        }
    }

    public function articulos_palabra(Request $request)
    {  // dd($request); 
        if ($request->get('query')) {
            $query = $request->get('query');
            $idtienda = $request->get('idtienda');
            $data = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->select('a.codigo as palabra', 'a.nombre as palabra', 'md.nombreModelo as palabra')
                ->where(function ($query2) use ($query) {
                    $query2->orwhere('md.nombreModelo', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.nombre', 'LIKE', "%{$query}%");
                    $query2->orwhere('a.codigo', $query);
                    $query2->orwhere('a.codbar', $query);
                    
                })
                ->take(30)
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute;">';
                foreach ($data as $row) {

                    $output .= '<li><a href="#">'. $row->palabra . '</a></li>';
                }
                $output .= '</ul>';
                echo $output;
            } else {
                echo $output = '<a href="#"  style="color: white; position:absolute; background-color: black;">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
            }
        }
    }


    public function articulos_compras(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('articulo as a')
                ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                ->select('a.idarticulo', 'a.codigo', 'a.nombre',  'm.nombreMarca', 'md.nombreModelo',
                     'a.impuesto', 'a.impuestodos', 'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto', 'a.descuento_art', 'a.imagen1', 'a.imagen5', 'a.idioma', 'a.tamano', 'a.color')
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
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {

                    $output .= '<li><a href="#">' . $row->idarticulo . '      ' . $row->codigo . '      ' . $row->nombre .' '. $row->color .' '.$row->tamano  .' <img src="./../../imagenes/articulos/'.($row->imagen5 != null ? $row->imagen5 : $row->imagen1).'" height = "50">'. $row->idioma
                    . '      ' . $row->nombreModelo . '      ' . $row->nombreMarca . '      ' . $row->impuesto
                    . '      ' . $row->impuestodos . '      ' . $row->porcentaje . '      ' . $row->costoProducto . '      ' . $row->descuento_art . '      '.($row->imagen5 != null ? $row->imagen5 : $row->imagen1) .'</a></li>';
                }
                $output .= '</ul>';
                echo $output;
            } else {
                echo $output = '<a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
            }
        }
    }

    public function empresa(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('persona')
                ->where('nombre', 'LIKE', "%{$query}%")
                ->where('tipo_persona', '=', 'Cliente')
                ->orwhere('tipo_persona', '=', 'Ambos')
                ->take(10)
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {
                    $output .= '
       <li><a href="#"> ' . $row->idpersona . '      ' . $row->nombre . '  ' . $row->iva . '  ' . $row->nit . '  ' . $row->giro . '  ' . $row->direccion . ' </a></li>
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


    function proveedor_ajax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('persona')

                ->where('tipo_persona', '=', 'Proveedor')
                //->orwhere('tipo_persona','=','Ambos')

                ->where('nombre', 'LIKE', "%{$query}%")
                ->orwhere('iva', 'LIKE', "%{$query}%")



                //->orwhere('tipo_persona','=','Ambos')
                ->take(10)
                ->get();
            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {
                    $output .= '
       <li><a href="#">' . $row->idpersona . '      ' . $row->nombre . ' </a></li>
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



}
