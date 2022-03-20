<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorFormRequest;
use App\Persona;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $personas = DB::table('persona')
            ->where('tipo_persona', '=', 'Proveedor')
            ->orderBy('idpersona', 'desc')
            ->get();

        $data = [
            "personas" => $personas
        ];

        return view('compras.proveedor.index', $data);

    }

    public function create()
    {
        $departamentos = DB::table('depsv')->get();
        return view("compras.proveedor.form", compact('departamentos'));
    }

    public function store(ProveedorFormRequest $request)
    {
        $persona = new Persona;
        $persona->tipo_persona = 'Proveedor';
        $persona->nombre = $request->get('nombre');
        $persona->direccion = $request->get('direccion');
        $persona->alias = $request->get('alias');
        $persona->giro = $request->get('giro');
        $persona->dui = $request->get('dui');
        $persona->nit = $request->get('nit');
        $persona->iva = $request->get('iva');
        $persona->forma_pago = $request->get('forma_pago');
        $persona->municipio = $request->get('id_municipio');
        $persona->tipo_contribuyente = $request->get('tipo_contribuyente');

        $persona->contacto = $request->get('contacto');
        $persona->tel = $request->get('tel');
        $persona->email = $request->get('email');

        $persona->contacto2 = $request->get('contacto2');
        $persona->tel2 = $request->get('tel2');
        $persona->email2 = $request->get('email2');

        $persona->contacto3 = $request->get('contacto3');
        $persona->tel3 = $request->get('tel3');
        $persona->email3 = $request->get('email3');

        $persona->estado = $request->get('estado');

        $persona->save();
        return Redirect::to('proveedor')->with('success', 'Registro ingresado satisfactoriamente !');
    }

    public function show($id)
    {
        $departamentos = DB::table('depsv')->get();
        $persona = Persona::leftjoin('munsv as m', 'municipio', '=', 'm.ID')
            ->leftjoin('depsv as d', 'm.DEPSV_ID', '=', 'd.ID')
            ->select('d.ID as id_dep', 'm.ID as id_mun', 'DepName', 'MunName', 'nombre', 'tipo_persona', 'alias', 'contacto', 'contacto2', 'contacto3', 'idpersona', 'tipo_persona',
                'tel', 'tel2', 'tel3', 'email', 'email2', 'email3', 'nit', 'iva', 'giro', 'dui', 'direccion', 'estado', 'forma_pago', 'tipo_contribuyente', 'municipio')
            ->findOrFail($id);

        $data = ["persona" => $persona,
            "departamentos" => $departamentos];

        return view('compras.proveedor.show', $data);
    }

    public function edit($id)
    {

        $departamentos = DB::table('depsv')->get();
        $persona = Persona::leftjoin('munsv as m', 'municipio', '=', 'm.ID')
            ->leftjoin('depsv as d', 'm.DEPSV_ID', '=', 'd.ID')
            ->select('d.ID as id_dep', 'm.ID as id_mun', 'DepName', 'MunName', 'nombre', 'tipo_persona', 'alias', 'contacto', 'contacto2', 'contacto3', 'idpersona', 'tipo_persona',
                'tel', 'tel2', 'tel3', 'email', 'email2', 'email3', 'nit', 'iva', 'giro', 'dui', 'direccion', 'estado', 'forma_pago', 'tipo_contribuyente', 'municipio')
            ->findOrFail($id);

        $data = ["persona" => $persona,
            "departamentos" => $departamentos];
        return view('compras.proveedor.form', $data);
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);

        $persona->nombre = $request->get('nombre');
        $persona->direccion = $request->get('direccion');
        $persona->alias = $request->get('alias');
        $persona->giro = $request->get('giro');
        $persona->dui = $request->get('dui');
        $persona->nit = $request->get('nit');
        $persona->iva = $request->get('iva');
        $persona->forma_pago = $request->get('forma_pago');
        $persona->municipio = $request->get('id_municipio');
        $persona->tipo_contribuyente = $request->get('tipo_contribuyente');
        $persona->municipio = $request->get('id_municipio');

        $persona->contacto = $request->get('contacto');
        $persona->tel = $request->get('tel');
        $persona->email = $request->get('email');

        $persona->contacto2 = $request->get('contacto2');
        $persona->tel2 = $request->get('tel2');
        $persona->email2 = $request->get('email2');

        $persona->contacto3 = $request->get('contacto3');
        $persona->tel3 = $request->get('tel3');
        $persona->email3 = $request->get('email3');

        $persona->estado = $request->get('estado');

        $persona->update();
        return Redirect::to('proveedor')->with('info', 'Registro editado satisfactoriamente !');

    }

    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);
        $persona->estado = "Inactivo";
        $persona->update();
        return Redirect::to('proveedor')->with('warning', 'Registro dado de baja !!!');
    }

    public function storeAjax(Request $request)
    {

        $rules = array(

            'nombre' => 'required|unique:persona',
            'alias' => 'unique:persona',

        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nombre' => $request->nombre,
            'alias' => $request->alias,
            'tipo_persona' => 'Proveedor',
            'estado' => 'Activo',
        );

        Persona::create($form_data);

        return response()->json([
            'success' => 'Proveedor agregado satisfactoriamente !!!',

        ]);

    }
}
