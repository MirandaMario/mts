<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; 
use App\Miscelanea;
use Illuminate\Support\Facades\Redirect;

class ConfiguracionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $configuracion = DB::table('configuracion')->get();
        $data = ["configuracion" => $configuracion];
        return view('configuracion.index', $data);

    }

    public function update(Request $request, $id)
    {
        $configuarcion = Miscelanea::findOrFail($id);
        $configuarcion->moneda  = $request->get('moneda');
        $configuarcion->cadena = $request->get('cadena');
        $configuarcion->descripcion = $request->get('descripcion');
        $configuarcion->update();
        return Redirect::to('configuracion')->with('info', 'Registro editado satisfactoriamente!'); 
    }

}
