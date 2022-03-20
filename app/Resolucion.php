<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    protected $table = "resolucion";
    protected $primaryKey = "id_resolucion";
    public $timestamps = false;
    protected $fillable = [
        'tipo_documento',
        'rango_desde',
        'rango_hasta', 
        'fecha_resolucion', 
        'numero_resolucion', 
        'estado_res', 
        'tienda_res', 
        'serie_resolucion'
        
    ];
    protected $guarded = [

    ];

}
