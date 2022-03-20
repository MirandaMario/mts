<?php

namespace App\Http\Controllers;

use App\Control;
use App\Http\Requests\ControldefacturaFormRequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ComprobanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $data = ["controldefactura" => Control::findOrFail($id)];
        return view('controldefactura.edit', $data);
    }

    public function update(ControldefacturaFormRequest $request, $id)
    {
        $controldefactura = control::findOrFail($id);
        $controldefactura->serie = $request->get('serie');
        $controldefactura->correlativo = $request->get('correlativo');
        $controldefactura->resolución = $request->get('resolución');
        $controldefactura->rango = $request->get('rango');
        $controldefactura->fecha = $request->get('fecha');

        $controldefactura->update();
        return Redirect::to('controldefactura');
    }

    public function index(Request $request)
    {
        $control = DB::table('control_factura')->get();
        return view('controldefactura.index')->with('control', $control);
    }
}
