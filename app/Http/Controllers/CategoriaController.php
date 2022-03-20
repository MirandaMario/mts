<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;


class CategoriaController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query = trim($request->get('searchText'));
            $categorias = DB::table('categoria')->where('nombreCategoria','LIKE','%'.$query.'%')
         //   ->if('condicion','=','1' )
            ->orderBy('idcategoria','desc')
            ->get();
          //  ->paginate(5);

            $data = [
                "categorias" => $categorias,
                "searchText" => $query
            ];

           return view('almacen.categoria.index',$data);
        }
    }

    public function create(){
        return view("almacen.categoria.create");
    }

    public function store(CategoriaFormRequest $request){
        $categoria = new Categoria;
        $categoria->nombreCategoria = $request->get('nombre');
        $categoria->descuento_cat = 0;
        $categoria->condicion = 'Activo';
        $categoria->save();
        return Redirect::to('categoria')->with('success','Registro ingresado satisfactoriamente !');


    }

    public function show($id){
        $data = ["categoria"=>Categoria::findOrFail($id)];
        return view('almacen.categoria.show',$data);
    }

    public function edit($id){
        $data = ["categoria"=>Categoria::findOrFail($id)];
       // dd($data); 
        return view('almacen.categoria.edit',$data);
    }

    public function update(Request $request,$id){
        //dd($request); 
        $cslug = Str::slug($request->get('cslug'), '-');
        $categoria = Categoria::findOrFail($id);
        $categoria->nombreCategoria = $request->get('nombreCategoria');
        $categoria->descuento_cat = $request->get('descuento_cat');
        $categoria->ctexto =  $request->get('ctexto');
        $categoria->ckeyword =  $request->get('ckeyword');
        $categoria->cdescripcion =  $request->get('cdescripcion');
        $categoria->ch1 =  $request->get('ch1');
        $categoria->ch2 =  $request->get('ch2');
        $categoria->condicion = 'Activo';
        $categoria->cslug = $cslug; 

        $img_original1 = $request->get('img_original1');

        if (Input::hasFile('escritorio')) {
            $mi_imagen1 = public_path() . '/imagenes/categorias/' . $img_original1;
            if (@getimagesize($mi_imagen1)) {
                $image_path = public_path() . '/imagenes/categorias/' . $img_original1;
                unlink($image_path);
            }

            $file = Input::file('escritorio');
            $file->move(public_path() . '/imagenes/categorias/', time() . $file->getClientOriginalName());
            $categoria->escritorio = time() . $file->getClientOriginalName();
        }

        $img_original2 = $request->get('img_original2');

        if (Input::hasFile('movil')) {
            $mi_imagen2 = public_path() . '/imagenes/categorias/' . $img_original2;
            if (@getimagesize($mi_imagen2)) {
                $image_path = public_path() . '/imagenes/categorias/' . $img_original2;
                unlink($image_path);
            }

            $file = Input::file('movil');
            $file->move(public_path() . '/imagenes/categorias/', time() . $file->getClientOriginalName());
            $categoria->movil = time() . $file->getClientOriginalName();
        }

        $categoria->update();

        return Redirect::to('categoria')->with('info','Registro editado satisfactoriamente!');
    }

    public function destroy($id){
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = "Inactivo";
        $categoria->update();
        return Redirect::to('categoria')->with('warning','Registro dado de baja !!!');
    }

    public function storeAjax(Request $request)
    {
        $rules = array(
            'nombreCategoria'    =>  'required|unique:categoria'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nombreCategoria'   =>  $request->nombreCategoria,
            'descuento_cat'   =>  0,
            'condicion'    => 'Activo'
        );

        Categoria::create($form_data);

        $categorias = DB::table('categoria')->where('condicion' , '=', 'Activo')->orderBy('nombreCategoria')->get();

       return response()->json([
           'success' => 'Categoría Agregada Satisfactoriamente !!!',
            'categorias' => $categorias
             ]);
    }



}
