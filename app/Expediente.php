<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = "expediente";
    protected $primaryKey = "id_expediente";
    public $timestamps = true;
    protected $fillable = [
        'numero_expediente', 
        'id_paciente', 
        'id_ciente',
        'habitacion', 
        'fecha_hora_ex', 
        //Datos aseguradora
        'empresa', 
        'asegurado_principal', 
        'carnet',
        'dependecia',
        'poliza',
        'dx_ingreso',
        'dx_codigo',
        'fomulario',
        'cargo_no_cub',
        'tipo_ing',
        'ing_por',
        'even_ing',
        //Dr recibos
        'dr',
        'dr2',
        'dr3',
        'dr4',
        'dr5',
        'dr6',
        'dr7',
        //Datos egreso
        'fecha_hora_alta',
        'dx_egreso',
        'otros_diag',
        'inter_qui',
        'cond_egre',
        'enf_resp',
        'obs_egre',
        'hora_far',
        'hora_tel',
        'hora_caj',
        'rec_paga'
        
    ];

    protected $guarded = [

    ];
}