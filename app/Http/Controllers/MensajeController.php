<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Picqer;
use App\Mensaje;

class MensajeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 

    public function index()
    {
        $mensajes = Mensaje::orderby('id_mesaje', 'desc')->get();
        $data = ["mensajes" => $mensajes];

        return view('mensaje.index', $data);
    }

  
    public function store(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), [
            'barcode' => 'required|string'

        ]);
        // make barcode
        if (!$validator->fails()) {
            $label =  $request->input('barcode');
            $descripcion =  $request->input('descripcion');
            $barcode_generator = new Picqer\Barcode\BarcodeGeneratorJPG();
            $barcode = $barcode_generator->getBarcode($label, $barcode_generator::TYPE_CODE_128);
           // dd($barcode);
           return view('barcode.index', [   'label' => $label,
                                            'barcode' => $barcode,
                                            'descripcion' => $descripcion]);   }



        // validation error
        return response()->json($validator->messages(), 400, array(), JSON_PRETTY_PRINT);
    }

 
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
