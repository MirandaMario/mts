<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = "detalle_pedido";
    protected $primaryKey = "id_detalle_pedido";
    public $timestamps = false;
    protected $fillable = [
    	'id_pedido',
    	'id_articulo',
    	'cantidad_items',
        'precio', 
        'descuento'
    ];
    protected $guarded = [

    ];
}
