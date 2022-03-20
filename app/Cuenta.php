<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = "cuentas"; 
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
    	'banco',
    	'tipoCuenta',
        'nombreCuenta', 
        'numeroCuenta', 
        'numeroCheque', 
        'serieCheque', 
        'estado',
        'fechaCreacion', 
        'saldo', 
        'idCuentaOrigen'
    	
    ];
    protected $guarded = [

    ];
}
