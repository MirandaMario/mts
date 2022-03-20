<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = "tienda";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
    	'nombreTienda', 
        'cotizacion',
        'ticket',
        'factura',
        'ccf',
        'direccion',
        'estado', 
        'online'
   
    ];
    protected $guarded = [

    ];
}