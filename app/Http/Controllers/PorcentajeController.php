<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Porcentaje;
use Illuminate\Support\Facades\Redirect;
//use App\Http\Requests\CategoriaFormRequest;
use DB;
use GuzzleHttp\Psr7\Response;

class PorcentajeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $porcentajes = DB::table('porcentaje')
                ->get();

            $data = [
                "porcentajes" => $porcentajes
            ];

            return view('porcentaje.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("porcentaje.create");
    }

    
    public function store(Request $request)
    {
        $porcentaje = new Porcentaje;
        $porcentaje->porcentaje = $request->get('porcentaje');
 
        $porcentaje->save();
        return Redirect::to('porcentaje')->with('success', 'Registro ingresado satisfactoriamente !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ["porcentaje" => Porcentaje::findOrFail($id)];
        return view('porcentaje.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $porcentaje = Porcentaje::findOrFail($id);
        $porcentaje->porcentaje = $request->get('porcentaje');
       
        $porcentaje->update();
        return Redirect::to('porcentaje')->with('Porcentaje', 'Registro editado satisfactoriamente !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    public function storeAjax(Request $request)
    {
        //dump($request);
        $rules = array(
            'porcentaje'     =>   'required|unique:porcentaje'
            
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        $form_data = array(
            'porcentaje'   =>  $request->porcentaje,
            'estado'    => 'Activo'
        );

        Porcentaje::create($form_data);
        $porcentaje = Porcentaje::orderBy('idPorcentaje', 'desc')->first();

               return response()->json([
                'success' => 'Porcentaje Agregado Satisfactoriamente !!!', 
                'porcentaje' => $porcentaje
        ]);
        //   echo $output;
    }

    function fetchAjax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('porcentaje')
                ->where('porcentaje', 'LIKE', "%{$query}%")
                ->where('estado', '=', 'Activo')
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {
                    $output .= '
       <li><a href="#"> ' . $row->idPorcentaje . '      ' . $row->porcentaje . '</a></li>
       ';
                }
                $output .= '</ul>';
                echo $output;
            } else {
                // echo $output = //'<div style="display:block; position:absolute">NO HAY CONINCIDENCIAS REGISTRADAS </div>';
                echo $output = '<a href="#" style="color:#FF0000; position:absolute; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
            }
        }
    }

}
