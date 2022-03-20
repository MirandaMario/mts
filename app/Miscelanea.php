<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miscelanea extends Model
{
    protected $table = "configuracion";
    protected $primaryKey = "id_miscelanea";
    public $timestamps = false;
    protected $fillable = [
    	'moneda',
        'cadena', 
        'descripcion'
    
    ];
    protected $guarded = [

    ];
}
