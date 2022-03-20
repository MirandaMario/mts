<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    protected $table = "corte";
    protected $primaryKey = "id_corte";
    public $timestamps = false;
    protected $fillable = [
    	'id_tienda',
        'correlativo',
    	'tipo_corte',
    	'fecha_ejec',    
        'fecha_inicio',
        'fecha_fin',
        'ticket_desde',
        'ticket_hasta',
        'exentas',
        'no_sujetas',
        'gravadas', 
        'devolucion', 
        'cantidad_devoluciones', 
        'total_venta', 
        'cantidad_transacciones'

    ];
    protected $guarded = [

    ];
}
