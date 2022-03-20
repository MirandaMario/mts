<?php

namespace App\Http\Controllers;

use App\DetalleTransferencia;
use App\Miscelanea;
use App\Transferencia;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransferenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $transferencias = DB::table('transferencia as t')
            ->select('t.id_transferencia', 'created_at', 'updated_at', 'id_origen', 'id_destino', 'estado', DB::raw('SUM(cantidad) as cantida'))
            ->join('detalle_transferencia as dt', 't.id_transferencia', '=', 'dt.id_transferencia')
            ->groupBy('t.id_transferencia')
            ->get();

        //  dd($transferencias);
        $tienda = DB::table('tienda')->where('estado', 1)->get();

        $data = ["tienda" => $tienda,
            "transferencias" => $transferencias];
        return view('transferencia.index', $data);

    }

    public function create(Request $request)
    {
        $varios = Miscelanea::first();
        $data = [
            "varios" => $varios,
            "request" => $request,
        ];
        return view('transferencia.create', $data);
    }

    public function store(Request $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $transferencia = new Transferencia;
            $transferencia->id_origen = $request->get('idtienda');
            $transferencia->id_destino = $request->get('idtienda2');
            $transferencia->estado = 1;
            $transferencia->save();

            $cantidad = $request->get('cantidad');
            $idarticulo = $request->get('idarticulo');

            $con = 0;

            while ($con < count($cantidad)) {
                $detalle = new DetalleTransferencia();
                $detalle->id_transferencia = $transferencia->id_transferencia;
                $detalle->idarticulo = $idarticulo[$con];
                $detalle->cantidad = $cantidad[$con];
                $detalle->origen = $transferencia->id_origen;
                $detalle->destino = $transferencia->id_destino;
                $detalle->save();
                $con++;
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }

        $varios = Miscelanea::first();
        $data = [
            "varios" => $varios,
            "request" => $request
        ];
        return view('transferencia.create', $data);
    }

    public function edit($id)
    {
        $varios = Miscelanea::first();

        $transferencia = DB::table('transferencia as t')
            ->where('t.id_transferencia', '=', $id)
            ->first();

        $detalles = DB::table('detalle_transferencia as dt')
            ->join('articulo as a', 'dt.idarticulo', '=', 'a.idarticulo')
            ->join('modelo as md', 'a.idModelo', '=', 'md.idModelo')
            ->join('marca as m', 'md.idMarca', '=', 'm.idMarca')
            ->where('id_transferencia', '=', $id)
            ->get();

        $data = [
            "varios" => $varios,
            "transferencia" => $transferencia,
            "detalles" => $detalles,
        ];

        return view('transferencia.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $transferencia = Transferencia::findOrFail($id);
            $idtransferencia = $transferencia->id_transferencia;
            $origen = $transferencia->id_origen;
            $destino = $transferencia->id_destino;

            DetalleTransferencia::where('id_transferencia', $idtransferencia)->delete();

            $cantidad = $request->get('cantidad');
            $idarticulo = $request->get('idarticulo');
            if($cantidad != null){
                $con = 0;
                while ($con < count($cantidad)) {
                    $detalle = new DetalleTransferencia();
                    $detalle->id_transferencia = $idtransferencia;
                    $detalle->idarticulo = $idarticulo[$con];
                    $detalle->cantidad = $cantidad[$con];
                    $detalle->origen = $origen;
                    $detalle->destino = $destino;
                    $detalle->save();
                    $con++;
                }
            }

        
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }
        return Redirect::to('transferencia')->with('success', 'Registro actualizado correctamente !!!');
    }

}
