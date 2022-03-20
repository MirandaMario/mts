<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; 
use App\Miscelanea;
use Illuminate\Support\Facades\Redirect;

class TiendaUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tienda = DB::table('users as u')
        ->join('tienda as t', 'u.id_tienda', '=', 't.id')
        ->select('u.id as iduser', 'nombreTienda', 'name', 'email')
        ->get();
        $data = ["tienda" => $tienda];
        return view('tiendauser.index', $data);

    }

/*     public function update(Request $request, $id)
    {
        $configuarcion = Miscelanea::findOrFail($id);
        $configuarcion->moneda  = $request->get('moneda');
        $configuarcion->cadena = $request->get('cadena');
        $configuarcion->descripcion = $request->get('descripcion');
        $configuarcion->update();
        return Redirect::to('configuracion')->with('info', 'Registro editado satisfactoriamente!'); 
    } */

}