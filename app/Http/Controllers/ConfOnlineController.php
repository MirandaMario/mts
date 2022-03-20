<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Configuracion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class ConfOnlineController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('confonline.index');
    }

  
    public function create(Request $request){
        
        $id = $request->get('id'); 
        if ($id == 1){
            $confonline = DB::table('configuracion')->first();
            $categorias = DB::table('categoria')->orderBy('nombreCategoria')->where('condicion', '=', 'Activo')->get();
            $data = ["confonline" => $confonline, 
                     "categorias" => $categorias];
            return view('confonline.edit', $data);
        }
    }


    public function update(Request $request, $id)
    {
        $conf = Configuracion::findOrFail($id);
        $conf->envios = $request->get('envios');
        $conf->terminos = $request->get('terminos');
        $conf->url = $request->get('url');
        $conf->url2 = $request->get('url2');
        $conf->url3 = $request->get('url3');



//imagen carrucel PC 


        $img_original4 = $request->get('img_original4');

        if (Input::hasFile('imagen4')) {
            $ruta_imagen_original = public_path() . '/imagenes/carrusel/' . $img_original4;
            if (@getimagesize($ruta_imagen_original)) {
                unlink($ruta_imagen_original);
            }

            $file = Input::file('imagen4');
            $file->move(public_path() . '/imagenes/carrusel/', time() . $file->getClientOriginalName());
            $conf->cimagen = time() . $file->getClientOriginalName();
        }


        $img_original5 = $request->get('img_original5');

        if (Input::hasFile('imagen5')) {
            $ruta_imagen_original = public_path() . '/imagenes/carrusel/' . $img_original5;
            if (@getimagesize($ruta_imagen_original)) {
                unlink($ruta_imagen_original);
            }

            $file = Input::file('imagen5');
            $file->move(public_path() . '/imagenes/carrusel/', time() . $file->getClientOriginalName());
            $conf->cimagen2 = time() . $file->getClientOriginalName();
        }


        $img_original6 = $request->get('img_original6');

        if (Input::hasFile('imagen6')) {
            $ruta_imagen_original = public_path() . '/imagenes/carrusel/' . $img_original6;
            if (@getimagesize($ruta_imagen_original)) {
                unlink($ruta_imagen_original);
            }

            $file = Input::file('imagen6');
            $file->move(public_path() . '/imagenes/carrusel/', time() . $file->getClientOriginalName());
            $conf->cimagen3 = time() . $file->getClientOriginalName();
        }


// MOVIL


        $img_original1 = $request->get('img_original1');

        if (Input::hasFile('imagen1')) {
            $ruta_imagen_original = public_path() . '/imagenes/carrusel/' . $img_original1;
            if (@getimagesize($ruta_imagen_original)) {
                unlink($ruta_imagen_original);
            }

            $file = Input::file('imagen1');
            $file->move(public_path() . '/imagenes/carrusel/', time() . $file->getClientOriginalName());
            $conf->ct = time() . $file->getClientOriginalName();
        }


        $img_original2 = $request->get('img_original2');

        if (Input::hasFile('imagen2')) {
            $mi_imagen2 = public_path() . '/imagenes/carrusel/' . $img_original2;
            if (@getimagesize($mi_imagen2)) {
                $image_path = public_path() . '/imagenes/carrusel/' . $img_original2;
                unlink($image_path);
            }

            $file = Input::file('imagen2');
            $file->move(public_path() . '/imagenes/carrusel/', time() . $file->getClientOriginalName());
            $conf->ct2 = time() . $file->getClientOriginalName();
        }

        $img_original3 = $request->get('img_original3');

        if (Input::hasFile('imagen3')) {
            $mi_imagen3 = public_path() . '/imagenes/carrusel/' . $img_original3;
            if (@getimagesize($mi_imagen3)) {
                $image_path = public_path() . '/imagenes/carrusel/' . $img_original3;
                unlink($image_path);
            }

            $file = Input::file('imagen3');
            $file->move(public_path() . '/imagenes/carrusel/', time() . $file->getClientOriginalName());
            $conf->ct3 = time() . $file->getClientOriginalName();
        }

        $conf->update();
        return Redirect::to('confonline')->with('info', 'Registro editado satisfactoriamente !');

    }

}
