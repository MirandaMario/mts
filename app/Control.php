<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $table = "control_factura";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
    	'tipo', 
    	'serie', 
    	'correlativo', 
        'resolucion',
        'rango', 
        'fecha'
    ];
    protected $guarded = [

    ];
}