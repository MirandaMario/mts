<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = "articulo";
    protected $primaryKey = "idarticulo";
    public $timestamps = true;
    protected $fillable = [
        'idcategoria',
        'idModelo',
        'codigo',
        'slug', 
        'nombre',
        'descripcion',
        'imagen1',
        'imagen2',
        'imagen3',
        'imagen4',
        'imagen5',
        'estado',
        'costoProducto',
        'porcentaje',
        'porcentaje2',
        'porcentaje3',
        'impuesto',
        'impuestodos',
        'publicado',
        'ver_precio',
        'detalles',
        'descuento_art',
        'urivideo', 
        'hoja_tecnica', 
        'codbar', 
        'premio', 
        'puntos', 
        'etiqueta', 
        'destacado', 
        'des_sf',
        'color', 
        'tamano',
        'variantede', 
        'idioma', 
        'tipo', 
        'cdc'
    ];
    protected $guarded = [

    ];

    protected function articulo($id)
    {
        $articulo = DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->where('a.idarticulo', '=', $id)
            ->first();

        return $articulo;
    }

    protected function articulos_consolidados($cantidad)
    {
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('a.idarticulo', 'a.tipo' ,   'a.cdc' ,  'a.nombre', 'a.codigo', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.porcentaje2', 'a.porcentaje3', 'a.costoProducto', 'a.imagen1', 'a.imagen5',  'a.estado', 'a.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'a.publicado', DB::raw('SUM(stock) as stock'), 'a.tamano', 'a.color', 'a.idioma', 'a.codbar', 'a.variantede')
            ->where('t.estado', 1)
            ->groupby('a.codigo')
            ->orderBy('a.idarticulo', 'desc')
            ->take($cantidad)
            ->get();
        //dd($articulos); 
        return $articulos;
    }


    protected function variantes($variantede)
    {
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('a.idarticulo',  'a.cdc' ,  'a.nombre', 'a.codigo', 'a.impuesto', 'a.impuestodos', 'a.porcentaje',  'a.porcentaje2', 'a.porcentaje3', 'a.costoProducto', 'a.imagen1', 'a.imagen5', 'a.estado', 'a.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'a.publicado', DB::raw('SUM(stock) as stock'), 'a.variantede', 'a.color', 'a.tamano', 'a.idioma', 'a.codbar', 'a.variantede')
            ->where('t.estado', 1)
            ->where('a.variantede', $variantede)
            ->groupby('a.codigo')
            ->orderBy('a.idarticulo', 'desc')
            //->take($cantidad)
            ->get();

        return $articulos;
    }

    protected function articulos_tienda($tienda)
    {
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('a.idarticulo','a.tipo' ,   'a.cdc' ,  'a.nombre', 'a.codigo', 'st.stock', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.porcentaje2', 'a.porcentaje3', 'md.nombreModelo', 'a.costoProducto', 'a.descuento_art', 'c.nombreCategoria',
                'a.descripcion', 'a.imagen1', 'a.imagen5', 'a.estado', 'st.min', 'st.max', 'm.nombreMarca', 't.id', 'a.publicado', 'a.color', 'a.tamano', 'a.idioma', 'a.variantede')
            ->where('st.idTienda', $tienda)
            ->orderBy('a.idarticulo', 'desc')
            ->take(17)
            ->get();

        return $articulos;
    }

    protected function articulos_consolidados_busqueda($palabra, $marca, $categoria)
    {
//dd($palabra, $marca, $categoria);
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->select('a.idarticulo','a.tipo' , 'a.cdc' ,  'a.nombre', 'a.codigo', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.porcentaje2', 'a.porcentaje3', 'a.costoProducto', 'a.imagen1', 'a.imagen5', 'a.estado', 'a.descuento_art', 'a.publicado',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(stock) as stock'), 'a.color', 'a.tamano', 'a.idioma', 'a.variantede')
            ->where(function ($query2) use ($palabra) {
                $query2->orwhere('a.nombre', 'LIKE', '%' . $palabra . '%');
                $query2->orwhere('a.codigo', 'LIKE', '%' . $palabra . '%');
                $query2->orwhere('a.codbar', 'LIKE', '%' . $palabra . '%');
                $query2->orwhere('md.nombreModelo', 'LIKE', '%' . $palabra . '%');
            })
            ->where('m.nombreMarca', 'Like', $marca . '%')
            ->where('c.nombreCategoria', 'LIKE', '%' . $categoria . '%')
            ->groupby('a.codigo')
            ->orderBy('a.idarticulo', 'desc')
            ->take(250)
            ->get();
/*
$primero = $articulos->first();
dd($primero);
$primero->idarticulo != null ?: $articulos = []; */

        return $articulos;
    }

    protected function articulos_busqueda_tienda($palabra, $marca, $categoria, $tienda)
    {
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('a.idarticulo', 'a.tipo' ,  'a.cdc' ,  'a.nombre', 'a.codigo', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.porcentaje2', 'a.porcentaje3', 'a.costoProducto', 'a.descripcion', 'a.imagen1', 'a.imagen5', 'a.estado', 'a.descuento_art', 'a.publicado',
                'st.min', 'st.max', 'm.nombreMarca', 't.nombreTienda', 'md.nombreModelo', 'c.nombreCategoria', 't.id', 'stock', 'a.color', 'a.tamano', 'a.idioma', 'a.variantede')
            ->where(function ($query2) use ($palabra) {
                $query2->orwhere('a.nombre', 'LIKE', '%' . $palabra . '%');
                $query2->orwhere('a.codigo', 'LIKE', '%' . $palabra . '%');
                $query2->orwhere('md.nombreModelo', 'LIKE', '%' . $palabra . '%');
            })
            ->where('m.nombreMarca', 'Like', $marca . '%')
            ->where('c.nombreCategoria', 'LIKE', $categoria . '%')
            ->where('st.idTienda', $tienda)

            ->orderBy('a.idarticulo', 'desc')
            ->take(250)
            ->get();

        return $articulos;
    }

/*APARTADO TIENDA */
    protected function busqueda_marca_categoria($idcat, $idmar)
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.tipo' , 'articulo.cdc' ,'articulo.nombre', 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3','articulo.costoProducto', 'articulo.imagen1',  'articulo.imagen5',  'articulo.estado', 'articulo.descuento_art','articulo.slug',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
                ->where(function ($query2)  {
                    $query2->orwhere('stock',  '>',  0);   
                    $query2->orwhere('cdc',   1);                  
                })
            ->where('c.idCategoria', $idcat)
            ->where('m.idMarca', $idmar)
            ->where('articulo.publicado', 1)
            ->groupby('articulo.codigo')
            ->paginate(16);

        return $productos;
    }

    protected function busqueda_marca($idmar)
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.tipo' , 'articulo.cdc' , 'articulo.nombre', 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos', 'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5',  'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
           // ->where('stock', '>',  0)
           ->where(function ($query2)  {
            $query2->orwhere('stock',  '>',  0);   
            $query2->orwhere('cdc',   1);                  
        })
            ->where('m.idMarca', $idmar)
            ->where('articulo.publicado', 1)
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);

        return $productos;
    }

    protected function busqueda_categoria($idcat)
    {//dd($idcat) ; 
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo',  'articulo.tipo' , 'articulo.cdc' , 'articulo.nombre', 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',  'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
           // ->where('stock', '>',  0)
           ->where(function ($query2)  {
            $query2->orwhere('stock',  '>',  0);   
            $query2->orwhere('cdc',   1);                  
        })
            ->where('c.idCategoria', $idcat)
            ->where('articulo.publicado', 1)
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);
      //  dd($productos); 
        return $productos;
    }

    protected function busqueda_categoria_slug($slug)
    {//dd($slug); 
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.cdc' , 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',  'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
           // ->where('stock', '>',  0)
            ->where(function ($query2)  {
                $query2->orwhere('stock',  '>',  0);   
                $query2->orwhere('cdc',   1);                  
            })

            ->where('c.cslug', $slug)
            ->where('articulo.publicado', 1)
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);
      //  dd($productos); 
        return $productos;
    }


    protected function busqueda_palabra($idcat)
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.cdc' , 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',  'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            //->where('stock', '>',  0)
            ->where(function ($query2)  {
                $query2->orwhere('stock',  '>',  0);   
                $query2->orwhere('cdc',   1);                  
            })
            ->where('c.idCategoria', $idcat)
            ->where('articulo.publicado', 1)
            ->where(function ($query2)  {
                $query2->orwhere('articulo.etiqueta', 'LIKE', '%regleta%');   
               $query2->orwhere('articulo.nombre', 'LIKE',  'toma%');                  
            })
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);
        //dd($productos); 
        return $productos;
    }

    protected function busqueda_reguladores($idcat)
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',  'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3',  'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            ->where('stock', '>',  0)
            ->where('c.idCategoria', $idcat)
            ->where('articulo.publicado', 1)
            ->where(function ($query2)  {
                $query2->orwhere('articulo.nombre', 'LIKE', '%regulador%');   
              // $query2->orwhere('articulo.nombre', 'LIKE',  'toma%');                  
            })
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);
        //dd($productos); 
        return $productos;
    }

    protected function busqueda_ups($idcat)
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',  'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3',  'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            //->where('stock', '>',  0)
            ->where(function ($query2)  {
                $query2->orwhere('stock',  '>',  0);   
                $query2->orwhere('cdc',   1);                  
            })
            ->where('c.idCategoria', $idcat)
            ->where('articulo.publicado', 1)
            ->where(function ($query2)  {
                $query2->orwhere('articulo.nombre', 'LIKE', 'ups%');   
              // $query2->orwhere('articulo.nombre', 'LIKE',  'toma%');                  
            })
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);
        //dd($productos); 
        return $productos;
    }

    protected function busqueda_mini_ups($idcat)
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos',  'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3',  'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            //->where('stock', '>',  0)
            ->where(function ($query2)  {
                $query2->orwhere('stock',  '>',  0);   
                $query2->orwhere('cdc',   1);                  
            })
            ->where('c.idCategoria', $idcat)
            ->where('articulo.publicado', 1)
            ->where(function ($query2)  {
                $query2->orwhere('articulo.nombre', 'LIKE', 'mini%');   
              // $query2->orwhere('articulo.nombre', 'LIKE',  'toma%');                  
            })
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);
        //dd($productos); 
        return $productos;
    }

    protected function busqueda()
    {
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.cdc' ,  'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos', 'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3', 'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
                ->where(function ($query2)  {
                    $query2->orwhere('stock',  '>',  0);   
                    $query2->orwhere('cdc',   1);                  
                })
            ->where('articulo.publicado', 1)
            ->orderby('articulo.costoProducto', 'asc')
            ->groupby('articulo.codigo')
            ->paginate(16);

        return $productos;
    }
    protected function busquedastr($str)
    {
       // dd($str); 
        $productos = Articulo::join('modelo as md', 'articulo.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('categoria as c', 'articulo.idCategoria', '=', 'c.idCategoria')
            ->join('stocktienda as st', 'articulo.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('articulo.idarticulo', 'articulo.nombre', 'articulo.cdc' , 'articulo.codigo', 'articulo.impuesto', 'articulo.impuestodos', 'articulo.slug',
                'articulo.porcentaje', 'articulo.porcentaje2',  'articulo.porcentaje3',  'articulo.costoProducto', 'articulo.imagen1', 'articulo.imagen5', 'articulo.estado', 'articulo.descuento_art',
                'st.min', 'st.max', 'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', 'articulo.publicado', DB::raw('SUM(stock) as stock'))
            //->where('stock', '>',  0)
            ->where(function ($query2)  {
                $query2->orwhere('stock',  '>',  0);   
                $query2->orwhere('cdc',   1);                  
            })
            ->where('articulo.publicado', 1)
            ->where(function ($query2) use ($str) {
                $query2->orwhere('md.nombreModelo', 'LIKE', "%{$str}%");
                $query2->orwhere('articulo.nombre', 'LIKE', "%{$str}%");
                $query2->orwhere('m.nombreMarca', 'LIKE', "%{$str}%");
                $query2->orwhere('articulo.etiqueta', 'LIKE', "%{$str}%");
               // $query2->orwhere('a.codigo', $query);
                
            })
            ->groupby('articulo.codigo')
            ->paginate(16);

        return $productos;
    }
}
/*127 antes de los scope */
