<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Mail\NotificacionDeRecuperacionPasswordMMSOFT;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class PasswordRequestController extends Controller
{

    public function index()
    {
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
        ];

        return view('online.password.recuperar_pass', $data);
    }

    public function store(Request $request)
    {
        $email = $request->get('email');
        $p = Persona::where('email', $email)->first();
        if ($p != null) {
            $p->remember_token = str_random(40);
            $p->update();

            Mail::to($email)
            //->subject('Verify Email Address Rquimica')
            //->bcc($correo)
                ->send(new NotificacionDeRecuperacionPasswordMMSOFT($p));

            return Redirect::to('./')->with('success', 'Se envio un correo para resetear su contraseña!!!');
           
        } else {
            $categorias = Categoria::categorias();
            $mjsn = "El correo ingresado no se encuentra registrado en nuestro sistema ..."; 
            $data = [ "categorias" => $categorias, 
                       "mjsn" => $mjsn];
            return view('online.password.recuperar_pass', $data);
        }

    }

    public function show($code)
    {
        $user = Persona::where('remember_token', $code)->first();
        $categorias = Categoria::categorias();
        $data = [
            "categorias" => $categorias,
            'user'  => $user
        ];

        if (!$user) {
            return redirect('/');
        }else{
            return view('online.password.reset', $data);
        }
    }

    public function update(Request $request, $id )
    {
        $user = Persona::findorfail($id); 
        $pass = $request->get('password');
        $pass_con = $request->get('password_confirmation');

        if ($pass  ==  $pass_con){
            $user->password = Hash::make($pass);
            $user->update(); 
            return Redirect::to('./access')->with('success', 'Se cambio correctamente su contraseña !!!');
        }else{
            echo "Error..."; 
               }

       
    }
}
