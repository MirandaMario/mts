<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = "mensaje";
    protected $primaryKey = "id_mensaje";
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'asunto',
        'mjs', 
        'suscrito', 
        'estado', 
        'notas'
    ];
    protected $guarded = [

    ];
}