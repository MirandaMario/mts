<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonaFormRequest;
use App\Http\Requests\PersonaLocalFormRequest;
use Validator;
use DB;
use App\Persona;
use Illuminate\Support\Facades\Redirect;



class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
     
            $id = $request->get('idcliente');
            $nombre = $request->get('cliente');
            $numero = $request->get('numero');

                

            if ($numero > 0 || $id > 0  || $nombre != null) {

                $nombre == null ? $nombre = 'xxxxxxx' : ''; 
                $numero == null ? $numero =  9999999 : '';
                $personas = DB::table('persona')
                
                
                ->where(function ($query2) use ($numero) {
                    $query2->orwhere('tel', 'LIKE', '%'. $numero . '%');
                    $query2->orwhere('iva', 'LIKE', '%'. $numero . '%');
                    $query2->orwhere('nit', 'LIKE', '%'. $numero . '%');
                })
                ->orwhere('idpersona' ,  $id)
                ->orwhere('nombre', 'LIKE',   $nombre . '%') 


                ->orderBy('idpersona','desc')->get();
                          
            }else{
                $personas = DB::table('persona')->orderBy('idpersona','desc')->take(10)->get();
            } 

            $data = ["personas" => $personas];
            return view('ventas.cliente.index',$data);
    }

    public function create(){
        $departamentos = DB::table('depsv')->get();
        return view("ventas.cliente.form", compact('departamentos'));
    }

    public function store(PersonaLocalFormRequest $request){
       
        $persona = new Persona;
        $persona->tipo_persona = 'Cliente';
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
        $persona->estado = 'Activo';

        $persona->save();
        return Redirect::to('cliente')->with('success','Registro ingresado satisfactoriamente !');
    }

    public function show($id){

        $departamentos = DB::table('depsv')->get();
        $persona=Persona::leftjoin('munsv as m', 'municipio', '=', 'm.ID' )
        ->leftjoin('depsv as d', 'm.DEPSV_ID', '=', 'd.ID')
        ->select('d.ID as id_dep','m.ID as id_mun', 'DepName', 'MunName', 'nombre', 'tipo_persona','alias', 'contacto', 'contacto2', 'contacto3', 'idpersona', 'tipo_persona',
                'tel', 'tel2', 'tel3', 'email', 'email2', 'email3', 'nit', 'iva', 'giro', 'dui', 'direccion', 'estado', 'forma_pago', 'tipo_contribuyente', 'municipio' )
        ->findOrFail($id);

         $data = [ "persona" => $persona, 
                  "departamentos" => $departamentos];

        return view('ventas.cliente.show',$data);
    }

    public function edit($id){
        $departamentos = DB::table('depsv')->get();
        $persona=Persona::leftjoin('munsv as m', 'municipio', '=', 'm.ID' )
        ->leftjoin('depsv as d', 'm.DEPSV_ID', '=', 'd.ID')
        ->select('d.ID as id_dep','m.ID as id_mun', 'DepName', 'MunName', 'nombre', 'tipo_persona','alias', 'contacto', 'contacto2', 'contacto3', 'idpersona', 'tipo_persona',
                'tel', 'tel2', 'tel3', 'email', 'email2', 'email3', 'nit', 'iva', 'giro', 'dui', 'direccion', 'estado', 'forma_pago', 'tipo_contribuyente', 'municipio' )
        ->findOrFail($id);

        $data = [ "persona" => $persona, 
                  "departamentos" => $departamentos];

       return view('ventas.cliente.form',$data);
    }

    public function update(Request $request,$id){
        
        $persona = Persona::findOrFail($id);
        $persona->nombre = $request->get('nombre');
        $persona->direccion = $request->get('direccion');
        $persona->alias = $request->get('alias');
        $persona->giro = $request->get('giro');
        $persona->dui = $request->get('dui');
        $persona->nit = $request->get('nit');
        $persona->iva = $request->get('iva');
        $persona->forma_pago = $request->get('forma_pago');
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
        return Redirect::to('cliente')->with('info','Registro editado satisfactoriamente !');
    }

    public function destroy($id){
        $persona = Persona::findOrFail($id);
        $persona->estado = "Inactivo";
        $persona->update();
        return Redirect::to('cliente')->with('warning','Registro dado de baja !!!');
    }

   public function storeAjax(Request $request)
    {  // dd( $request); 
      //  $vnit = $request->get('nit');
       /*  if($vnit != null)
        {
            $rules = array(
            'nombre'    =>  'required|unique:persona'
            );
        }else{
            $rules = array(
            'nombre'    =>  'required|unique:persona'
            );
        } */
        $rules = array(
            'nombre'    =>  'required|unique:persona'
            );
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nombre'   =>  $request->nombre,
            'direccion'   =>  $request->direccion,
            'tel'   =>  $request->tel,
            'municipio'   =>  $request->municipio, 
            'giro'   =>  $request->giro,
            'iva'   =>  $request->iva,
            'nit'   =>  $request->nit,
            'dui'   =>  $request->dui,
            'email'   =>  $request->email,
            'tipo_persona' => 'cliente',
            'estado'    => 'Activo'
        );

        Persona::create($form_data);
        return response()->json([ 'success' => 'Cliente agregado satisfactoriamente !!!' ]);
    }

    public function puntos($id){
        
        $compras = DB::table('venta as v')
        ->join('detalle_venta  as dv', 'v.idventa', '=', 'dv.idventa')
        ->select('num_comprobante', 'fecha_hora', 'total_venta', DB::raw('SUM(puntos) as puntos'))
        ->where('idcliente', $id )
        ->groupby('num_comprobante')
        ->get(); 

        $data = [
            "compras" => $compras
        ];
        return view('ventas.cliente.puntos', $data);
    }
}