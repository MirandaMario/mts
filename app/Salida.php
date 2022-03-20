<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table = "salida";
    protected $primaryKey = "id_salida";
    public $timestamps = true ; 
    protected $fillable = [
        'id_proveedor',
        'numero', 
    	'tipo',
        'concepto',
        'valor',
        'fecha',
        'retencion',
        'iva',
        'imp1',
        'imp2'
    ];
    protected $guarded = [

    ];
}
