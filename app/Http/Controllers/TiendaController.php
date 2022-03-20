<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; 
use App\Tienda; 
use App\Http\Requests\TiendaFormRequest;
use Illuminate\Support\Facades\Redirect;

class TiendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tienda = DB::table('tienda')->where('estado', 1)->get();
        $data = ["tienda" => $tienda];
        return view('tienda.index', $data);

    }

    public function edit($id)
    { //  dd($id);
        $data = ["tienda" => Tienda::findOrFail($id)];
        return view('tienda.edit', $data);
    }

    
   public function update(TiendaFormRequest $request, $id)
    {
       // dd($request);
        $tienda = tienda::findOrFail($id);
        $tienda->nombreTienda = $request->get('nombreTienda');
        $tienda->cotizacion = $request->get('cotizacion');
        $tienda->ticket = $request->get('ticket');
        $tienda->factura = $request->get('factura');
        $tienda->ccf = $request->get('ccf');
        $tienda->direccion = $request->get('direccion');
        $tienda->update();
        return Redirect::to('tienda_conf');
    }
}
