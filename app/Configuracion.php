<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = "configuracion";
    protected $primaryKey = "id_miscelanea";
    public $timestamps = false;
    protected $fillable = [
        'envios',
        'terminos',
        'cimagen',  //Desktop Carrusel
        'cimagen2', 
        'cimagen3', 
        'ct',       //Movil Carrusel
        'ct2', 
        'ct3'
    ];
    protected $guarded = [

    ];
}