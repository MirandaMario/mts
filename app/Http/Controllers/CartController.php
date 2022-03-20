<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart; 
use DB; 
use Illuminate\Support\Facades\Redirect;
class CartController extends Controller
{
    public function add(Request $request){
       // dd($request); 
        $id = $request->idpr;
        try {
            $userID =  auth('clients')->user()->idpersona;
        } catch (\Throwable $th) {
            //throw $th;
        } 
       

        if(isset($userID)){
            Cart::session($userID)->add(array(
                'id' => $request->idpr,
                'name' => $request->proc,
                'price' => $request->prec,
                'quantity' => $request->cant, 
                'attributes' => array(
                    'image' => $request->imgp, 
                    'desc' => $request->desc, 
                    'slug' => $request->slug
                )               
            ));
        }else{
            Cart::add(array(
                'id' => $request->idpr,
                'name' => $request->proc,
                'price' => $request->prec,
                'quantity' => $request->cant, 
                'attributes' => array(
                    'image' => $request->imgp, 
                    'desc' => $request->desc, 
                    'slug' => $request->slug
                )               
            ));
        }

                //Cart::get($id);
        $item = Cart::get($id); 
        $total = Cart::getTotal(); 
        $cartTotalQuantity = Cart::getTotalQuantity();
        return response()->json([
            'success' => 'Articulo Agregado Satisfactoriamente !!!',
            'total' =>  $total,
            'cartTotalQuantity' => $cartTotalQuantity,
            'item' => $item
        ]);

       
    }

    public function ver (){
        dd(Cart::getContent());
    }

    public function clearcart(){
    
        try {
            $userID =  auth('clients')->user()->idpersona;
            Cart::session($userID)->clear();
        } catch (\Throwable $th) {
            Cart::clear();
        }
      
        $total = Cart::getTotal();
        $cartTotalQuantity = Cart::getTotalQuantity();
        $categorias = DB::table('categoria')->select('idcategoria', 'nombreCategoria', 'cslug')->orderBy('nombreCategoria', 'asc')->get();
        $cartCollection = Cart::getContent();
        $data = [
            "categorias" => $categorias,
            "total" => $total,
            "cartTotalQuantity" => $cartTotalQuantity, 
            "cartCollection" =>  $cartCollection
        ];
        return view('online.cart' , $data);
    }

    public function update(Request $request){
        
        $id= $request->idpr; 
        try {
            $userID =  auth('clients')->user()->idpersona;
            Cart::session($userID)->update($id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->newVal
                ),
        ));
        } catch (\Throwable $th) {
            Cart::update($id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->newVal
                ),
        ));
        }
       
        
        
        

        $item = Cart::get($id); 
        $total = Cart::getTotal();
        $cartTotalQuantity = Cart::getTotalQuantity();
        $subtotal = Cart::get($item->id)->getPriceSum(); 
        return response()->json([
            'success' => 'Articulo Actualizado Satisfactoriamente !!!',
            'total' =>  $total,
            'cartTotalQuantity' => $cartTotalQuantity,
            'item' => $item, 
            'subtotal' => $subtotal
        ]);
    }

    public function remove(Request $request){

        try {
            $userID =  auth('clients')->user()->idpersona;
            $id = ($request->id)*1; 
            Cart::session($userID)->remove($id);
        } catch (\Throwable $th) {            
            $id = ($request->id)*1; 
            Cart::remove($id);
        }
         
        return Redirect::to('cart')->with('success', 'Producto eliminado !!!');
    }
}
