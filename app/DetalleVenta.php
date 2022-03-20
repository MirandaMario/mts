<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalle_venta";
    protected $primaryKey = "iddetalle_venta";
    public $timestamps = false;
    protected $fillable = [
        'idventa',
        'idarticulo',
        'cantidad',
        'precio_lista',
        'precio_venta',
        'descuento',
        'impuesto', //IVA
        'impuestodos', // CESC
        'beneficio',
        'origen',
        'descripciondv', 
        'puntos', 
        'serie', 
        'garantia', 
        'sobrenombre'
    ];
    protected $guarded = [

    ];

    protected function venta($id)
    {
        $venta = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('tienda as t', 'v.idtienda', '=', 't.id')    
            ->leftjoin('resolucion as r', 'v.idresolucion', '=', 'r.id_resolucion')
            ->join('munsv as mp', 'p.municipio', '=', 'mp.ID')
            ->join('depsv as dep', 'mp.DEPSV_ID', '=', 'dep.ID')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'p.idpersona', 'v.tipo_comprobante', 'dep.DepName as departamento', 'mp.MunName as municipio', 't.tel_tienda',
            'v.serie_comprobante', 'v.num_comprobante', 'v.estado', 'v.total_venta', 'v.idtienda', 'p.iva', 'p.nit', 'p.giro', 
            't.nombreTienda', 'r.numero_resolucion', 'r.fecha_resolucion', 'r.rango_desde',  'r.rango_hasta' ,  'r.serie_resolucion' ,  't.direccion', 'p.direccion as direccion_cliente')
            ->where('v.idventa', '=', $id)
            ->first();
       // dd($venta); 

        return $venta;     

    }

    protected function detalles($id)
    {
        $detalles = DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->select('a.codigo as codigo', 'a.nombre as articulo', 'd.cantidad', 'd.sobrenombre',  'd.descuento', 'd.precio_venta',
             'd.precio_lista', 'd.impuesto', 'd.impuestodos' , 'd.descripciondv' , 'md.nombreModelo', 'm.nombreMarca', 'd.serie', 'd.garantia')
            ->where('d.idventa', '=', $id)
            ->get();
        return $detalles; 
    }
}
