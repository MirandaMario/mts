<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users', function (){

    return datatables()

    ->eloquent(App\Persona::query()

    //$especies=DB::table('especie') 
    // ->join('persona', 'especie.idcliente', '=', 'persona.idpersona')
    //->select('especie.fecha_hora', 'especie.num_comprobante', 'persona.nombre',     'especie.total_especie', 'especie.estado', 'especie.idEspecie')

    ->orderBy('persona.idpersona', 'desc'))
    
    /* ->addColumn('namelink', function ($user) {
        return '<a href="' . route('cliente.edit', $user->idEspecie) .'">'.$user->idEspecie.'</a>'; 
    })
    ->rawColumns(['namelink']) */
    
    //->make(true)
   // ->orderBy() 
    ->toJson(); 
   
});
