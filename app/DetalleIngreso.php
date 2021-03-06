<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = "detalle_ingreso";
    protected $primaryKey = "iddetalle_ingreso";
    public $timestamps = false;
    protected $fillable = [
    	'idingreso',
    	'idarticulo',
    	'cantidad',
        'precio_compra',
        'precio_venta',
        'lote', 
        'fecha_fac', 
        'fecha_ven'
    ];
    protected $guarded = [

    ];
}
