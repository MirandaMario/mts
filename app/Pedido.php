<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedido";
    protected $primaryKey = "id_pedido";
    public $timestamps = true;
    protected $fillable = [
        'id_cliente',
        'tipo_pago',
        'nume_transaccion',
        'fecha_transaccion',
        'valor_transaccion',
        'id_banco',
        'fecha',
        'estado',
        'notas', 
        'notasint', 
        'monto_compra', 
        'pnombre', 
        'pemail', 
        'ptel', 
        'pidmunicipio', 
        'pdireccion'
    ];
    protected $guarded = [

    ];


    public function getFechaAttribute($value)
    {
        return date('d-m-yy H:i', strtotime($value)); 
    }

    public function getFechaTransaccionAttribute($value)
    {
        return date('d-m-yy', strtotime($value)); 
    }
}