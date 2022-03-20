<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\Marca;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use GuzzleHttp\Psr7\Response;

class MarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $marcas = DB::table('marca') //->where('nombre','LIKE','%'.$query.'%')
                //  ->where('condicion','=','1')
                // ->orderBy('idMarca','DES')
                // ->paginate(5);
                ->get();

            $categorias = DB::table('categoria')->where('nombreCategoria', 'LIKE', '%' . $query . '%')
                //   ->if('condicion','=','1' )
                ->orderBy('idcategoria', 'desc')
                ->get();

            $data = [
                "marcas" => $marcas,
                "searchText" => $query,
                "categorias" => $categorias
            ];

            return view('almacen.marca.index', $data);
        }
    }

    public function create()
    {
        return view("almacen.marca.create");
    }

    public function store(Request $request)
    {

        //  dd($request);

        $marca = new Marca;
        $marca->nombre = $request->get('nombre');
        $marca->estado = 'Activo';

        $marca->save();
        return Redirect::to('marca')->with('success', 'Registro ingresado satisfactoriamente !');
    }

    public function show($id)
    {
        $data = ["categoria" => Categoria::findOrFail($id)];
        return view('almacen.categoria.show', $data);
    }

    public function edit($id)
    {
        $data = ["marca" => Marca::findOrFail($id)];
        return view('almacen.marca.edit', $data);
    }

    public function update(Request $request, $id)
    {   //dd($id); 
        $marca = Marca::findOrFail($id);
        $marca->nombreMarca = $request->get('nombreMarca');
        $marca->estado = 'Activo';

        $img_original1 = $request->get('img_original1');

        if (Input::hasFile('imagen1')) {
            $mi_imagen1 = public_path() . '/imagenes/logos/' . $img_original1;
            if (@getimagesize($mi_imagen1)) {
                $image_path = public_path() . '/imagenes/logos/' . $img_original1;
                unlink($image_path);
            }

            $file = Input::file('imagen1');
            $file->move(public_path() . '/imagenes/logos/', time() . $file->getClientOriginalName());
            $marca->logo = time() . $file->getClientOriginalName();
        }

        $marca->update();
        return Redirect::to('marca')->with('info', 'Registro editado satisfactoriamente !');
    }

    public function destroy($id)
    {
        //  $categoria = Categoria::findOrFail($id);
        //  $categoria->condicion = "0";
        //  $categoria->update();
        $marca = Marca::findOrFail($id);
        $marca->estado = 'Inactivo';
        $marca->update();
        return Redirect::to('marca')->with('warning', 'Registro dado de baja !!!');
    }


    public function storeAjax(Request $request)
    {
        //dump($request);
        $rules = array(
            'nombreMarca'     =>   'required|unique:marca'
            // 'nombre'  =>  'unique:marca'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        $form_data = array(
            'nombreMarca'   =>  $request->nombreMarca,
            'estado'    => 'Activo'
        );

        Marca::create($form_data);

         $marcas = DB::table('marca')->orderBy('nombreMarca')->get();

        // return response()->json($marcas);
        //      return Response::json($marcas);
        return response()->json([
            'success' => 'Marca Agregada Satisfactoriamente !!!', 
           'marcas' => $marcas
        ]);
        //   echo $output;
    }



    function fetchAjax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('marca')
                ->where('nombreMarca', 'LIKE', "%{$query}%")
                ->where('estado', '=', 'Activo')
                //->orwhere('tipo_persona','=','Ambos')
                //->take(10)
                ->get();

            if (!$data->isEmpty()) {
                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                foreach ($data as $row) {
                    $output .= '
       <li><a href="#"> ' . $row->idMarca . '      ' . $row->nombreMarca . '</a></li>
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
