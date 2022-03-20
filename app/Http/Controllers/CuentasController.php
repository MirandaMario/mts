<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cuenta; 
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Http\Requests\CuentaFormRequest;



class CuentasController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {

        $cuentas=DB::table('cuentas')
        ->get(); // get sirve para todos los tados de la tabla
        $data=["cuentas" => $cuentas];
        //dd($data) sirve para ver los datos que vienen en el array y el array son los [];
        return view('cuenta.index', $data);
    }


    public function create()
    {
        return view('cuenta.create');
    }
     //   $mytime = Carbon::now('America/El_Salvador');
     //   $cuenta->fechaCreacion = $mytime->toDateTimeString();
   
    public function store(CuentaFormRequest $request)
    {
       //dd($request);
       
        $cuenta = new Cuenta;
        $cuenta->banco = $request->get('banco');
        $cuenta->tipoCuenta = $request->get('tipoCuenta');
        $cuenta->nombreCuenta = $request->get('nombreCuenta');
        $cuenta->numeroCuenta = $request->get('numeroCuenta');

      
        $mytime = Carbon::now('America/El_Salvador');
        $cuenta->fechaCreacion = $mytime->toDateTimeString();
        $cuenta->estado = 'Activo'; 
        $cuenta->save();

      

        return Redirect::to('cuenta');  
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {  
        $data = ["cuenta"=>Cuenta::findOrFail($id)];
        return view('cuenta.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $cuenta = Cuenta::findOrFail($id);
      //  $cuenta = new Cuenta;
        $cuenta->banco = $request->get('banco');
        $cuenta->idCuentaOrigen  = $request->get('idCuentaOrigen');
        $cuenta->tipoCuenta = $request->get('tipoCuenta');
        $cuenta->nombreCuenta = $request->get('nombreCuenta');
        $cuenta->numeroCuenta = $request->get('numeroCuenta');
        $cuenta->saldo = $request->get('saldo');
        $cuenta->estado = 'Activo'; 
        
        $cuenta->update();
        return Redirect::to('cuenta');  
    }

   
    public function destroy($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $cuenta->estado = "Inactivo";
        $cuenta->update();
        return Redirect::to('cuenta');
    }
}