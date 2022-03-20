<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model
{
    protected $table = "transacciones";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
    	'idPersona',
    	'idCuenta',
        'numeroCheque',
        'serieCheque', 
        'numeroRemesa',
        'valorNominal',
        'renta',
        'valorLiquido',
        'valorIngreso',
        'tipoMov', 
        'conceptog',
        'concepto', 
        'comprobante',
        'fecha',
        'estado', 
        'acuerdo', 
        'acta', 
        'fechaac'
    	//Activo  Anulado 
    ];
    protected $guarded = [

    ];
}
