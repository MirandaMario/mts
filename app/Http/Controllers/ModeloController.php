<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Modelo;
use Illuminate\Support\Facades\Redirect;
use DB;


class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $modelos = DB::table('modelo as m')
        ->join('marca as ma', 'ma.idMarca', '=', 'm.idMarca')
        ->select('m.idModelo', 'nombreModelo', 'nombreMarca', 'm.estado' )
        ->get();
        $marcas = DB::table('marca')->orderBy('nombreMarca')->get();
        $data = [
            "modelos" => $modelos,
            "marcas" => $marcas
        ];
        return view('almacen.modelo.index',  $data);
    }
    public function edit($id)
    {
        $modelo = DB::table('modelo as m')
        ->join('marca as ma', 'ma.idMarca', '=', 'm.idMarca')
        ->where('idModelo', '=', $id)
        ->first();
        $marcas = DB::table('marca')->orderBy('nombreMarca')->get();


        $data = [
            "modelo" => $modelo,
            "marcas" => $marcas
        ];
        return view('almacen.modelo.edit',  $data);
    }

    public function update(Request $request, $id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->nombreModelo = $request->get('nombreModelo');
        $modelo->idMarca = $request->get('marcas');
        $modelo->estado = 'Activo';
        $modelo->update();
        return Redirect::to('modelo')->with('info', 'Registro editado satisfactoriamente!');
    }

    public function destroy($id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->estado = "Inactivo";
        $modelo->update();
        return Redirect::to('modelo')->with('warning', 'Registro dado de baja !!!');
    }

    public function storeAjax(Request $request)
    {

        $rules = array(
            'nombreModelo'    =>  'required|unique:modelo'

        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $modelo = New Modelo();
        $modelo->nombreModelo = $request->get('nombreModelo');
        $modelo->idMarca = $request->get('idMarca');
        $modelo->estado = "Activo";

        $modelo->save();


        $modelos = DB::table('modelo') //->where('condicion' , '=', 'Activo')
            ->orderBy('nombreModelo')->get();

        return response()->json([
            'success' => 'Modelo Agregado Satisfactoriamente !!!',
            'modelos' => $modelos
        ]);
        //   echo $output;
    }


    function porModelo(Request $request)
    { 
       // dd($request); 
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('modelo')
                ->where('idMarca', '=', $query)
                ->where('estado', 'Activo')
                ->orderby('nombreModelo', 'asc')
                //->take(10)
                ->get();

            return $data;

        }
    }
}
