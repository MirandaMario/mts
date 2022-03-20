<?php

namespace App;
use DB;
use App\Categoria;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categoria";
    protected $primaryKey = "idcategoria";
    public $timestamps = false;
    protected $fillable = [
        'nombreCategoria',
        'condicion',
        'descuento_cat', 
        'ctexto', 
        'escritorio', 
        'movil', 
        'cslug', 
        'ckeyword', 
        'cdescripcion',
        'ch1',
        'ch2' 
    ];
    protected $guarded = [

    ];

    protected function categorias()
    {
       // $categorias = DB::table('categoria')->select('idcategoria', 'nombreCategoria', 'cslug')->orderBy('nombreCategoria', 'asc')->get();
       $categorias = Categoria::join('articulo as a', 'categoria.idcategoria', '=', 'a.idcategoria')
       ->join('stocktienda as st', 'a.idarticulo', '=', 'st.idArticulo')
       ->select('categoria.nombreCategoria', 'categoria.idcategoria', 'cslug', DB::raw('SUM(stock) as stock'))
       ->where('stock', '>',  0)
       ->where('a.publicado', 1)   
       ->orderBy('nombreCategoria', 'asc')         
       ->groupby('categoria.idcategoria')
       ->get();


       return  $categorias;
    }

    public function getNombreCategoriaAttribute($value){
        return strtoupper($value); 
    }

}
