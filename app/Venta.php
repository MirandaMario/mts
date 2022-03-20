<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 

class Venta extends Model
{
    protected $table = "venta";
    protected $primaryKey = "idventa";
    public $timestamps = true;
    protected $fillable = [
        'idtienda',
    	'idcliente',
        'idusuario', 
    	'tipo_comprobante',
    	'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'impuestodos',
        'total_venta',
        'estado',
        'descuento', 
        'id_origen', 
        'iva', 
        'cesc',
        'envio', 
        'notas', 
        'envio_interno', 
        'transporte', 
        'nguia', 
        'estado_pago'
     
    ];
    protected $guarded = [

    ];


    protected function ventas_tienda($id)
    {
        $ventas = DB::table('venta as v')
        ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')  
        ->select('v.idventa', 'v.fecha_hora', 'v.idtienda', 'p.nombre', 'p.tel', 'v.estado_pago',  'v.envio', 'v.notas',   'v.tipo_comprobante', 'v.transporte', 'v.forma_pago', 'v.nguia', 'v.envio_interno', 
        'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta', 'v.fecha_hora', 'v.created_at' ,  'v.idusuario')
        ->where('v.idtienda', $id)
        ->orderBy('v.idventa', 'desc')
        ->groupBy('v.idventa')
        ->take(50)
        ->get(); 
        return $ventas;
    }

    protected function ventas_historico($numero , $idcliente)
    {   
        $ventas = DB::table('venta as v')
        ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')  
        ->select('v.idventa', 'v.fecha_hora', 'v.idtienda', 'p.nombre', 'p.tel',  'idpersona',  'v.estado_pago', 'v.notas',  'v.envio', 'v.tipo_comprobante',  'v.transporte', 'v.forma_pago', 'nguia', 'v.envio_interno', 
        'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta', 'v.fecha_hora', 'v.created_at' ,  'v.idusuario')
        ->where(function ($query2) use ($numero,$idcliente ) {
            $query2->orwhere('p.idpersona', $idcliente);
            $query2->orwhere('v.num_comprobante',$numero);
        })
        ->orderBy('v.idventa', 'desc')
        ->groupBy('v.idventa')
        ->get(); 
        return $ventas;
    }



    protected function ventas()
    {
        $ventas = DB::table('venta as v')
        ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')  
        ->select('v.idventa', 'v.fecha_hora', 'v.idtienda', 'p.nombre', 'p.tel', 'v.notas', 'v.estado_pago', 'v.tipo_comprobante', 'v.envio',  'v.transporte', 'v.forma_pago', 'nguia', 'v.envio_interno', 
        'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta', 'v.fecha_hora',  'v.idusuario')
        ->orderBy('v.idventa', 'desc')
        ->groupBy('v.idventa')
        ->take(50); 
        //->get(100);

        return $ventas;
    }
}
