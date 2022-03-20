<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Salida;
use Illuminate\Support\Facades\Redirect;

class SalidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $salidas = DB::table('salida')->get();
        $data = [
            "salidas" => $salidas,
        ];
        return view('salida.index', $data);
    }


    public function create()
    {
        return view('salida.create');
    }


    public function store(Request $request)
    {
        //dd($request); 
        try {
            DB::beginTransaction();
            $salida = new Salida;
            $salida->id_proveedor = $request->get('idP');
            $salida->numero = $request->get('numero');
            $salida->concepto = $request->get('concepto');
            $salida->tipo = $request->get('tipo');
            $salida->valor = $request->get('valor');
            $salida->iva = $request->get('iva');
            $salida->imp1 = $request->get('imp1');
            $salida->imp2 = $request->get('imp2');
            $salida->retencion = $request->get('retencion');
            $salida->fecha = $request->get('check_in');
            $salida->save();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('salida')->with('success', 'Registro ingresado satisfactoriamente !');
    }


    public function show($id)
    {
        return view('salida.show');
    }


    public function edit($id)
    {
        $data = ["salida" => Salida::findOrFail($id)];
        return view('salida.edit', $data);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $salida = Salida::findOrFail($id);
            $salida->id_proveedor = $request->get('idP');
            $salida->numero = $request->get('numero');
            $salida->concepto = $request->get('concepto');
            $salida->tipo = $request->get('tipo');
            $salida->valor = $request->get('valor');
            $salida->iva = $request->get('iva');
            $salida->imp1 = $request->get('imp1');
            $salida->imp2 = $request->get('imp2');
            $salida->retencion = $request->get('retencion');
            $salida->fecha = $request->get('check_in');
            $salida->update();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('salida')->with('success', 'Registro editado satisfactoriamente !');
    }


    public function destroy($id)
    {
        //
    }


    public function reporte(Request $request)
    {
        $query = $request->get('fecha');
        $query2 = $request->get('fecha2') . (' 23:59');
        $query3 = $request->get('tipo_comprobante');

        $salidas = DB::table('salida')
            ->where('tipo', 'LIKE', '%' . $query3 . '%')
            ->whereBetween('fecha', [$query, $query2])
            ->orderBy('fecha', 'desc')
            ->get();

            $data = [
                "salidas" => $salidas,
                "request" => $request,
            ];    
            return view('salida.reporte', $data) ; 
       /*  return view('salida.reporte')->with(compact('salidas')) ;  */
    }
}
