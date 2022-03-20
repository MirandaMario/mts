<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 

class Stocktienda extends Model
{
    protected $table = "stocktienda";
    protected $primaryKey = "id_stocktienda";
    public $timestamps = false;
    protected $fillable = [
    	'idTienda', 
    	'idArticulo', 
    	'stock', 
        'min',
        'max' , 
        'estadost'
      
    ];
    protected $guarded = [

    ];


    protected function stock_articulo_tienda($id)
    {
        $datostienda = DB::table('stocktienda as st')
        ->join('tienda as t', 'st.idTienda', '=', 't.id')
        ->where('t.estado', 1)
        ->where('st.idArticulo', $id)
        ->get();

        return  $datostienda;
    }
}