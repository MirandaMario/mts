<?php

namespace App\Http\Controllers;

use Cart;
use DB;

class CartEstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $registros = DB::table('cart_storage')
            ->select('id')
            ->get();

        foreach ($registros as $item) {
            $id = explode("_", $item->id);
            $datos[] = Cart::session($id[0])->getContent();
            $datos2[] = $id[0];
        }

        $data = ["datos" => $datos,
                 "datos2" => $datos2];

        return view('cart.index', $data);
    }
}
