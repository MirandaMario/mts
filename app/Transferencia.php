<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = "transferencia";
    protected $primaryKey = "id_transferencia";
    public $timestamps = true;
    protected $fillable = [
    	'id_origen',
    	'id_destino',
        'descripcion',
        'estado'
    ];
    protected $guarded = [

    ];
}
