<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Requests\ExpedienteFormRequest;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use App\Expediente;

use Picqer;
use DB; 

class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expedientes = DB::table('expediente')->orderBy('id_expediente')->take(25)->get();
        $data = ["expedientes" =>  $expedientes];
        return view('expediente.index', $data);
    }


    public function create()
    {
        return view('expediente.form');
    }

    public function store(ExpedienteFormRequest $request) /* ExpedienteFormRequest */ 
    {   
        //dd($request); 

        $expediente = new Expediente;
        $expediente->numero_expediente = $request->get('numero_expediente');
        $expediente->id_paciente = $request->get('id_paciente');
        $expediente->id_cliente = $request->get('id_cliente');
        $expediente->habitacion = $request->get('habitacion');
        $expediente->fecha_hora_ex = $request->get('fecha_hora_ex');
        $expediente->tel_cliente = $request->get('tel_cliente');
        $expediente->tel_cliente2 = $request->get('tel_cliente2');
        $expediente->fecha_hora_ex = $request->get('fecha_hora_ex');
        
        $expediente->empresa = $request->get('empresa');
        $expediente->asegurado_principal = $request->get('asegurado_principal');
        $expediente->carnet = $request->get('carnet');
        $expediente->dependecia = $request->get('dependecia');
        $expediente->poliza = $request->get('poliza');
        $expediente->dx_ingreso = $request->get('dx_ingreso');
        $expediente->dx_codigo = $request->get('dx_codigo');
        $expediente->fomulario = $request->get('fomulario');
        $expediente->cargo_no_cub = $request->get('cargo_no_cub');
        $expediente->tipo_ing = $request->get('tipo_ing');
        $expediente->ing_por = $request->get('ing_por');
        $expediente->even_ing = $request->get('even_ing');

        $expediente->dr = $request->get('dr');
        $expediente->dr2 = $request->get('dr2');
        $expediente->dr3 = $request->get('dr3');
        $expediente->dr4 = $request->get('dr4');
        $expediente->dr5 = $request->get('dr5');
        $expediente->dr6 = $request->get('dr6');
        $expediente->dr7 = $request->get('dr7');

        $expediente->fecha_hora_alta = $request->get('fecha_hora_alta');
        $expediente->dx_egreso = $request->get('dx_egreso');
        $expediente->otros_diag = $request->get('otros_diag');
        $expediente->inter_qui = $request->get('inter_qui');
        $expediente->cond_egre = $request->get('cond_egre');
        $expediente->enf_resp = $request->get('enf_resp');
        $expediente->obs_egre = $request->get('obs_egre');
        $expediente->hora_far = $request->get('hora_far');
        $expediente->hora_tel = $request->get('hora_tel');
        $expediente->hora_caj = $request->get('hora_caj');
        $expediente->rec_paga = $request->get('rec_paga');

       // $expediente->estado = 'Activo';

        $expediente->save();
        return Redirect::to('expediente')->with('success','Registro ingresado satisfactoriamente !');
        
    }

    
    public function show($id)
    {
        /*  $data = ["expediente"=>Expediente::findOrFail($id)];
        return view('expediente.show',$data); */
        $expediente = Expediente::findOrFail($id); 
        $data = [
                "expediente" => $expediente
        ];
        //return view('expediente.show',$data); 
        $data = PDF::loadView('expediente.show', $data)->setPaper('letter');
        return $data->stream(); 
    }

   
    public function edit($id)
    {
         // dd($data); 
        $data = ["expediente"=>Expediente::findOrFail($id)];
         return view('expediente.form',$data);
    }

   
    public function update(Request $request, $id)
    {
        $expediente = Expediente::findOrFail($id);
        $expediente->numero_expediente = $request->get('numero_expediente');
        $expediente->id_paciente = $request->get('id_paciente');
        $expediente->id_cliente = $request->get('id_cliente');
        $expediente->tel_cliente = $request->get('tel_cliente');
        $expediente->tel_cliente2 = $request->get('tel_cliente2');
        $expediente->habitacion = $request->get('habitacion');
        $expediente->fecha_hora_ex = $request->get('fecha_hora_ex');
        
        $expediente->empresa = $request->get('empresa');
        $expediente->asegurado_principal = $request->get('asegurado_principal');
        $expediente->carnet = $request->get('carnet');
        $expediente->dependecia = $request->get('dependecia');
        $expediente->poliza = $request->get('poliza');
        $expediente->dx_ingreso = $request->get('dx_ingreso');
        $expediente->dx_codigo = $request->get('dx_codigo');
        $expediente->fomulario = $request->get('fomulario');
        $expediente->cargo_no_cub = $request->get('cargo_no_cub');
        $expediente->tipo_ing = $request->get('tipo_ing');
        $expediente->ing_por = $request->get('ing_por');
        $expediente->even_ing = $request->get('even_ing');

        $expediente->dr = $request->get('dr');
        $expediente->dr2 = $request->get('dr2');
        $expediente->dr3 = $request->get('dr3');
        $expediente->dr4 = $request->get('dr4');
        $expediente->dr5 = $request->get('dr5');
        $expediente->dr6 = $request->get('dr6');
        $expediente->dr7 = $request->get('dr7');

        $expediente->fecha_hora_alta = $request->get('fecha_hora_alta');
        $expediente->dx_egreso = $request->get('dx_egreso');
        $expediente->otros_diag = $request->get('otros_diag');
        $expediente->inter_qui = $request->get('inter_qui');
        $expediente->cond_egre = $request->get('cond_egre');
        $expediente->enf_resp = $request->get('enf_resp');
        $expediente->obs_egre = $request->get('obs_egre');
        $expediente->hora_far = $request->get('hora_far');
        $expediente->hora_tel = $request->get('hora_tel');
        $expediente->hora_caj = $request->get('hora_caj');
        $expediente->rec_paga = $request->get('rec_paga');

        //s$expediente->estado = 'Activo';


        $expediente->update();
        return Redirect::to('expediente')->with('info','Registro editado satisfactoriamente !');
    }

   
    public function destroy($id)
    {
        //
    }
}
