<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    protected $table = "detalle_cotizacion";
    protected $primaryKey = "idDetalleCotizacion";
    public $timestamps = false;
    protected $fillable = [
    	'idCotizacion',
    	'idArticulo',
        'cantidad',
        'precioVenta',
        'descuento', 
        'precio_lista', 
        'beneficio', 
        'descripciondc'
    ];
    protected $guarded = [

    ];
}
