<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; 
use App\Categoria;

//use Illuminate\Foundation\Auth\AuthenticatesUsers; 

class ClientController extends Controller
{
    
     use AuthenticatesUsers;

    protected $guard = 'clients' ;

    protected $redirectTo = './';

    public function showLoginForm()
    {
        $categorias = Categoria::categorias();

        $data = [ "categorias" => $categorias ];

        return view('online.ingresar', $data);
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }

}
