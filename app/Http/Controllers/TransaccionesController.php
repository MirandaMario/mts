<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Transacciones;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransaccionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cheques = DB::table('cuentas as c')
            ->join('transacciones as tr', 'c.id', '=', 'tr.idCuenta')
            ->join('persona as p', 'p.idpersona', '=', 'tr.idPersona')
            ->select('tr.id', 'p.nombre', 'c.nombreCuenta', 'tr.valorIngreso', 'tr.valorLiquido', 'tr.renta', 'tr.comprobante', 'tr.fecha', 'banco', 'tipoCuenta', 'nombreCuenta', 'numeroCuenta', 'c.numeroCheque', 'tr.estado', 'tr.conceptog', 'tr.concepto', 'tr.tipoMov')
            ->orderBy('id', 'desc')
            ->take(500)
            ->get();

        $data = [
            "cheques" => $cheques,
        ];

        return view('transaccion.index', $data);
    }


    public function create()
    {
        $cuentas=DB::table('cuentas')->get(); 
        $data=["cuentas" => $cuentas];
        return view('transaccion.create2', $data);
    }

    public function store(Request $request)
    {
        //  dd($request);
        try {
            DB::beginTransaction();
            $tr = new Transacciones;

            $tr->idCuenta = $request->get('idBanco');
            $tr->idPersona = $request->get('idPersona');
            $tr->conceptog = $request->get('conceptog');
            $tr->concepto = $request->get('concepto');
            $tr->valorNominal = $request->get('valorNominal');
            $tr->renta = $request->get('renta');
            $tr->valorRenta = $request->get('valorRenta');
            $tr->montoRenta = $request->get('montoRenta');
            // $tr-> = $request->get('check_in');

            //
            $tr->valorLiquido = ($request->get('valorLiquido') === null) ? 0.00 : $request->get('valorLiquido');
            $tr->descuentos = $request->get('otrosDescuentos');
            $tr->numeroCheque = $request->get('numeroCheque');
            $tr->serieCheque = $request->get('serieCheque');
            $tr->fecha = $request->get('fecha');

            $tr->tipoMov = $request->get('tipoMov');
            $tr->numeroRemesa = $request->get('numeroRemesa');
            $tr->valorIngreso = $request->get('valorIngreso');
            $tr->acuerdo = $request->get('acuerdo');
            $tr->acta = $request->get('acta');
            $tr->fechaac = $request->get('fechaac');

            if ($request->get('tipo') === 'PRESUPUESTO') {

            } else {
                $tr->estado = 'Activo';
            }

            $cuenta = Cuenta::findOrFail($request->get('idBanco'));

            if ($request->get('tipoMov') === 'INGRESO') {
                # code...
                $cuenta->saldo += $request->get('valorIngreso');
                $cuenta->update();
            } else {

                $cuenta->saldo -= $request->get('valorLiquido');
                $cuenta->update();
            }

            //  dd($tr);
            $tr->save();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }

        if ($request->get('tipo') === 'PRESUPUESTO') {
            return Redirect::to('presupuesto');
        } else {
            return Redirect::to('transaccion');
        }

    }

    public function show($id)
    {
        $cuentas=DB::table('cuentas')->get(); 
        $data=["cuentas" => $cuentas];   
        return view('transaccion.show', $data);
    }

    public function reporte(Request $request)
    {
        $query = $request->get('fecha');
        $query2 = $request->get('fecha2') . (' 23:59');
        $query3 = $request->get('tipo_comprobante');
        $banco = $request->get('idBanco');
        $remesas = DB::table('cuentas as c')
            ->join('transacciones as tr', 'c.id', '=', 'tr.idCuenta')
            ->join('persona as p', 'p.idpersona', '=', 'tr.idPersona')
            ->select('tr.id', 'p.nombre', 'c.nombreCuenta', 'tr.valorIngreso', 'tr.valorLiquido', 'tr.renta', 'tr.comprobante', 'tr.fecha', 'banco', 'tipoCuenta', 'nombreCuenta', 'numeroCuenta', 'c.numeroCheque', 'tr.estado', 'tr.conceptog', 'tr.concepto', 'tr.tipoMov')
            ->where('c.id', 'LIKE', "%{$banco}")
            ->whereBetween('fecha', [$query, $query2])
            ->orderBy('fecha', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    
            $data = [
                "remesas" => $remesas,
                "request" => $request,
            ];    
            return view('transaccion.reporte', $data) ; 
       
    }

    public function edit($id)
    {
        $cuentas=DB::table('cuentas')->get(); 
        $transaccion = Transacciones::findOrFail($id);
        $cuenta = DB::table('cuentas')->where('id', '=', $transaccion->idCuenta)->first();
        $persona = DB::table('persona')->where('idPersona', '=', $transaccion->idPersona)->first();

        $data = [
            "transaccion" => $transaccion,
            "cuenta" => $cuenta,
            "persona" => $persona,
            "cuentas" => $cuentas
        ];
       
        return view('transaccion.edit2', $data);
    }

    public function update(Request $request, $id)
    {
       // dd($request); 
        try {
            DB::beginTransaction();
            $tr = Transacciones::findOrFail($id);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/imagenes/', $name);
                //  dd ($name);
                $tr->comprobante = $name;
            }

            $tr->idCuenta = $request->get('idBanco');
            $tr->idPersona = $request->get('idPersona');
            $tr->conceptog = $request->get('conceptog');
            $tr->concepto = $request->get('concepto');
            $tr->valorNominal = $request->get('valorNominal');
            $tr->renta = $request->get('renta');
            $tr->fecha = $request->get('check_in');
            $tr->valorRenta = $request->get('valorRenta');
            $tr->montoRenta = $request->get('montoRenta');
            $tr->numeroCheque = $request->get('numeroCheque');
            $tr->serieCheque = $request->get('serieCheque');
            $tr->descuentos = $request->get('otrosDescuentos');
            $tr->numeroRemesa = $request->get('numeroRemesa');
            $tr->valorIngreso = $request->get('valorIngreso');
            $tr->valorLiquido = ($request->get('valorLiquido') === null) ? 0.00 : $request->get('valorLiquido');
            $tr->estado = $request->get('estado');
            $tr->acuerdo = $request->get('acuerdo');
            $tr->acta = $request->get('acta');
            $tr->fechaac = $request->get('fechaac');

            $tr->update();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('transaccion')/* ->with('success', 'Transaccion actualizada correctamente !!!') */;
        
    }

    

    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('persona')
                ->where('nombre', 'LIKE', "%{$query}%")
                ->where('tipo_persona', '=', 'Cliente')
                ->where('estado', '=', 'Activo')
                ->orwhere('tipo_persona', '=', 'Ambos')
                ->take(10)
                ->get();
                if (!$data->isEmpty()) {     
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            foreach ($data as $row) {
                $output .= '
       <li><a href="#"> ' . $row->idpersona . '      ' . $row->nombre . '      ' . $row->dui . '      ' . $row->nit . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }else {
            echo $output = '<a href="#" style="color:#FF0000; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
        }
    }

    }

    public function fetch2(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('cuentas as c')
                ->where('c.numeroCuenta', 'LIKE', "%{$query}")
                ->orWhere('c.nombreCuenta', 'LIKE', "%{$query}%")
                ->where('c.estado', '=', 'Activo')
                ->take(10)
                ->get();
                if (!$data->isEmpty()) {     
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            foreach ($data as $row) {
                $output .= '
       <li><a href="#"> ' . $row->id . '      ' . $row->nombreCuenta . '      ' . $row->banco . '      ' . $row->numeroCuenta
                    . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }else {
            echo $output = '<a href="#" style="color:#FF0000; ">NO HAY CONINCIDENCIAS REGISTRADAS </a>';
        }
    
    }

    }

    public function fetch3(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('transacciones')
                ->select(DB::raw('sum(valorIngreso) - sum(valorLiquido) as total'))
                ->where('idCuenta', '=', $query)
                ->where('estado', '=', 'Activo')
                ->get();

            foreach ($data as $row) {
                $output = '' . $row->total . '';
            }

            echo $output;
        }

    }

}