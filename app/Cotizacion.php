<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 

class Cotizacion extends Model
{
    protected $table = "cotizacion";
    protected $primaryKey = "idCotizacion";
    public $timestamps = true ; 
    protected $fillable = [
        'idCliente',
        'idtienda', 
    	'idUsuario',
        'tipo_comprobante',
        'numeroComprobante',
        'fecha_hora',
        'total_cotizacion',
        'descripcion',
        'estado',
        'descuento',
        'validez',
        'entrega',
        'nota',
        'pago'
    ];
    protected $guarded = [

    ];


    protected function ventas_historico($numero , $idcliente)
    {   
       
        $ventas = DB::table('cotizacion as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->leftjoin('detalle_cotizacion as dv', 'v.idCotizacion', '=', 'dv.idCotizacion')
            ->select('v.idCotizacion', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.numeroComprobante', 'v.estado', 'v.total_cotizacion', 'v.fecha_hora', 'v.descuento')
            ->where(function ($query2) use ($numero,$idcliente ) {
                $query2->orwhere('p.idpersona', $idcliente);
                $query2->orwhere('v.numeroComprobante',$numero);
            })
            ->orderBy('v.idCotizacion', 'desc')
            ->groupBy('v.idCotizacion')
            ->get();
        return $ventas;
    }


    protected function ventas_tienda($id)
    {
        $ventas = DB::table('cotizacion as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->leftjoin('detalle_cotizacion as dv', 'v.idCotizacion', '=', 'dv.idCotizacion')
            ->select('v.idCotizacion', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.numeroComprobante', 'v.estado', 'v.total_cotizacion', 'v.fecha_hora', 'v.descuento')
            ->where('v.idtienda', $id)
            ->orderBy('v.idCotizacion', 'desc')
            ->groupBy('v.idCotizacion')
            ->take(50)
            ->get();
        
    
        return $ventas;
    }

    protected function ventas()
    {
        $ventas = DB::table('cotizacion as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->leftjoin('detalle_cotizacion as dv', 'v.idCotizacion', '=', 'dv.idCotizacion')
            ->select('v.idCotizacion', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.numeroComprobante', 'v.estado', 'v.total_cotizacion', 'v.fecha_hora', 'v.descuento')
            ->orderBy('v.idCotizacion', 'desc')
            ->groupBy('v.idCotizacion')
            ->take(50)
            ->get(); 
        
        return $ventas;
    }
}
