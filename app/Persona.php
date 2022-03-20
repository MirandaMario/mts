<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Persona extends Authenticatable
{
    use Notifiable;
    protected $table = "persona";
    protected $primaryKey = "idpersona";
    public $timestamps = false;
    protected $fillable = [
    	'tipo_persona',    	
    	'nombre',
        'alias',
        'contacto',
        'contacto2',
        'contacto3',
        'tel',
        'tel2',
        'tel3',
        'email',
        'email2',
        'email3',
        'nit',
        'iva',
        'giro',
        'dui',
        'direccion',
        'estado',
        'forma_pago', 
        'tipo_contribuyente', 
        'municipio', 
        'name',  
        'password',
        'suscribete',
        
    ];
    protected $guarded = [

    ];

    protected function municipio($id)
    {
        $municipio = DB::table('munsv')->where('ID', $id)->first();
        return $municipio;
    }
}
