<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porcentaje extends Model
{
    protected $table = "porcentaje";
    protected $primaryKey = "idPorcentaje";
    public $timestamps = false;
    protected $fillable = [
    	'porcentaje'
    ];
    protected $guarded = [

    ];
}