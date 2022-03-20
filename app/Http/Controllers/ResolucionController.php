<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\Resolucion;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;


class ResolucionController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query = trim($request->get('searchText'));
            $resoluciones = DB::table('resolucion')->orderBy('id_resolucion','desc')->get();
            $tiendas = DB::table('tienda')->where('estado',1)->get();
     

            $data = [
                "resoluciones" => $resoluciones, 
                "tiendas" => $tiendas
            ];

           return view('resolucion.index',$data);
        }
    }



    public function storeAjax(Request $request)
    {
        $rules = array(
         'numero_resolucion'    =>  'required|unique:resolucion'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $resoluciones = DB::table('resolucion')
        ->where('tienda_res', $request->tienda_res)
        ->where('tipo_documento', $request->tipo_documento)
        ->orderBy('id_resolucion','desc')
        ->first();

        if ($resoluciones == null) {
            $form_data = array(
                'tipo_documento'     =>  $request->tipo_documento,
                'rango_desde'        =>  $request->rango_desde, 
                'rango_hasta'        =>  $request->rango_hasta, 
                'fecha_resolucion'   =>  $request->fecha_resolucion, 
                'numero_resolucion'  =>  $request->numero_resolucion, 
                'serie_resolucion'   =>  $request->serie_resolucion, 
                'estado_res'         =>  $request->estado_res, 
                'tienda_res'         =>  $request->tienda_res           
            );
        } else if($request->estado_res == 1){

            $form_data = array(
                'tipo_documento'     =>  $request->tipo_documento,
                'rango_desde'        =>  $request->rango_desde, 
                'rango_hasta'        =>  $request->rango_hasta, 
                'fecha_resolucion'   =>  $request->fecha_resolucion, 
                'numero_resolucion'  =>  $request->numero_resolucion, 
                'serie_resolucion'  =>  $request->serie_resolucion, 
                'estado_res'         =>  $request->estado_res, 
                'tienda_res'         =>  $request->tienda_res           
            );

            $resolucion = Resolucion::findOrFail($resoluciones->id_resolucion);
            $resolucion->estado_res = 0; 
            $resolucion->update(); 


        } else {
            
            $form_data = array(
                'tipo_documento'     =>  $request->tipo_documento,
                'rango_desde'        =>  $request->rango_desde, 
                'rango_hasta'        =>  $request->rango_hasta, 
                'fecha_resolucion'   =>  $request->fecha_resolucion, 
                'numero_resolucion'  =>  $request->numero_resolucion, 
                'serie_resolucion'  =>  $request->serie_resolucion, 
                'estado_res'         =>  $request->estado_res, 
                'tienda_res'         =>  $request->tienda_res           
            );
        }
        
        Resolucion::create($form_data);
        return response()->json(['success' => 'Resolucion Agregada Satisfactoriamente !!!']);
    }


    public function edit($id){

        $tiendas = DB::table('tienda')->where('estado',1)->get();
        $resoluciones = Resolucion::findOrFail($id); 

        $data = [ "resolucion"=> $resoluciones, 
                  "tiendas"=>$tiendas ]; 

        return view('resolucion.edit',$data);
    }

    public function update(Request $request,$id){
        //dd($request); 
        $resoluciones = DB::table('resolucion')
        ->where('tienda_res', $request->tienda_res)
        ->where('tipo_documento', $request->tipo_documento)
        ->orderBy('id_resolucion','desc')
        ->first(); 

        if ($resoluciones == null) {

            $resolucion = Resolucion::findOrFail($id);
            $resolucion->tipo_documento    = $request->get('tipo_documento');
            $resolucion->rango_desde       = $request->get('rango_desde');
            $resolucion->rango_hasta       = $request->get('rango_hasta');
            $resolucion->fecha_resolucion  = $request->get('fecha_resolucion');
            $resolucion->numero_resolucion = $request->get('numero_resolucion');
            $resolucion->serie_resolucion  = $request->get('serie_resolucion');
            $resolucion->estado_res        = $request->get('estado_res');
            $resolucion->tienda_res        = $request->get('tienda_res');
            $resolucion->update();

        } else if($request->estado_res == 1){

            $resolucion = Resolucion::findOrFail($id);
            $resolucion->tipo_documento    = $request->get('tipo_documento');
            $resolucion->rango_desde       = $request->get('rango_desde');
            $resolucion->rango_hasta       = $request->get('rango_hasta');
            $resolucion->fecha_resolucion  = $request->get('fecha_resolucion');
            $resolucion->numero_resolucion = $request->get('numero_resolucion');
            $resolucion->serie_resolucion  = $request->get('serie_resolucion');
            $resolucion->estado_res        = $request->get('estado_res');
            $resolucion->tienda_res        = $request->get('tienda_res');
            $resolucion->update();

            $resolucion = Resolucion::findOrFail($resoluciones->id_resolucion);
            $resolucion->estado_res = 1; 
            $resolucion->update();

        } else {   
                   
        }    

        return Redirect::to('resolucion')->with('info','Registro editado satisfactoriamente!');
    }

}
