<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = "modelo";
    protected $primaryKey = "idModelo";
    public $timestamps = false;
    protected $fillable = [
    	'idMarca',
        'nombreModelo',
        'estado'
    ];
    protected $guarded = [

    ];
}
