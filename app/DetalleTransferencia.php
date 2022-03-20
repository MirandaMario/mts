<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTransferencia extends Model
{
    protected $table = "detalle_transferencia";
    protected $primaryKey = "iddetalle_transferencia";
    public $timestamps = false;
    protected $fillable = [
    	'id_transferencia',
    	'idarticulo',
        'cantidad', 
        'origen', 
        'destino'
    ];
    protected $guarded = [

    ];
}