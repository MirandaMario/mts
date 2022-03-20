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
use Image;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $idt = auth()->user()->id_tienda;
        $busqueda = trim($request->get('buscar'));
        $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
        $marcas = DB::table('marca')->orderBy('nombreMarca')->get();
        $varios = Miscelanea::first();
        $rol = auth()->user()->rol;
        if ($busqueda == null) {
            /*INDEX */

            if ($rol == 1) {
                $articulos = Articulo::articulos_consolidados(10);
            } else {
                $articulos = Articulo::articulos_tienda($idt);
            }

            $data = ["articulos" => $articulos,
                "marcas" => $marcas,
                "categorias" => $categorias,
                "varios" => $varios];

            return view('almacen.articulo.index', $data);
            /*INDEX POR BUSQUEDA */
        } else {
            $palabra = $request->get('texto');
          //  dd($palabra); 
            $categoria = $request->get('idCategoria');
            $marca = $request->get('idMarca');
            $palabra == null ? $palabra = "%" : $palabra;

            if ($rol == 1) {
                $articulos = Articulo::articulos_consolidados_busqueda($palabra, $marca, $categoria);
            } else {
                $articulos = Articulo::articulos_busqueda_tienda($palabra, $marca, $categoria, $idt);
            }

            $data = [
                "articulos" => $articulos,
                "marcas" => $marcas,
                "categorias" => $categorias,
                "varios" => $varios,
            ];

            return view('almacen.articulo.index', $data);
        }
    }

    public function create()
    {
        $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
        $marcas = DB::table('marca')->orderBy('nombreMarca')->get();

        $articulos = Articulo::articulos_consolidados(10);
       // $porcentajes = DB::table('porcentaje')->get();
        $varios = Miscelanea::first();

        $data = [
            "articulos" => $articulos,
            "categorias" => $categorias,
            "marcas" => $marcas,
            //"porcentajes" => $porcentajes,
            "varios" => $varios,
        ];

        return view('almacen.articulo.create', $data);

    }

    public function show(Request $request, $id)
    { //dd($id);   ESTADISTICA ARTICULO
        $varios = Miscelanea::first();
        $idtienda = $request->get('id2');
        /** CABECERA **/
        $articulo = DB::table('articulo as a')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
            ->join('tienda as t', 'st.idTienda', '=', 't.id')
            ->select('a.idarticulo', 'a.codigo', 'a.nombre', 'a.estado', 'md.nombreModelo', 'm.nombreMarca', 'st.stock', 'nombreTienda',  'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3',
            'impuesto', 'impuestodos', 'descuento_art',  'costoProducto')
        //  ->where('st.idTienda', $idtienda)
            ->where('a.idarticulo', '=', $id)
            ->first();
        //  dd($articulo);
        /**COMPRAS**/
        $detalles = DB::table('detalle_ingreso as d')
            ->join('ingreso as i', 'd.idingreso', '=', 'i.idingreso')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->select('i.idingreso as ingreso', 'i.documento', 'cantidad', 'precio_compra', 'tipo_comprobante', 'serie_comprobante', 'num_comprobante', 'nombre', DB::raw('DATE_FORMAT(i.fecha_hora ,"%d/%m/%Y") as fecha_hora'), DB::raw('DATE_FORMAT(fecha_ven ,"%d/%m/%Y") as fecha_ven') ,  DB::raw('DATE_FORMAT(fecha_fac ,"%d/%m/%Y") as fecha_fac') ,  'lote')
            ->where('d.idarticulo', '=', $id)
            ->get();

        $total = DB::table('detalle_ingreso as d')
            ->select(DB::raw('sum(d.cantidad*d.precio_compra) as total'))
            ->where('d.idarticulo', '=', $id)
            ->first();

        /**VENTAS**/

        $detallesv = DB::table('detalle_venta as dv')
            ->join('venta as v', 'dv.idventa', '=', 'v.idventa')
            ->join('persona as pv', 'v.idcliente', '=', 'pv.idpersona')
            ->select('v.idventa as venta', 'dv.cantidad as cantidadv', 'dv.precio_venta as preciov', 'v.tipo_comprobante as tipov', 'v.descuento', 'v.serie_comprobante as seriev', 'v.num_comprobante as numv', 'pv.nombre as nombrev', DB::raw('DATE_FORMAT(v.fecha_hora ,"%d/%m/%Y") as fecha_horav'))
            ->where('dv.idarticulo', '=', $id)
            ->get();

        $totalv = DB::table('detalle_venta as dvt')
            ->select(DB::raw('sum(dvt.cantidad*dvt.precio_venta) as totalv'))
            ->where('dvt.idarticulo', '=', $id)
            ->first();

        $data = [
            "totalv" => $totalv,
            "detallesv" => $detallesv,
            "total" => $total,
            "articulo" => $articulo,
            "detalles" => $detalles,
            "varios" => $varios
        ];
        return view('almacen.articulo.show', $data);
    }

    public function show3($id)
    {
        $varios = Miscelanea::first();
        $articulo = Articulo::articulo($id);
        $datostienda = StockTienda::stock_articulo_tienda($id);

        $barcode_generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        $barcode = $barcode_generator->getBarcode($articulo->codigo, $barcode_generator::TYPE_CODE_128);

        return view('almacen.articulo.show3', [
            'articulo' => $articulo,
            'barcode' => $barcode,
            "datostienda" => $datostienda,
            "varios" => $varios,
        ]);

    }

    public function edit($id)
    {
        $articulo = Articulo::articulo($id);
        $categorias = DB::table('categoria')->where('condicion', '=', 'Activo')->get();
        $marcas = DB::table('marca')->get();
       // $porcentajes = DB::table('porcentaje')->get();
        $varios = Miscelanea::first();
        $datostienda = StockTienda::stock_articulo_tienda($id);
        //dd($articulo);
        $data = [
            "articulo" => $articulo,
            "categorias" => $categorias,
            "marcas" => $marcas,
          //  "porcentajes" => $porcentajes,
            "datostienda" => $datostienda,
            "varios" => $varios,
        ];

        return view('almacen.articulo.edit', $data);
    }

    public function store(ArticuloFormRequest $request)
    {
      //  dd($request);
        $slug = Str::slug($request->get('slug'), '-');


        try {
            DB::beginTransaction();
            $articulo = new Articulo;
            $articulo->idcategoria = $request->get('idcategoria');
            $articulo->idModelo = $request->get('idModelo');
            $articulo->codigo = $request->get('codigo');
            $articulo->nombre = $request->get('nombre');
            $articulo->codbar = $request->get('codbar');
            $articulo->slug = $slug;
            $articulo->tamano = $request->get('tamano');
            $articulo->color = $request->get('color');
            $articulo->idioma = $request->get('idioma');

            $articulo->descripcion = $request->get('descripcion');
            $articulo->estado = 'Activo';
            $articulo->impuesto = $request->get('exento');
            $articulo->impuestodos = $request->get('cesc');
            $articulo->porcentaje = $request->get('porcentaje');
            $articulo->porcentaje2 = $request->get('porcentaje2');
            $articulo->porcentaje3 = $request->get('porcentaje3');
            $articulo->costoProducto = $request->get('costoProducto');
            $articulo->tipo = $request->get('tipo');
            $articulo->descuento_art = 0;

            $publicado = $request->get('publicado');
            $ver_precio = $request->get('ver_precio');

            $publicado == "on" ? $articulo->publicado = 1 : $articulo->publicado = 0;
            $ver_precio == "on" ? $articulo->ver_precio = 1 : $articulo->ver_precio = 0;


            if (Input::hasFile('imagen1')) {
                

                $file = Input::file('imagen1');
                $articulo->imagen5 = time() . $file->getClientOriginalName();
                $filename = time().$file->getClientOriginalName();
    
                $file =Image::make(Input::file('imagen1'))->resize(300, null , function($c){
                    $c->aspectRatio(); 
                });
    
    
                $file->save('../public/imagenes/articulos/' .$filename);
               
            }

            $articulo->save();

            $cont = 1;
            while ($cont < 11) {
                $stocktienda = new Stocktienda();

                $stocktienda->idTienda = $cont;
                $stocktienda->idArticulo = $articulo->idarticulo;
                $stocktienda->stock = 0;
                $stocktienda->min = $request->get('minimo');
                $stocktienda->max = $request->get('maximo');
                $stocktienda->estadost = 1;
                $stocktienda->save();
                $cont++;
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('articulo')->with('success', 'Registro ingresado satisfactoriamente !');
    }

    public function update(ArticuloEditFormRequest $request, $id)
    {   //dd($request); 
        $slug = Str::slug($request->get('slug'), '-');
        $articulo = Articulo::findOrFail($id);

        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->idModelo = $request->get('idModelo');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->impuesto = $request->get('exento');
        $articulo->impuestodos = $request->get('cesc');
        $articulo->urivideo = $request->get('urivideo');
        $articulo->codbar = $request->get('codbar');
        $articulo->premio = $request->get('premio');
        $articulo->puntos = $request->get('puntos');
        $articulo->etiqueta = $request->get('etiqueta');
        $articulo->destacado = $request->get('destacado');
        $articulo->des_sf = $request->get('des_sf');
        $articulo->slug = $slug;
        $articulo->tamano = $request->get('tamano');
        $articulo->color = $request->get('color');
        $articulo->idioma = $request->get('idioma');
        $articulo->tipo = $request->get('tipo');
        $articulo->estado = 'Activo';

        $articulo->porcentaje = $request->get('porcentaje');
        $articulo->porcentaje2 = $request->get('porcentaje2');
        $articulo->porcentaje3 = $request->get('porcentaje3');
        $articulo->costoProducto = $request->get('costoProducto');
        $articulo->detalles = $request->get('detalles');

        $desc = $request->get('descuento_art');

        if ($desc != null && $desc > 0) {
            $articulo->descuento_art = $desc;
        } else {
            $articulo->descuento_art = 0;
        }

        $publicado = $request->get('publicado');
        $ver_precio = $request->get('ver_precio');

        $publicado == 'on' ? $articulo->publicado = 1 : $articulo->publicado = 0;
        $ver_precio == 'on' ? $articulo->ver_precio = 1 : $articulo->ver_precio = 0;

        $hoja_original = $request->get('hoja_original');

        if (Input::hasFile('hoja_tecnica')) {
            if ($hoja_original != null) {
                $mi_hoja = public_path() . '/fichas/' . $hoja_original;
                if (file_exists($mi_hoja)) {
                    $image_path = public_path() . '/fichas/' . $hoja_original;
                    unlink($image_path);
                }

                $file = Input::file('hoja_tecnica');
                $file->move(public_path() . '/fichas/', $file->getClientOriginalName());
                $articulo->hoja_tecnica = $file->getClientOriginalName();

            } else {
                $file = Input::file('hoja_tecnica');
                $file->move(public_path() . '/fichas/', $file->getClientOriginalName());
                $articulo->hoja_tecnica = $file->getClientOriginalName();
            }

        }

        $img_original1 = $request->get('img_original1');

        if (Input::hasFile('imagen1')) {
            $mi_imagen1 = public_path() . '/imagenes/articulos/' . $img_original1;
            if (@getimagesize($mi_imagen1)) {
                $image_path = public_path() . '/imagenes/articulos/' . $img_original1;
                unlink($image_path);
            }

            $file = Input::file('imagen1');
            $file->move(public_path() . '/imagenes/articulos/', time() . $file->getClientOriginalName());
            $articulo->imagen1 = time() . $file->getClientOriginalName();
        }

        $img_original2 = $request->get('img_original2');

        if (Input::hasFile('imagen2')) {
            $mi_imagen2 = public_path() . '/imagenes/articulos/' . $img_original2;
            if (@getimagesize($mi_imagen2)) {
                $image_path = public_path() . '/imagenes/articulos/' . $img_original2;
                unlink($image_path);
            }

            $file = Input::file('imagen2');
            $file->move(public_path() . '/imagenes/articulos/', time() . $file->getClientOriginalName());
            $articulo->imagen2 = time() . $file->getClientOriginalName();
        }

        $img_original3 = $request->get('img_original3');

        if (Input::hasFile('imagen3')) {
            $mi_imagen3 = public_path() . '/imagenes/articulos/' . $img_original3;
            if (@getimagesize($mi_imagen3)) {
                $image_path = public_path() . '/imagenes/articulos/' . $img_original3;
                unlink($image_path);
            }

            $file = Input::file('imagen3');
            $file->move(public_path() . '/imagenes/articulos/', time() . $file->getClientOriginalName());
            $articulo->imagen3 = time() . $file->getClientOriginalName();
        }

        $img_original4 = $request->get('img_original4');

        if (Input::hasFile('imagen4')) {
            $mi_imagen4 = public_path() . '/imagenes/articulos/' . $img_original4;
            if (@getimagesize($mi_imagen4)) {
                $image_path = public_path() . '/imagenes/articulos/' . $img_original4;
                unlink($image_path);
            }

            $file = Input::file('imagen4');
            $file->move(public_path() . '/imagenes/articulos/', time() . $file->getClientOriginalName());
            $articulo->imagen4 = time() . $file->getClientOriginalName();
        }

        $img_original5 = $request->get('img_original5');

        if (Input::hasFile('imagen5')) {
            $mi_imagen5 = public_path() . '/imagenes/articulos/' . $img_original5;
            if (@getimagesize($mi_imagen5)) {
                $image_path = public_path() . '/imagenes/articulos/' . $img_original5;
                unlink($image_path);
            }

            $file = Input::file('imagen5');
            $articulo->imagen5 = time() . $file->getClientOriginalName();
            $filename = time().$file->getClientOriginalName();


            $file =Image::make(Input::file('imagen5'))->resize(300, null , function($c){
                $c->aspectRatio(); 
            });


            $file->save('../public/imagenes/articulos/' .$filename);
            
        }

        $articulo->update();
        $idst = $request->get('idst');
        $min = $request->get('min');
        $max = $request->get('max');
        $stock = $request->get('stock');

        $cont = 0;
        while ($cont < count($min)) {

            $st = Stocktienda::findOrFail($idst[$cont]);
            $st->stock = $stock[$cont];
            $st->min = $min[$cont];
            $st->max = $max[$cont];
            $st->update();

            $cont++;
        }

        return Redirect::to('articulo')->with('info', 'Registro editado satisfactoriamente !');
    }

    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->Estado = "Inactivo";
        $articulo->update();
        return Redirect::to('articulo')->with('warning', 'Registro dado de baja !!!');
    }

    public function reporte(Request $request)
    {

        $categorias = DB::table('categoria')->where('condicion', '=', 'Activo')->orderby('nombreCategoria', 'asc')->get();
        $marcas = DB::table('marca')->orderby('nombreMarca', 'asc')->get();

        return view('almacen.articulo.reportes.reporte', ["categorias" => $categorias, "marcas" => $marcas]);
    }

    public function storeAjax(Request $request)
    {

        $rules = array(
            //  'nombre'    =>  'required|unique:marca'
            'codigo' => 'unique:articulo',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'idcategoria' => $request->idcategoria,
            'idMarca' => $request->idMarca,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'precio' => $request->precio,
            'estado' => 'Activo',
        );

        Articulo::create($form_data);

        return response()->json([
            'success' => 'Articulo Agregado Satisfactoriamente !!!',
        ]);

    }
/* REPORTE DE ARTICULOS */
    public function rapdf(Request $request)
    {
        //dd($request);
        $estado = trim($request->get('estado'));
        $query3 = trim($request->get('texto'));
        $query2 = trim($request->get('idCategoria'));
        $query = trim($request->get('idMarca'));
        if ($query3 == null) {
            $query3 = '%';
        }
        $varios = Miscelanea::first();
        $cero = trim($request->get('cero'));
        if ($cero === "Si") {
            //ELEMENTOS ACTIVOS CON STOCK EN CERO O MENOR
            if ($request->get('idMarca') === '%' && $request->get('idCategoria') === '%') {
             //dd($cero);
                $articulos = DB::table('articulo as a')
                    ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                    ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                    ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                    ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                    ->join('tienda as t', 'st.idTienda', '=', 't.id')
                    ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.impuesto', 'a.color', 'a.impuestodos', 'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                        'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(st.stock) as stock'), 'a.costoProducto')
                    ->where('a.publicado', 1)
                    ->where('t.estado', 1)
                    ->where('stock', '<=', 0)
                    ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                    ->groupby('a.codigo')
                    ->orderBy('a.idarticulo', 'desc')
                    ->get();
                //DD($articulos);
                $r = 'REPORTE DE TODOS LOS ARTICULOS EN CERO O MENOS';
                return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));
            }
            if ($request->get('idMarca') === '%') {
                $articulos = DB::table('articulo as a')
                    ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                    ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                    ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                    ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                    ->join('tienda as t', 'st.idTienda', '=', 't.id')
                    ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.impuesto', 'a.color', 'a.impuestodos', 'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3','a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                        'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(st.stock) as stock'), 'a.costoProducto')
                    ->where('a.publicado', 1)
                    ->where('t.estado', 1)
                    ->where('stock', '<=', 0)
                    ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                    ->where('a.idcategoria', '=', $query2)
                    ->groupby('a.codigo')
                    ->orderBy('a.idarticulo', 'desc')
                    ->get();
                $r = 'Reporte de todas las marcas y categoria => especifica ';
                return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));

            }
            if ($request->get('idCategoria') === '%') {

                $articulos = DB::table('articulo as a')
                    ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                    ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                    ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                    ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                    ->join('tienda as t', 'st.idTienda', '=', 't.id')
                    ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.impuesto', 'a.color', 'a.impuestodos',  'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                        'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(stock) as stock'), 'a.costoProducto')
                    ->where('t.estado', 1)
                    ->where('md.idMarca', '=', $query)
                    ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                    ->where('stock', '<=', 0)
                    ->groupby('a.codigo')
                    ->orderBy('nombreMarca', 'asc')
                    ->get();
                //DD($articulos);
                $r = 'Reporte de todas las categorias  y marca => especifica ';
                return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));

            } else {
                $articulos = DB::table('articulo as a')
                    ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                    ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                    ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                    ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                    ->join('tienda as t', 'st.idTienda', '=', 't.id')
                    ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.impuesto', 'a.color', 'a.impuestodos',  'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                        'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(st.stock) as stock'), 'a.costoProducto')
                    ->where('a.publicado', 1)
                    ->where('t.estado', 1)
                    ->where('stock', '<=', 0)
                    ->where('md.idMarca', '=', $query)
                    ->where('a.idcategoria', '=', $query2)
                    ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                    ->groupby('a.codigo')
                    ->orderBy('a.idarticulo', 'desc')
                    ->get();
                //DD($articulos);
                $r = 'REPORTE DE TODOS LOS ARTICULOS EN CERO O MENOS';
                return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));
            }
        }
        /*FIN BUSQUEDA DE BLOQUE EN EXCLUSIVAMENTE EN CEROS */
        else {

            /*ARTICULOS ARRIBA DE CERO */
            /*SOLO BOTON BUSCAR*/
            if ($request->get('beneficio')== 'Si')  {      /*BENEFICIO GENERAL*/



                $articulos = DB::select('select  a.idarticulo
                        ,a.nombre
                        ,nombreModelo
                        ,SUM(di.cantidad) as artc 
                        ,SUM(di.cantidad * di.precio_compra) as ctar
                        ,porcentaje
                        ,porcentaje2
                        ,porcentaje3
                        ,costoProducto
                        ,impuesto
                        ,impuestodos
                        ,descuento_art
                    
                        ,(SELECT SUM(cantidad)                  FROM detalle_venta WHERE idarticulo  = a.idarticulo)artv 
                        ,(SELECT SUM(precio_venta * cantidad)   FROM detalle_venta WHERE idarticulo  = a.idarticulo)vtar 
                        
                          

                    from articulo  a
                        join modelo                  md  on  a.idModelo   =  md.idModelo
                        left join detalle_ingreso as di  on  a.idarticulo =  di.idarticulo
                         

                        where  di.cantidad > 0
                        and a.tipo = 0  

                        /* where 
                        e.fecha_hora between "'.$query.'%'.'" and "'.$query2.'%'.'"   */



                          group by  idarticulo;'); 


                /* $articulos = DB::table('articulo as a')         
                        ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                        ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                        ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                        ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                        ->join('tienda as t', 'st.idTienda', '=', 't.id') 
                        ->join('detalle_ingreso as di', 'a.idarticulo', '=', 'di.idarticulo')
                        ->join('detalle_venta as dv', 'a.idarticulo', '=', 'dv.idarticulo')
                        ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.impuesto', 'a.impuestodos', 'a.porcentaje', 'a.costoProducto as precio',
                            'a.estado', 'a.descuento_art',  'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria',  'di.cantidad',    
                            DB::raw('SUM(st.stock) as stock'),  DB::raw('SUM(di.cantidad) as artc'),  
                            'a.costoProducto')

                        ->where('t.estado', 1)
                        ->where('stock', '>=', 1)
                        ->groupby( 'idarticulo')
                        ->orderBy('a.idarticulo', 'desc')
                        ->get(); */

                return view('almacen.articulo.reportes.beneficio', compact('articulos', 'varios'));
                /*FIN  BENEFICIO GENERAL*/
            } else {
                if ($request->get('idMarca') === '%' && $request->get('idCategoria') === '%') {
                    $articulos = DB::table('articulo as a')
                        ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                        ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                        ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                        ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                        ->join('tienda as t', 'st.idTienda', '=', 't.id')
                        ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.color', 'a.impuesto', 'a.impuestodos', 'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                            'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(stock) as stock'), 'a.costoProducto')
                        ->where('t.estado', 1)
                        ->where('stock', '>=', 1)
                        ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                        ->groupby('a.codigo')
                        ->orderBy('a.idarticulo', 'desc')
    
                        ->get();
                    //dd($articulos);
                    $r = 'Reporte de todas las categorias y marcas';
                    return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));
                }
                /*BUSQUEDA POR CATEGORIA,  CERO Y EN STOCK*/
                if ($request->get('idMarca') === '%') {
                    $articulos = DB::table('articulo as a')
                        ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                        ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                        ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                        ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                        ->join('tienda as t', 'st.idTienda', '=', 't.id')
                        ->select('a.idarticulo', 'a.nombre', 'a.codigo',  'a.color',  'a.impuesto', 'a.impuestodos',  'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3','a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                            'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(stock) as stock'), 'a.costoProducto')
                        ->where('t.estado', 1)
                        ->where('a.idcategoria', '=', $query2)
                        ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                        ->groupby('a.codigo')
                        ->orderBy('nombreMarca', 'asc')
                        ->get();
                    $r = 'Reporte de  categoria => especifica,  elementos en cero y en stock';
                    return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));
    
                }
                /*BUSQUEDA POR MARCA,  CERO Y EN STOCK*/
                if ($request->get('idCategoria') === '%') {
                    //DD($query);
                    $articulos = DB::table('articulo as a')
                        ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                        ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                        ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                        ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                        ->join('tienda as t', 'st.idTienda', '=', 't.id')
                        ->select('a.idarticulo', 'a.nombre', 'a.codigo',  'a.color',  'a.impuesto', 'a.impuestodos',  'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                            'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(stock) as stock'), 'a.costoProducto')
                        ->where('t.estado', 1)
                        ->where('md.idMarca', '=', $query)
                        ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                        ->groupby('a.codigo')
                        ->orderBy('nombreMarca', 'asc')
                        ->get();
    
                    $r = 'Reporte de todas las categorias,  marca => especifica,  elementos en cero y en stock';
                    return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));
    
                } else {
                    $articulos = DB::table('articulo as a')
                        ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                        ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
                        ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
                        ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
                        ->join('tienda as t', 'st.idTienda', '=', 't.id')
                        ->select('a.idarticulo', 'a.nombre', 'a.codigo',  'a.color',  'a.impuesto', 'a.impuestodos', 'a.porcentaje',  'a.porcentaje2',  'a.porcentaje3', 'a.costoProducto as precio', 'a.estado', 'a.descuento_art',
                            'm.nombreMarca', 'md.nombreModelo', 'c.nombreCategoria', DB::raw('SUM(stock) as stock'), 'a.costoProducto')
                        ->where('t.estado', 1)
                        ->where('stock', '>=', 1)
                        ->where('md.idMarca', '=', $query)
                        ->where('a.idcategoria', '=', $query2)
                        ->where('a.nombre', 'LIKE', '%' . $query3 . '%')
                        ->groupby('a.codigo')
                        ->orderBy('a.idarticulo', 'desc')
    
                        ->get();
                    //dd($articulos);
                    $r = 'Reporte de todas las categorias y marcas';
                    return view('almacen.articulo.reportes.rapdf', compact('articulos', 'r', 'varios'));
                }
            }
            


            
        }
    }


  

    function comprobar_slug_codigo(Request $request) {

        $slug = Str::slug($request->get('query'), '-');
        $vslug = Articulo::where("slug", '=',  $slug)->first();


        $codigo = $request->get('query2');
        $vcodigo = Articulo::where("codigo", '=',  $codigo )->first();


        return response()->json([
            'slug' =>  $vslug,
            'codigo' => $vcodigo
        ]);
      
    } 
    
    public function vinetas(Request $request)
    {

        $articulo = Articulo::articulo($request->get('id'));
        $cantidad = $request->get('cant');
        $varios = Miscelanea::first();
        $barcode_generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        $barcode = $barcode_generator->getBarcode($articulo->codigo, $barcode_generator::TYPE_CODE_128, 2, 75.59);

        return view('almacen.articulo.vinetas', [
            'articulo' => $articulo,
            'barcode' => $barcode,
            'cantidad' => $cantidad,
            'varios' => $varios, 
            'request' => $request
        ]);
        // dd($request);
    }


    function updatedstock(Request $request) {
        $query = $request->get('query');    //id transaccion
        $valor = $request->get('query2');   //monto
       
        DB::table('stocktienda')->where('idTienda',  1 )->where('idarticulo' , $query)->update(['stock' => $valor]);

        echo  "<b style = 'color:013876;'>ECHO</b>";
    }

    function update_index_articulo(Request $request) {
        
        $idarticulo = $request->get('fila');    //id transaccion
        $valor = $request->get('valor');     //monto
        $columna = $request->get('columna');   
       
        if ($columna == "stock") {
            DB::table('stocktienda')->where('idTienda',  1 )->where('idarticulo' , $idarticulo)->update(['stock' => $valor]);
        } elseif ($columna == "cdc") {
            DB::table('articulo')->where('idarticulo' , $idarticulo )->update(['cdc' => $valor]);
        } 
          
    }
}
/*572 */