<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "marca";
    protected $primaryKey = "idMarca";
    public $timestamps = false;
    protected $fillable = [
        'nombreMarca',
        'estado'
    ];
    protected $guarded = [

    ];


    public function getNombreMarcaAttribute($value)
    {
        return  strtoupper($value); 
    }
}
//TODO: Provando todo
