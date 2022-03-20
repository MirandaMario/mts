<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $table = "abono";
    protected $primaryKey = "id_abono";
    public $timestamps = true;
    protected $fillable = [
        'id_expediente', 
    	'fecha_hora_a', 
    	'valor', 
        'concepto', 
        'forma_abono', 
        'estado_abono'
        
    ];

    protected $guarded = [

    ];
}